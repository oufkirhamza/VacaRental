<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
//     public function store(Request $request)
//     {
//         request()->validate([
//             "image.*" => "required|mimes:png,jpg|max:2048"
//         ]);
//         $images = $request->file("image");
//         foreach ($images as $image) {
//             $imageName = time() . "_" . $image->getClientOriginalName();
//             $image->storeAs("public/img", $imageName);
//             Image::create([
//                 "image" => $imageName
//             ]);
//         }
//         return back();
//     }
}
