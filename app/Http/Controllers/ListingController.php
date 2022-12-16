<?php

namespace App\Http\Controllers;


use App\Models\Listing as listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
// use App\Models\listing as ModelsListing;

class ListingController extends Controller
{
    // SHOW ALL LISTINGS
    public function Index()
    {
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    // SHOW SINGLE LISTING
    public function Show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // CREATE A GIG
    public function create()
    {
        return view('listings.create');
    }

    // STORE LISTING DATA
    public function store(Request $request)
    {
        
        $fields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        // ddd($fields);

        if ($request->hasFile('logo')) {
            $fields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $fields['user_id'] = auth()->id();
        Listing::create($fields);
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // SHOW EDIT FORM 
    public function edit(Listing $listing) 
    {
        // dd($listing);
        return view('listings.edit', ['listing' => $listing]);
    }

    // UPDATE EDIT FORM
    public function update(Request $request, Listing $listing)
    {
        $fields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $fields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($fields);
        return back()->with('message', 'Listing updated successfully!');
    }

    // DELETE LISTING
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfuly');
    }

    // MANAGE LISTINGS
    public function manage ()
    {
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()]);
    }
}
