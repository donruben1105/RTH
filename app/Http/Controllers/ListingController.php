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

    public function singleListing(Request $request) {
        $singleListing = Listing::findOrFail($request->id);
    
        // $singleListing->each(function ($singleListing) {
        //     // Check if $singleListing->files is not null
        //     if (!is_null($singleListing->files)) {
        //         $singleListing->files = json_decode($singleListing->files);
        //         $singleListing->files = array_map(function ($file) {
        //             return asset("storage/file/{$file}");
        //         }, $singleListing->files);
        //     }
        // });
        if (!is_null($singleListing->files)) {
                    $singleListing->files = json_decode($singleListing->files);
                    $singleListing->files = array_map(function ($file) {
                        return asset("storage/{$file}");
                    }, $singleListing->files);
                }
        return Inertia::render('User/SingleListing', ['singleListings' => $singleListing]);
    }

    public function listing() {
        $listing = Listing::all();
    
        $listing->each(function ($listing) {
            // Check if $listing->files is not null
            if (!is_null($listing->files)) {
                $listing->files = json_decode($listing->files);
                $listing->files = array_map(function ($file) {
                    return asset("storage/{$file}");
                }, $listing->files);
            }
        });
        return Inertia::render('HomeListing', ['welcomeListings' => $listing]);
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
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpeg,png|max:5000',
        ]);

        // Process file uploads
        if ($request->hasFile('files')) {
            $uploadedFiles = [];
            foreach ($request->file('files') as $file) {
                $uploadedFiles[] = $file->store('file', 'public');
            }
            $formFields['files'] = json_encode($uploadedFiles);
        } else {
            $formFields['files'] = null;
        }

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
            'files' => 'nullable|array', // Modify the validation rule for 'files'
            'files.*' => 'file|mimes:jpeg,png,pdf|max:2048', // Add validation rule for each file
        ]);

        // Process file uploads
        if ($request->hasFile('files')) {
            $uploadedFiles = [];
            foreach ($request->file('files') as $file) {
                $uploadedFiles[] = $file->store('file', 'public');
            }
            $formFields['files'] = json_encode($uploadedFiles);
        } else {
            // If no new files are uploaded, keep the existing files
            $formFields['files'] = $listing->files;
        }

        $listing->update($formFields);
    
        return to_route('listing.index')->with('success', 'Listing updated successfully.');
    }

    public function destroy($id) {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return to_route('listing.index')->with('success', 'Listing deleted successfully.');
    }
    
}
