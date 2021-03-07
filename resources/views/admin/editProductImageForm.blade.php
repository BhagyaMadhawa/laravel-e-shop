@extends('layouts.admin')

@section('body')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Product Image</h1>
</div>
<div class="row">
    <div class="table-responsive">
        <h3>Current Image</h3>
        <div>
            <img src="{{ Storage::disk('local')->url('product_images/'.$product['image']) }}" alt="<?php echo Storage::url($product['image']); ?>" width="100" height="100" style="max-height:220px" />
        </div>
        <form action="/admin/updateProductImage/{{ $product->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="image">Update Image</label>
                <input type="file" class="form-control" name="image" id="image" placeholder="Image" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
