@extends('admin.dashboard')
@section('title', 'Product Manager')
@section('main')

<form action="" method="GET" class="form-inline" role="form">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Search product..." value="{{ request()->search }}">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('admin.product.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>

<br>

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Status</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
            <td>
                @if (!empty($product->image))
                    <img src="{{ asset($product->image) }}" width="50"> <!-- Hiển thị ảnh từ thư mục public/images -->
                @else
                    <span>No image</span>
                @endif
            </td>

            <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
            <td>
                <span class="badge badge-{{ $product->status == 'in-stock' ? 'success' : 'secondary' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </td>
            <td class="text-right">
                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
  
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                <!-- Centered Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>

                @if ($products->total() > 0)
                    <div class="text-center mt-2 small text-muted">
                        Hiển thị {{ $products->firstItem() }} đến {{ $products->lastItem() }} trong tổng số {{ $products->total() }} kết quả
                    </div>
                @endif


@stop
