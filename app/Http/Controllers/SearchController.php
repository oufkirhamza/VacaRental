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

    //     return view('search.search', compact('results')); // Pass results to view
    // }
    public function search(Request $request)
    {
        $properties = Propertie::all();
        $ratings = [];
        $numReviewsArray = [];
        foreach ($properties as $propertie) {
            $allrating = 0;
            $reviews = Review::where('propertie_id', $propertie->id)->get();
            $numReviews = count($reviews);
            $numReviewsArray[$propertie->id] = $numReviews;
            foreach ($reviews as $review) {
                $allrating += $review->rating;
            }
            if ($numReviews == 0) {
                $rating = $allrating / 1;
            } else {
                $rating = $allrating / $numReviews;
            }
            $ratings[$propertie->id] = $rating;
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
        // $reset = ($request->input('reset'));
        // if (empty()) {
        //     $propertiesQuery->where('city', 'like', "%{$city}%");
        // }

        $properties = $propertiesQuery->get();
        return view('search.search', compact('properties','ratings', 'numReviewsArray'));
    }
}
