@extends('layouts.index')

@section('center')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping cart</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="shopper-info">
                        <p>Payment Summary</p>
                        <div class="form-one">
                            <div class="total_area">
                                <form action="/paymentReceipt/{{$payment_info['order_id']}}" method="post">
                                    {{ csrf_field() }}
                                <ul>
                                    <li>
                                        Payment Status <span>{{$payment_info['status']}}</span>
                                    </li>
                                    <li>
                                        Shipping Cost <span>Free</span>
                                    </li>
                                    <li>
                                        Total <span>{{$payment_info['price']}}</span>
                                    </li>
                                </ul>
                                <a class="btn btn-primary" href="{{ route('allProducts') }}">Update</a>
                                <button class="btn btn-default check_out" type="submit" name="submit">Pay Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
