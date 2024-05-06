<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OpportunityController extends Controller
{
    public function view_opportunity($id) {
        // return view('pages.view_opportunity');
    }

    public function edit_opportunity($id) {
        // return view('pages.edit_opportunity');
    }
    public function create_opportunity() {
        return view('pages.create_opportunity');
    }

    public function store_opportunity(Request $request) {
        $opportunity = $request->all();
        
        // $fileName = time().$request->file('image_url');

        $fileName = $request->file('image_url')->getClientOriginalName();

        // Define the destination path to move the uploaded file
        $destinationPath = public_path('storage/images');
    
        // Move the uploaded file to the destination path
        $request->file('image_url')->move($destinationPath, $fileName);
    
        // Update the $opportunity['image_url'] with the stored file path
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
               ->with('success', 'Opportunity added successfully!')
               ->with('opportunity',$new);
    }

    public function delete_opportunity($id) {
        // return view('pages.delete_opportunity');
    }
}
