@extends('admin.layouts.master')

@section('search')
    <form action="" class="d-flex ms-3" method="GET">
        <input class="form-control me-1" type="search" name="search" placeholder="Nhập sản phẩm" aria-label="Search"
            style="background-color: #F8F9FC; border: 0.5px solid rgb(238, 237, 237)" value="{{ request('search') }}">
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
            <h2>Danh sách món ăn</h2>
            <form action="" method="GET" class="form-inline mt-3" role="form">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary pull-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Thêm món ăn
                </a>
            </form>
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên món</th>
                        <th>Giá bán</th>
                        <th>Ảnh</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th class="text-right">Tùy chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                            <td>
                                @if (!empty($product->image))
                                    <img src="{{ asset($product->image) }}" width="50">
                                    <!-- Hiển thị ảnh từ thư mục public/images -->
                                @else
                                    <span>No image</span>
                                @endif
                            </td>

                            <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                            <td>
                                @if($product->status == 'in-stock')
                                    Còn món
                                @elseif($product->status == 'out-stock')
                                    Hết món
                                @else
                                    Không xác định
                                @endif
                            </td>



                            <td class="text-right">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary">
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
            <div class="row mt-3">
                {{ $products->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
@endsection
