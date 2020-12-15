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
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DesignController extends Controller
{
    public function home(){
        $designs = Design::where('visibility','=','public')
            ->orderBy('updated_at','DESC')
            ->get();

        return view('home',compact('designs'));
    }

    public function index(){
        $userId = Auth::user()->id;

        $designs = Design::where('user_id','=',$userId)
            ->orderBy('updated_at','DESC')
            ->get();

        return view('design.index', compact('designs'));
    }


    public function create(){
        return view('design.create');
    }

    public function store(Request $request){

        $inputs = $request->validate([
            'title'=>['required','min:3', 'max:255'],
            'description'=>['required'],
            'visibility'=> Rule::in(['public','private'])
        ]);

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

        $inputs['design_image'] = $design_file_image_name;

        // saving the vector (svg)
        $design_svg = $request->design_svg;
        file_put_contents('svg/temp.svg', $design_svg);
        $design_file_svg_name = Storage::disk('public')->putFile('svg', new File('svg/temp.svg') );
        $inputs['design_svg'] = $design_file_svg_name;


        // saving the json -> to make the design editable
        $design_json = $request->design_json;
        file_put_contents('json/temp.json', $design_json);
        $filename = Str::random(40).'.json';
        Storage::disk('public')->putFileAs('json', new File('json/temp.json'), $filename);
        $inputs['design_json'] = $filename;


        $id = Auth::user()->designs()->create($inputs)->id;

        Session::flash('success','Design Created Successfully');

        return redirect()->route('designs.show',$id);

    }

    public function show(Design $design){

        Session::flash('info','<h1> All T-shirt Costs ONLY Rp50.000! </h1>');

        return view('design.show', compact('design'));

    }


    public function edit(Design $design){

        return view('design.edit', compact('design'));

    }


    public function update(Design $design, Request $request){

        $inputs = $request->validate([
            'title'=>['required','min:3', 'max:255'],
            'description'=>['required'],
            'visibility'=> Rule::in(['public','private'])
        ]);

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
        $inputs['design_image'] = $design_file_image_name;

        //deleting old image
        Storage::disk('public')->delete($design->design_image);

        // saving the vector (svg) -> to make the design editable
        $design_svg = $request->design_svg;
        file_put_contents('svg/temp.svg', $design_svg);
        $design_file_svg_name = Storage::disk('public')->putFile('svg', new File('svg/temp.svg') );

        $inputs['design_svg'] = $design_file_svg_name;

        //deleting old vector
        Storage::disk('public')->delete($design->design_svg);

        //saving the json
        $design_json = $request->design_json;
        file_put_contents('json/temp.json', $design_json);
        $filename = Str::random(40).'.json';
        Storage::disk('public')->putFileAs('json', new File('json/temp.json'), $filename);
        $filename = 'json/'.$filename;

        $inputs['design_json'] = $filename;

        //deleting old json
        Storage::disk('public')->delete($design->design_json);

        $design->title = $inputs['title'];
        $design->description = $inputs['description'];
        $design->visibility = $inputs['visibility'];
        $design->design_image = $inputs['design_image'];
        $design->design_svg = $inputs['design_svg'];
        $design->design_json = $inputs['design_json'];
        $design->update();

        Session::flash('success','Design Updated Successfully');

        return redirect()->route('designs.show', $design);

    }

    public function destroy(Design $design){

        Storage::disk('public')->delete($design->design_json);
        Storage::disk('public')->delete($design->design_svg);
        Storage::disk('public')->delete($design->design_image);

        $design->delete();

        Session::flash('success','Design Deleted Successfully');

        return redirect()->route('designs.index');

    }
}
