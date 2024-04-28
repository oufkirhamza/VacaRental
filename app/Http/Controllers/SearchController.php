<?php

namespace App\Http\Controllers;

use App\Models\Propertie;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    // public function search(Request $request)
    // {
    //     $searchTerm = $request->input('search');

    //     dd($searchTerm);
    //     $results = Propertie::search($searchTerm)->get(); // Retrieve matching models
    //     dd($results);
    //     // Optional: Filter and format results further

    //     return view('search.search', compact('results')); // Pass results to view
    // }
    public function search(Request $request)
    {
        $latestReviews = Review::latest()->take(3)->get();
        $allrating = 0;
        $users = count(User::all());
        $reviews = Review::all();
        $numReviews = count($reviews);
        foreach ($reviews as $review) {
            $allrating += $review->rating;
        }
        if ($numReviews == 0) {
            $rating = $allrating / 1;
        } else {
            $rating = $allrating / $numReviews;
        }

        $propertiesQuery = Propertie::query();
        $name = ($request->input('search'));
        if (!empty($name)) {
            $propertiesQuery->where('title', 'like', "%{$name}%");
        }
        $city = ($request->input('city'));
        if (!empty($city)) {
            $propertiesQuery->where('city', 'like', "%{$city}%");
        }

        $properties = $propertiesQuery->get();
        return view('search.search', compact('properties','rating', 'numReviews'));
    }
}
