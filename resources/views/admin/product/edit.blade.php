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
            <h1>Chỉnh sửa sản phẩm</h1>
            
        </div>
    </div>
@endsection
