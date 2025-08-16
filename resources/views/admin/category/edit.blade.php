@extends('admin.layouts.master')

@section('content')
<div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('admin.category.index') }}" style="text-decoration: none;">
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
