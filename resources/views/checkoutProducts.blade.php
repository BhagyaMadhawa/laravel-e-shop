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
                        <p>Shopper Information</p>
                        <form action="/product/createNewOrder" method="post">
                            {{ csrf_field() }}
                            <input type="text" name="email"  placeholder="Email">
                            <input type="text" name="first_name"  placeholder="First Name">
                            <input type="text" name="last_name"  placeholder="Last Name">
                            <input type="text" name="phone" placeholder="Phone *">
                            <button class="btn btn-default check_out" type="submit" name="submit">Proceed to Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
