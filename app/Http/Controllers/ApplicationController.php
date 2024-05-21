<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationMail;
use App\Models\Opportunity;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    public function all () {
        return view('all_applications');
    }

    public function view ($id) {
        $opportunity = Opportunity::find($id);

        return view('pages.application', [
            'opportunity' => $opportunity,
        ]);
    }

    public function send (Request $request, $opp_id) {     
        // validate incoming input
        $validatedData = $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone_number'=> 'required',
            'resume'=> 'required',
            'bio'=> 'required',
        ]);

        $opp = Opportunity::find($opp_id);
        
        if (Auth::check()) {
            
        // get the resume file and keep in storage
            $fileName = $request->file('resume')->getClientOriginalName();
            $destinationPath = public_path('storage/files');
            $request->file('resume')->move($destinationPath, $fileName);
            $validatedData['resume'] = '/storage/files/' . $fileName;

            // since the user is authenticated, we need to save the application in the database 
            // for them to access later and see the progress of the application

            $new_application = Application::create([
                'cv_link' => $validatedData['resume'],
                'bio' => $validatedData['bio'],
                'opp_id' => $opp_id,
                'user_id' => Auth::user()->id,
                'application_date' => now(),
            ]);

            // send email to the user
            $seeker = Auth::user();
            $company = User::find($opp->user_id);
            $mailData = [
                'company' => $company,
                'seeker' => $seeker,
                'opp' => $opp,
            ];

            Mail::to($company->email)->queue(new ApplicationMail($mailData));
            return redirect('/')->with('success', 'Your application has been sent successfully via gmail to ' . $company->name);

        } else {

            // for a guest user, we need to only send email to the company with guests credentials

            // get the resume file and keep in storage
            $fileName = $request->file('resume')->getClientOriginalName();
            $destinationPath = public_path('storage/files');
            $request->file('resume')->move($destinationPath, $fileName);
            $validatedData['resume'] = '/storage/files/' . $fileName;

            $company = User::find($opp->user_id);
            $mailData = [
                'company' => $company,
                'opp' => $opp,
                'guest' => $validatedData 
            ];

            Mail::to($company->email)->queue(new ApplicationMail($mailData));

            return redirect('/register')->with('success', 'Your application has been sent! Register Now to get notifications on opportunity posts.');
            
        }
    }
}