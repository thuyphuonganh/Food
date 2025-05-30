@extends('admin.layouts.master')

@section('search')
    <form action="" class="d-flex ms-3" method="GET">
        <input class="form-control me-1" type="search" name="search" placeholder="Nhập sản phẩm" aria-label="Search"
            style="background-color: #F8F9FC; border: 0.5px solid rgb(238, 237, 237)">
        <button class="btn btn-primary" type="submit">
            <svg style="width: 20px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
        </button>
    </form>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mt-2 ms-2">
            <h1>Thêm sản phẩm</h1>
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <span class="fw-bold">Tên sản phẩm</span>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm"
                        value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <span class="fw-bold">Mô tả sản phẩm</span>
                    <textarea name="description" class="form-control description" placeholder="Nhập mô tả sản phẩm">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <span class="fw-bold">Danh mục sản phẩm</span>
                    <select name="category_id" class="form-control">
                        <option value="">Danh mục sản phẩm</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <span class="fw-bold">Giá sản phẩm</span>
                    <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm"
                        value="{{ old('price') }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <span class="fw-bold">Trạng thái sản phẩm</span>
                    <select name="status" class="form-control">
                        <option value="in-stock" {{ old('status') == 'in-stock' ? 'selected' : '' }}>Còn hàng</option>
                        <option value="out-stock" {{ old('status') == 'out-stock' ? 'selected' : '' }}>Hết hàng
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <span class="fw-bold">Đăng tải ảnh sản phẩm</span>
                    <input type="file" name="image" class="form-control" onchange="showImage(this)">
                    {{-- <img id="show_img" src="" alt="" width="100%"> --}}
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-save"></i> Save</button>
            </form>
        </div>
    </div>
    <script>
        $('.description').summernote({
            height: 250
        });

        function showImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('show_img').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
