@extends('layouts.admin')

@section('body')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Edit Image</th>
                    <th>Edit</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td><img src="{{ Storage::disk('local')->url('product_images/'.$product['image']) }}" alt="<?php echo Storage::url($product['image']); ?>" width="100" height="100" style="max-height:220px" /></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ $product['type'] }}</td>
                    <td>${{ $product['price'] }}</td>
                    <td><a href="{{ route('adminEditProductImageForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit Image</a></td>
                    <td><a href="{{ route('adminEditProductForm', ['id' => $product['id']]) }}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{ route('adminDeleteProduct', ['id' => $product['id']]) }}" class="btn btn-danger">Remove</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection
