@extends('customer.layouts.master')
@section('content')
    <div class="container">
        <form action="{{ route('search') }}" method="GET" class="">
            <div class="d-flex">
                <input class="form-control mt-3" type="search" name="search" placeholder="Search" aria-label="Search"
                    style="width: 20%" value="{{ request('search') }}">
                <button class="btn btn-primary ms-2 mt-3" type="submit">Search</button>
                <select class="form-select ms-auto mt-3" name="order" id="exampleSelect">
                    <option @selected(request('order') == 'asc') value="asc">Lọc theo giá: từ thấp đến cao</option>
                    <option @selected(request('order') == 'desc') value="desc">Lọc theo giá: từ cao đến thấp</option>
                </select>
            </div>
        </form>

        <div class="product-grid" id="productGrid">
            @forelse ($products as $product)
                <a href="{{ route('productDetail', ['id' => $product->id]) }}" class="product-link">
                    <div class="product-item">
                        <img src="{{ asset($product->image) }}" alt="">
                        <p class="card-title">{{ $product->name }}</p>
                        <span>{{ $product->price }}đ</span>
                        <button>Mua</button>
                    </div>
                </a>
            @empty
                <h5>Not Product</h5>
            @endforelse

        </div>
        <div class="mt-3">
            {{ $products->links() }}
        </div>


    </div>
@endsection
