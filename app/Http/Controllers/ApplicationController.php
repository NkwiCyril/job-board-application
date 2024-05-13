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
            'full-name'=> 'required',
            'email'=> 'required',
            'phone-number'=> 'required',
            'resume'=> 'required',
            'bio'=> 'required',
        ]);

        if (Auth::check()) {
            $application = $request->all();

            // get the resume file and keep in storage
            $fileName = $request->file('resume')->getClientOriginalName();
            $destinationPath = public_path('storage/files');
            $request->file('resume')->move($destinationPath, $fileName);
            $application['resume'] = '/storage/files/' . $fileName;
            
    
            $new_application = Application::create([
                'cv_link' => $application['resume'],
                'bio' => $application['bio'],
                'opp_id' => $opp_id,
                'user_id' => Auth::user()->id,
                'application_date' => now(),
            ]);

            // send email to the user
            $seeker = Auth::user();
            $opp = Opportunity::find($opp_id);
            $company = User::find($opp->user_id);
            $mailData = [
                'company' => $company,
                'seeker' => $seeker,
                'opp' => $opp,
            ];

            Mail::to($company->email)->send(new ApplicationMail($mailData));
            return redirect('/')->with('success', 'Application has been sent!');

        } else {

        }
    }
}