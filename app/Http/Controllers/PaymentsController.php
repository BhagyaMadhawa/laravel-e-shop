<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Session;


class PaymentsController extends Controller
{
    public function index(){

        $products = Product::paginate(6);

        return view('allproducts', compact("products"));
    }

    public function showPaymentPage(){
        $payment_info = Session::get('payment_info');

        if($payment_info["status"] == "on hold"){
            return view('paymentpage', ['payment_info' => $payment_info]);
        }
        else{
            return redirect()->route('allProducts');
        }

    }

    public function paymentReceipt(Request $request, $order_id){

        $affected = DB::table('orders')
              ->where('order_id', $order_id)
              ->update(['status' => "paid"]);

        return redirect()->route('allProducts')->withSuccess("Thank you for your payment");
    }


}
