<?php

namespace App\Http\Controllers;

use App\Design;
use App\Product;
use App\ProductType;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    protected $designController;
    public function __construct(DesignController $designController)
    {
        $this->designController = $designController;
    }

    public function home(){
        $products = Product::where('visibility','=','public')
            ->orderBy('updated_at','DESC')
            ->get();

        return view('home',compact('products'));
    }

    public function index(){
        $userId = Auth::user()->id;

        $products = Product::where('user_id','=',$userId)
            ->orderBy('updated_at','DESC')
            ->get();

        return view('product.index', compact('products'));
    }


    public function create(ProductType $productType){

        return view('product.create', compact('productType'));
    }

    public function store(Request $request, ProductType $productType){
        $inputs = $request->validate([
            'name'=>['required','min:3', 'max:255'],
            'description'=>['required'],
            'visibility'=> Rule::in(['public','private']),
            'commission'=> ['numeric','min:1000','max:1000000']
        ]);

        $design = $this->designController->store($request, $inputs['name'], $inputs['description'], $inputs['commission']);

        $inputs_product = array();

        $inputs_product['design_id'] = $design->id;
        $inputs_product['product_type_id'] = $productType->id;
        $inputs_product['visibility'] = $inputs['visibility'];

        $id = Auth::user()->products()->create($inputs_product)->id;

        Session::flash('success','Product Created Successfully');

        return redirect()->route('products.show',$id);

    }

    public function show(Product $product){
        $this->authorize('view',$product);

        return view('product.show', compact('product'));

    }


    public function edit(Product $product){

        $this->authorize('update',$product);

        return view('product.edit', compact('product'));

    }


    public function update(Product $product, Request $request){

        $this->authorize('update',$product);

        $inputs = $request->validate([
            'name'=>['required','min:3', 'max:255'],
            'description'=>['required'],
            'visibility'=> Rule::in(['public','private']),
            'commission'=> ['numeric','min:1000','max:1000000']
        ]);

        $design = $this->designController->update($request, $product->design, $inputs['name'], $inputs['description'], $inputs['commission']);


        $product->visibility = $inputs['visibility'];
        $product->update();

        Session::flash('success','Product Updated Successfully');

        return redirect()->route('products.show', $product);

    }

    public function destroy(Product $product){

        $this->authorize('delete',$product);

        $this->designController->destroy($product->design);

        $product->delete();

        Session::flash('success','Product Deleted Successfully');

        return redirect()->route('products.index');

    }
}
