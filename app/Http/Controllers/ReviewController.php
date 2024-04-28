<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        request()->validate([
            'user_id'=>'required',
            'propertie_id'=>'required',
            'rating'=>'required',
            'description'=>'required',
        ]);
        // dd($request);
        Review::create([
            'user_id' => $request->user_id,
            'propertie_id' => $request->propertie_id,
            'rating' => $request->rating,
            'description' => $request->description,
        ]);
        return back();
    }
}
