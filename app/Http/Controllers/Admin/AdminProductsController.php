<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\User;
use App\Order;
use Storage;
use DB;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{
    public function index(){
        $products = Product::paginate(3);

        return view('admin.displayproducts', ['products' => $products]);
    }

    public function editProductForm($id){
        $product = Product::find($id);
        return view('admin.editProductForm', ['product' => $product]);
    }

    public function editProductImageForm($id){
        $product = Product::find($id);
        return view('admin.editProductImageForm', ['product' => $product]);
    }

    public function updateProductImage(Request $request, $id){

        Validator::make($request->all(), ['image'=>'required|image|mimes:jpg,png,jpeg|max:5000'])->validate();

        if($request->hasFile('image')){
            $product = Product::find($id);
            $exists = Storage::disk('local')->exists('public/product_images/'.$product->image);

            if($exists){
                Storage::delete('public/product_images/'.$product->image);
            }

            $ext = $request->file('image')->getClientOriginalExtension();
            $request->image->storeAs('public/product_images/', $product->image);

            /*$arrToUpdate = array('image'=>$product->image);
            DB::table('products')->where('id', $id)->update($arrToUpdate);*/
            return redirect()->route('adminDisplayProducts');
        }
        else {
            return "No image was selected";
        }

    }

    public function updateProduct(Request $request, $id){
        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $price = $request->input('price');

        $arrToUpdate = array('name'=>$name, 'description'=>$description, 'type'=>$type, 'price'=>$price);
        DB::table('products')->where('id', $id)->update($arrToUpdate);

        return redirect()->route('adminDisplayProducts');
    }

    public function createProductForm(){

        return view('admin.createProductForm');

    }

    public function insertProduct(Request $request){
        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $price = $request->input('price');

        Validator::make($request->all(), ['image'=>'required|image|mimes:jpg,png,jpeg|max:5000'])->validate();

        $ext = $request->file('image')->getClientOriginalExtension();

        $stringImgReformat = str_replace(" ", "", $request->input('name'));
        $imageEncoded = File::get($request->image);
        $imgName = $stringImgReformat.".".$ext;
        Storage::disk('local')->put('product_images/'.$imgName, $imageEncoded);

        $newProductArr = array('name'=>$name, 'description'=>$description, 'type'=>$type, 'price'=>$price, 'image'=>$imgName);
        $res = DB::table('products')->insert($newProductArr);

        return redirect()->route('adminDisplayProducts');
    }

    public function deleteProduct($id) {
        $product = Product::find($id);

        $exists = Storage::disk('local')->exists('public/product_images/'.$product->image);

        if($exists){
            Storage::delete('public/product_images/'.$product->image);
        }

        Product::destroy($id);
        return redirect()->route('adminDisplayProducts');
    }

    public function orders(){
        /*$orders = DB::table('orders')
            ->select('orders.*')
            ->get();*/

        $orders = Order::paginate(10);

        return view('admin.displayorders', ['orders' => $orders]);
    }
}
