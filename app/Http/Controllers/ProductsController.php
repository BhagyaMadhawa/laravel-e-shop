<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Session;


class ProductsController extends Controller
{
    public function index(){

        $products = Product::paginate(6);

        return view('allproducts', compact("products"));
    }

    public function addProductToCart(Request $request, $id){

        //$request->session()->flush();

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $product = Product::find($id);
        $cart->addItem($id, $product);
        $request->session()->put('cart', $cart);

        return redirect()->route('allProducts')->withSuccess("Cart Updated!");

    }

    public function showCart(){

        $cart = Session::get('cart');

        if($cart){
            return view('cartproducts', ['cartItems' => $cart]);
        }
        else{
            return redirect()->route('allProducts');
        }
    }

    public function deleteItemFromCart(Request $request, $id){

        $cart = $request->session()->get('cart');

        if(array_key_exists($id, $cart->items)){
            unset($cart->items[$id]);
        }

        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriceAndQuantity();

        $request->session()->put('cart', $updatedCart);

        return redirect()->route('cartproducts');
    }

    public function createNewOrder(Request $request){

        $cart = Session::get('cart');

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $phone = $request->input('phone');
        $email = $request->input('email');

        if($cart){
            $date = date('Y-m-d H:i:s');
            $newOrderArray = array("status"=>"on hold", "order_date"=>$date, "del_date"=>$date, "price"=>$cart->totalPrice, "first_name"=>$first_name, "last_name"=>$last_name, "email"=>$email, "phone"=>$phone);
            $created_order = DB::table('orders')->insert($newOrderArray);

            $order_id = DB::getPdo()->lastInsertId();

            foreach($cart->items as $cart_item){
                $item_id = $cart_item['data']['id'];
                $item_name = $cart_item['data']['name'];
                $item_price = $cart_item['data']['price'];
                $newItemsInCurrentOrder = array("item_id"=>$item_id, "order_id"=>$order_id, "item_name"=>$item_name, "item_price"=>$item_price);

                $created_order_items = DB::table('order_items')->insert($newItemsInCurrentOrder);
            }

            $request->session()->flush();

            $payment_info = $newOrderArray;
            $payment_info['order_id'] = $order_id;
            $request->session()->put('payment_info', $payment_info);

            return redirect()->route('showPaymentPage');

        }
        else {
            return redirect()->route('allProducts');
        }
    }

    public function checkoutProducts(){
        return view('checkoutProducts');
    }
}
