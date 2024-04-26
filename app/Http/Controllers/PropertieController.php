<?php

namespace App\Http\Controllers;

use App\Models\Propertie;
use App\Models\Image;
use Illuminate\Http\Request;


class PropertieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('propetie.createPropertie');
    }
    public function index_home()
    {
        return view('home.home');
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
            'city' => 'required',
            'price_per_night' => 'required',
            'max_guest' => 'required',
            'image.*' => 'required',
        ]);
        // dd($request);
        // $images = $request->file("image");

        // foreach ($images as  $image) {
        //     $imageName = time() . "_" . $image->getClientOriginalName();
        //     $image->storeAs("public/img", $imageName);
        //     $imagePaths[] = $imageName;
        //     }
            // dd($request);
        $images = $request->file("image");
        $property = Propertie::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'city' => $request->city,
            'price_per_night' => $request->price_per_night,
            'max_guest' => $request->max_guest,
        ]);

        foreach ($images as $image) {
            $imageName = time() . "_" . $image->getClientOriginalName();
            $image->storeAs("public/img", $imageName);
            Image::create([
                'propertie_id' => $property->id,
                'user_id' => $request->user_id,
                "image" => $imageName
            ]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Propertie $propertie)
    {

        return view('propetie.show', compact('propertie'));
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
