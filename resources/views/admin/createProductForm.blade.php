@extends('layouts.admin')

@section('body')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
</div>
<div class="row">
    <div class="table-responsive">
        <form action="/admin/insertProduct" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="" required>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Product description" value="" required>
            </div>
            <div class="form-group">
                <label for="image">Update Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="Image" required>
            </div>
            <div class="form-group">
                <label for="name">Type</label>
                <input type="text" class="form-control" name="type" id="type" placeholder="Product type" value="" required>
            </div>
            <div class="form-group">
                <label for="name">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Product price" value="" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
