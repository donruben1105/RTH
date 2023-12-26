<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ListingController extends Controller
{   
    public function index()
    {
        return Inertia::render('User/AllListing', [
          'listings' => Listing::latest()->get(),
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
}
