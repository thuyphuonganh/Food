@extends('admin.layouts.master')

@section('search')
    <form action="" class="d-flex ms-3" method="GET">
        <input class="form-control me-1" type="search" name="search" placeholder="Nhập danh mục" aria-label="Search"
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
            <h1>Danh mục</h1>
            <form action="{{ route('admin.category.store') }}" method="POST" role="form">
                @csrf <!-- Token bảo mật CSRF -->

                <div class="form-group mb-3">
                    <label class="mt-3 mb-2 fw-bold" for="name">Thêm danh mục</label>
                    <div class="d-flex">
                        <input style="width: 30%" type="text" class="form-control me-2" id="name" name="name"
                            placeholder="Nhập tên danh mục" value="{{ old('name') }}" required>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Lưu</button>
                    </div>

                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>


            <span class="fw-bold">Tất cả danh mục</span>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Số thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
