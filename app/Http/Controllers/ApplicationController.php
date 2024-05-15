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


    public function all_application() {
        return view('all_applications');
    }

    public function view_application_form($id) {
        $opportunity = Opportunity::find($id);

        return view('pages.application', [
            'opportunity' => $opportunity,
        ]);
    }

    public function send_application(Request $request, $opp_id) {     
        // validate incoming input
        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phone_number'=> 'required',
            'resume'=> 'required',
            'bio'=> 'required',
        ]);

        $application = $request->all();

        $opp = Opportunity::find($opp_id);


        // get the resume file and keep in storage
        $fileName = $request->file('resume')->getClientOriginalName();
        $destinationPath = public_path('storage/files');
        $request->file('resume')->move($destinationPath, $fileName);
        $application['resume'] = '/storage/files/' . $fileName;
        
        if (Auth::check()) {
            
            // since the user is authenticated, we need to save the application in the database 
            // for them to access later and see the progress of the application

            $new_application = Application::create([
                'cv_link' => $application['resume'],
                'bio' => $application['bio'],
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

            Mail::to($company->email)->send(new ApplicationMail($mailData));
            return redirect('/')->with('success', 'Your application has been sent successfully via gmail to ' . $company->name);

        } else {

            // for a guest user, we need to only send email to the company with guests credentials

            $company = User::find($opp->user_id);
            $mailData = [
                'company' => $company,
                'opp' => $opp,
                'guest' => $application 
            ];

            Mail::to($company->email)->send(new ApplicationMail($mailData));

            return redirect('/')->with('success', 'Your application has been sent successfully via gmail to ' . $company->name);
            
        }

    }
}