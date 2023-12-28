<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ListingUpdateRequest;

class ListingController extends Controller
{   
    public function index() {
        return Inertia::render('User/AllListing', [
          'listings' => Listing::latest()->get(),
        ]);
    }

    public function listing() {
        return Inertia::render('HomeListing', [
          'welcomeListings' => Listing::all(),
        ]);
    }
    
    

    public function show(Listing $listing) {
        return Inertia::render('User/Listing', [
            'props' => [
                'listing' => $listing
            ],
        ]);
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'size' => 'required|string',
            'quantity' => 'required|string',
        ]);

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return back();
    }

    public function edit(Listing $listings) {
        return Inertia::render('User/UpdateListing', [
            'listings' => $listings,
        ]);
    }
    
    public function update(Request $request) {

        $listing = Listing::findOrFail($request->id);

        if (!$listing) return back()->with('message', 'Something went wrong');
        

        $formFields = $request->validate([
            'name' => '',
            'price' => '',
            'size' => '',
            'quantity' => '',
        ]);
        $listing->update($formFields);
    
        return to_route('listing.index')->with('success', 'Listing updated successfully.');
    }

    public function destroy($id) {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return to_route('listing.index')->with('success', 'Listing deleted successfully.');
    }
    
}
