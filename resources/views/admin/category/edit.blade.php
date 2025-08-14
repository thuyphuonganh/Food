@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="mt-2 ms-2">
            <h1>Sửa danh mục</h1>
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" role="form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <input type="text" style="width: 40%" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-save"></i>Lưu</button>
        </form>

        </div>
    </div>
@endsection
