<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\NewOpportunityMail;
 

class OpportunityController extends Controller
{
    public function view_opportunity($id) {
        $opportunity = Opportunity::find($id);
        $published_at = Carbon::parse($opportunity->published_at)->diffForHumans();
        return view('pages.view_opportunity',[
            'opportunity' => $opportunity,
            'published_at' => $published_at,
        ]);
    }

    public function edit_opportunity($id) {
        $opportunity = Opportunity::find($id);
        return view('pages.edit_opportunity', [
            'opportunity' => $opportunity,
        ]);
    }

    public function update(Request $request, $id) {
        // get the image url
        $validatedData = $request->validate([
            'title' =>'required',
            'image_url' =>'required',
            'description' =>'required',
            'category_id' =>['required' => 'max:1'],
        ]);
        $opportunity = Opportunity::find($id);

        $opportunity->update($validatedData);

        return redirect('/')->with('success', 'Opportunity has been updated successfully!');
    }

    public function create_opportunity() {
        return view('pages.create_opportunity');
    }

    public function store_opportunity(Request $request) {
        $opportunity = $request->all();
        
        $fileName = $request->file('image_url')->getClientOriginalName();
        $destinationPath = public_path('storage/images');
        $request->file('image_url')->move($destinationPath, $fileName);
        $opportunity['image_url'] = '/storage/images/' . $fileName;
        
        $new = Opportunity::create([
            'title' => $opportunity['title'],
            'description' => $opportunity['description'],
            'image_url' => $opportunity['image_url'],
            'user_id' => Auth::user()->id,
            'category_id' => $opportunity['category'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/')
               ->with('success', 'Opportunity has been created successfully!');
    }

    // method to get all published opportunities
    public function all_published () {
        $published_opportunities = Opportunity::all()->where('published_at', !null);
        
        return view('pages.publish_opportunity', [
            'published_opportunities' => $published_opportunities,
        ]);
    }

    // method to publish an opportunity
    public function publish_opportunity($id) {
        $opportunity = Opportunity::find($id);
        $opportunity->published_at = now();
        $opportunity->save();

        $seekers = User::all();

        // notify all users of that category via email notification
        foreach ($seekers as $seeker) {
            if ($seeker->category === $opportunity->category->category_name) {

                $mailData = [
                    'opportunity' => $opportunity,
                    'seeker' => $seeker,
                ];

                Mail::to($seeker->email)->send(new NewOpportunityMail($mailData));
            }
        }
    
        return redirect('/')->with('success', 'Opportunity published successfully! All published opportunities will be deleted after 30 days');

}
    // unpublish an opportunity 
    public function unpublish_opportunity($id) {
        $opportunity = Opportunity::find($id);
        $opportunity->published_at = null;
        $opportunity->save();

        return redirect('/')->with('success', 'Opportunity unpublished successfully!');
    }

    // delete an opportunity from the database
    public function delete_opportunity($id) {
        Opportunity::where('id', $id)->delete(); 
        return redirect('/')->with('success', 'Opportunity deleted successfully!');
    }
}