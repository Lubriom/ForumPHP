<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage($filename)
    {
        $file = Storage::disk('users')->get('profile/' . $filename);
        return response($file, 200);
    }
}
