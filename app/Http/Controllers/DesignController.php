<?php

namespace App\Http\Controllers;

use App\Design;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DesignController extends Controller
{
    public function store(Request $request, String $name, String $description, String $commission){

        // saving the image
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



        // saving the vector (svg)
        $design_svg = $request->design_svg;
        file_put_contents('svg/temp.svg', $design_svg);
        $design_file_svg_name = Storage::disk('public')->putFile('svg', new File('svg/temp.svg') );



        // saving the json -> to make the design editable
        $design_json = $request->design_json;
        file_put_contents('json/temp.json', $design_json);
        $design_file_json_name = Str::random(40).'.json';
        Storage::disk('public')->putFileAs('json', new File('json/temp.json'), $design_file_json_name);
        $design_file_json_name = 'json/'. $design_file_json_name;

        $inputs = array();

        $inputs['name'] = $name;
        $inputs['description'] = $description;
        $inputs['commission'] = $commission;
        $inputs['design_image'] = $design_file_image_name;
        $inputs['design_svg'] = $design_file_svg_name;
        $inputs['design_json'] = $design_file_json_name;

        $id = Design::create($inputs);

        return $id;

    }

    public function update(Request $request, Design $design, String $name, String $description, String $commission){

        // saving the image
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

        // saving the vector (svg)
        $design_svg = $request->design_svg;
        file_put_contents('svg/temp.svg', $design_svg);
        $design_file_svg_name = Storage::disk('public')->putFile('svg', new File('svg/temp.svg') );

        // saving the json -> to make the design editable
        $design_json = $request->design_json;
        file_put_contents('json/temp.json', $design_json);
        $design_file_json_name = Str::random(40).'.json';
        Storage::disk('public')->putFileAs('json', new File('json/temp.json'), $design_file_json_name);
        $design_file_json_name = 'json/'. $design_file_json_name;

        Storage::disk('public')->delete($design->design_image);
        Storage::disk('public')->delete($design->design_svg);
        Storage::disk('public')->delete($design->design_json);

        $design->name = $name;
        $design->description = $description;
        $design->commission = $commission;
        $design->design_image = $design_file_image_name;
        $design->design_svg = $design_file_svg_name;
        $design->design_json = $design_file_json_name;
        $design->update();

        return true;

    }

    public function destroy(Design $design){

        Storage::disk('public')->delete($design->design_json);
        Storage::disk('public')->delete($design->design_svg);
        Storage::disk('public')->delete($design->design_image);

        $design->delete();

        return true;

    }
}
