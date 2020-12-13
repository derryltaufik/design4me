<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DesignController extends Controller
{
    public function create(){
        return view('design.create');
    }

    public function store(Request $request){
        $design_image = $request->design_image;
        $design_image = str_replace('data:image/png;base64,','',$design_image);
        $design_image = str_replace(' ,','+',$design_image);
        $design_image = base64_decode($design_image);
        $design_file_image_raw = imagecreatefromstring( $design_image );
        if ($design_file_image_raw !== false) {
            imagepng($design_file_image_raw, 'images/temp.png',0);
            imagedestroy($design_file_image_raw);
            $design_file_image_name = Storage::disk('public')->putFile('images', new File('images/temp.png') );
        }

    }
}
