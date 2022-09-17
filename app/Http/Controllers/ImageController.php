<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();

        return view('cropper', compact('images'));
    }

    public function upload(Request $request)
    {
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_base64 = base64_decode($image_parts[1]);

        $photo_name = time().'.png';
        $destinationPath = public_path('/storage/' . $photo_name);

        $fp = fopen($destinationPath, 'w');
        fwrite($fp, $image_base64);
        fclose($fp);

        Image::create([
            'img_path' => 'storage/' . $photo_name
        ]);

        return response()->json(['success'=>'success']);
    }
}
