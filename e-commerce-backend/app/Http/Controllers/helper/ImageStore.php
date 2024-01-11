<?php

namespace App\Http\Controllers\helper;

use Illuminate\Support\Facades\Storage;

class ImageStore
{
    public function storeImage(String $driver, String $path, $image, array $data = [])
    {
        $filename = uniqid() . time() . "." . $image->getClientOriginalExtension();
        Storage::disk($driver)->put($path . "/$filename", file_get_contents($image));
        $data["image"] = $filename;
        return $data;
    }

    public function deleteImage(String $driver, String $path, String $imageName)
    {
        Storage::disk($driver)->delete($path . "/$imageName");
    }
}
