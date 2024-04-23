<?php

namespace App\Http\Controllers;

use App\Models\Propertie;
use Illuminate\Http\Request;

class PropertieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $properties = Propertie::all();
        return view('propetie.createPropertie', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'price_per_night' => 'required',
            'max_guest' => 'required',
            'image.*' => 'required',
        ]);
        // dd($request);
        $images = $request->file("image");

        foreach ($images as  $image) {
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->storeAs("public/img", $imageName);
            $imagePaths[] = $imageName;
            }
            Propertie::create([
                'user_id' => $request->user_id,
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'price_per_night' => $request->price_per_night,
                'max_guest' => $request->max_guest,
                "image" => json_encode($imagePaths)
            ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Propertie $propertie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Propertie $propertie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Propertie $propertie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Propertie $propertie)
    {
        //
    }
}
