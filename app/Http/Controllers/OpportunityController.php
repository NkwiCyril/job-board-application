<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Mail\NewOpportunityMail;
 

class OpportunityController extends Controller
{
    public function view ($id) {
        $opportunity = Opportunity::find($id);
        $published_at = Carbon::parse($opportunity->published_at)->diffForHumans();
        return view('pages.view_opportunity',[
            'opportunity' => $opportunity,
            'published_at' => $published_at,
        ]);
    }

    public function edit ($id) {
        $opportunity = Opportunity::find($id);
        return view('pages.edit_opportunity', [
            'opportunity' => $opportunity,
        ]);
    }

    public function update (Request $request, $id) {
        // get the image url
        $validatedData = $request->validate([
            'title' =>'required',
            'image_url' =>'required|image',
            'description' =>'required',
            'category_id' =>['required' => 'max:1'],
        ]);
        $opportunity = Opportunity::find($id);

        $opportunity->update($validatedData);

        return redirect('/')->with('success', 'Opportunity has been updated successfully!');
    }

    public function create () {
        return view('pages.create_opportunity');
    }

    public function store (Request $request) {

        // validate
        $opportunity = $request->validate([
            'title' =>'required|string',
            'image_url' =>'required|image',
            'description' =>'required|string',
            'category' =>'required|integer',
        ]);

        $fileName = $request->file('image_url')->getClientOriginalName();
        $destinationPath = public_path('storage/images');
        $request->file('image_url')->move($destinationPath, $fileName);
        $opportunity['image_url'] = '/storage/images/' . $fileName;
        

        try { 
            $new = Opportunity::create([
                'title' => $opportunity['title'],
                'description' => $opportunity['description'],
                'image_url' => $opportunity['image_url'],
                'user_id' => Auth::user()->id,
                'category_id' => $opportunity['category'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        } catch (\Exception $e) {
            Log::error('Error encountered in creating opportunity: ' . $e->getMessage());
        }
        

        return redirect('/')
               ->with('success', 'Opportunity has been created successfully!');
    }


    // delete an opportunity from the database
    public function delete ($id) {
        Opportunity::where('id', $id)->delete(); 
        return redirect('/')->with('success', 'Opportunity deleted successfully!');
    }

        // method to get all published opportunities
    public function publish_all () {
        $published_opportunities = Opportunity::all()->where('published_at', !null);
            
        return view('pages.publish_opportunity', [
            'published_opportunities' => $published_opportunities,
        ]);
    }
    
        // method to publish an opportunity
    public function publish ($id) {
        $opportunity = Opportunity::find($id);
        $opportunity->published_at = now();
        $opportunity->save();
    
        $seekers = User::all();
    
        // call the created Artisan command to delete the opportunity after specified time
    
        Artisan::call('app:delete-old-opportunities');
    
    
            // notify all users of that category via email notification
        foreach ($seekers as $seeker) {
            if ($seeker->category === $opportunity->category->category_name) {

                $mailData = [
                    'opportunity' => $opportunity,
                    'seeker' => $seeker,
                ];
    
                // sending email error handling 
                try {
                    Mail::to($seeker->email)->queue(new NewOpportunityMail($mailData));
                } catch (\Exception $e) {
                    // Log the error message
                    Log::error('Error sending email to ' . $seeker->email . ': ' . $e->getMessage());
            
                    // Optionally, you can handle the error further, like notifying an admin or retrying
                }
                    
            }
        }
        
        return redirect('/')->with('success', 'Opportunity published successfully! All published opportunities will be deleted after 30 days');
    
    }
    
    // unpublish an opportunity 
    public function unpublish ($id) {
        $opportunity = Opportunity::find($id);
        $opportunity->published_at = null;
        $opportunity->save();
    
        return redirect('/')->with('success', 'Opportunity unpublished successfully!');
    }

}