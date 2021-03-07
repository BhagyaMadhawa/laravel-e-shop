@extends('layouts.admin')

@section('body')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
</div>
<div class="row">
    <div class="table-responsive">
        <form action="/admin/updateProduct/{{ $product->id }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value={{$product->name}} required>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Product description" value={{$product->description}} required>
            </div>
            <div class="form-group">
                <label for="name">Type</label>
                <input type="text" class="form-control" name="type" id="type" placeholder="Product type" value={{$product->type}} required>
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Product price" value={{$product->price}} required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
