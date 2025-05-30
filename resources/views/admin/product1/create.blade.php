@extends('admin.dashboard')

@section('title', 'Create a New Product')

@section('main')
<div class="row">
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-9">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter product name" value="{{ old('name') }}">
                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>


            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea name="description" class="form-control description" placeholder="Enter product description">{{ old('description') }}</textarea>
                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="category_id">Product Category</label>
                <select name="category_id" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="text" name="price" class="form-control" placeholder="Enter price" value="{{ old('price') }}">
                @error('price')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="form-group">
                <label for="status">Product Status</label>
                <select name="status" class="form-control">
                    <option value="in-stock" {{ old('status') == 'in-stock' ? 'selected' : '' }}>Còn hàng</option>
                    <option value="out-stock" {{ old('status') == 'out-stock' ? 'selected' : '' }}>Hết hàng</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" class="form-control" onchange="showImage(this)">
                <img id="show_img" src="" alt="" width="100%">
                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>
@stop()

@section('css')
<link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()

@section('js')
<script src="ad_assets/plugins/summernote/summernote.min.js"></script>
<script>
    $('.description').summernote({
        height: 250
    });

    function showImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('show_img').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@stop()
