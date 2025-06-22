@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách món ăn</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Thêm món ăn</a>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($products as $product)
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-muted">{{ $product->description }}</p>
                <p class="text-danger fw-bold">{{ number_format($product->price) }} đ</p>
                <a href="#" class="btn btn-danger"><i class="fa fa-cart-plus"></i> Đặt món</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

</div>
@endsection
