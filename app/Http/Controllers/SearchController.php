<?php

namespace App\Http\Controllers;

use App\Models\Propertie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        // dd($searchTerm);
        
        $results = Propertie::search($searchTerm)->get(); // Retrieve matching models
        // Optional: Filter and format results further

        return view('search.search', compact('results')); // Pass results to view
    }
}
