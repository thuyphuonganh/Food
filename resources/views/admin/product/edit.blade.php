@extends('admin.layouts.master')

@section('content')
<div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('admin.product.index') }}" style="text-decoration: none;">
        <button style="
            height: 2.5rem;
            display: flex;
            align-items: center;
            background-color: #BB3E03;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0 1rem;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.backgroundColor='#EE9B00'; this.style.transform='scale(1.05)';"
        onmouseout="this.style.backgroundColor='#BB3E03'; this.style.transform='scale(1)';">
            <img src="{{ asset('images/arrow-left-icon.png') }}" alt="Quay lại" style="
                height: 20px;
                margin-right: 8px;
                transition: transform 0.3s ease;
            "
            onmouseover="this.style.transform='translateX(-3px)';"
            onmouseout="this.style.transform='translateX(0)';">
            Quay về
        </button></a>
    <div class="container-fluid">
        <div class="mt-2 ms-2">
            <h2>Chỉnh sửa món ăn</h2>
            <div class="card">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <div class="d-flex align-items-center mt-3">
                            <span class="fw-bold col-md-1 ms-5">Tên</span>
                            <input type="text" class="form-control col-md-11 w-50" name="name" placeholder="Nhập tên sản phẩm"
                                value="{{ $product->name }}">
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center mt-3">
                            <span class="fw-bold col-md-1 ms-5">Giá</span>
                            <input type="text" class="form-control col-md-11 w-50" name="price" placeholder="Nhập giá sản phẩm"
                                value="{{ $product->price }}">
                        </div>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>



                    <div class="form-group">
                        <div class="d-flex align-items-center mt-3">
                            <span class="fw-bold col-md-1 ms-5">Mô tả</span>
                            <textarea name="description" class="form-control description w-50" placeholder="Nhập mô tả sản phẩm">{{ $product->description }}</textarea>
                        </div>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-items-center mt-3">
                            <span class="fw-bold ms-5 col-md-1">Danh mục</span>
                            <select name="category_id" class="form-control w-50">
                            <option value="">Danh mục sản phẩm</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>

                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-items-center mt-3">
                            <span class="fw-bold ms-5 col-md-1">Trạng thái</span>
                            <select name="status" class="form-control w-50">
                            <option value="in-stock" {{ $product->status == 'in-stock' ? 'selected' : '' }}>Còn hàng</option>
                            <option value="out-stock" {{ $product->status == 'out-stock' ? 'selected' : '' }}>Hết hàng
                            </option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-flex align-items-center mt-3">
                            <span class="fw-bold ms-5 col-md-1">Đăng tải ảnh</span>
                            <input type="file" name="image" class="form-control w-50">
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center mt-3 ms-5">
                        <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-save"></i>Lưu</button>
                    </div>

                </form>
            </div>

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
