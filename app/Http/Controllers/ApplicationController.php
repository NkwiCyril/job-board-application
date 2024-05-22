<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationMail;
use App\Models\Application;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * Show the application form for creating an application
     * @param int $id
     */
    public function create($id): View
    {
        $opportunity = Opportunity::find($id);

        return view('applications.create', [
            'opportunity' => $opportunity,
        ]);
    }


    /**
     * Store new application in the database and send notification 
     * @param int $id
     * @param object $request
     */
    public function store(Request $request, $opp_id): RedirectResponse
    {
        // validate incoming input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'resume' => 'required',
            'bio' => 'required',
        ]);

        $opp = Opportunity::find($opp_id);

        if (auth()->check()) {

            // get the resume file and keep in storage
            $fileName = $request->file('resume')->getClientOriginalName();
            $destinationPath = public_path('storage/files');
            $request->file('resume')->move($destinationPath, $fileName);
            $validatedData['resume'] = '/storage/files/'.$fileName;

            // since the user is authenticated, we need to save the application in the database
            // for them to access later and see the progress of the application

            $new_application = Application::create([
                'cv_link' => $validatedData['resume'],
                'bio' => $validatedData['bio'],
                'opp_id' => $opp_id,
                'user_id' => auth()->user()->id,
                'application_date' => now(),
            ]);

            // send email to the user
            $seeker = auth()->user();
            $company = User::find($opp->user_id);
            $mailData = [
                'company' => $company,
                'seeker' => $seeker,
                'opp' => $opp,
            ];

            Mail::to($company->email)->queue(new ApplicationMail($mailData));

            return redirect('/')->with('success', 'Your application has been sent successfully via gmail to '.$company->name);

        } else {

            // for a guest user, we need to only send email to the company with guests credentials

            // get the resume file and keep in storage
            $fileName = $request->file('resume')->getClientOriginalName();
            $destinationPath = public_path('storage/files');
            $request->file('resume')->move($destinationPath, $fileName);
            $validatedData['resume'] = '/storage/files/'.$fileName;

            $company = User::find($opp->user_id);
            $mailData = [
                'company' => $company,
                'opp' => $opp,
                'guest' => $validatedData,
            ];

            Mail::to($company->email)->queue(new ApplicationMail($mailData));

            return redirect('/register')->with('success', 'Your application has been sent! Register Now to get notifications on opportunity posts.');

        }
    }
}
