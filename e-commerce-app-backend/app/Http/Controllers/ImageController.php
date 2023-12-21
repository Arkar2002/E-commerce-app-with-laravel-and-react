<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // store temporary image
    public function index(Request $request)
    {
        $allPreshowImages = Storage::allFiles("/public/preShowImages");
        $request->validate(['preShowImage' => "file|max:2048|mimes:png,jpg,jpeg,webp"]);
        if (isset($allPreshowImages)) Storage::delete($allPreshowImages);
        if ($file = $request->file('preShowImage')) {
            $filename = uniqid() . $file->getClientOriginalName();
            $file->storeAs("public/preShowImages", $filename);
            return asset("/storage/preShowImages/" . $filename);
        }
    }
}
