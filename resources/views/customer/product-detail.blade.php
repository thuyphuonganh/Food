@extends('customer.layouts.master')
@section('content')
    <div class="container animate-slide-up">
        <form action="{{ route('checkout.index') }}" method="post" id="formCartCheckout">
            @csrf
            <input type="hidden" name="selected_products" id="selected-products">
        </form>

        <h4 class="mt-3 mb-3">{{ $product->name }} - Chính hãng VN/A</h4>
        <div class="d-flex">
            <div class="card col-xl-7 col-lg-7 me-3 d-flex justify-content-center align-items-center" style="height: 400px;">
                <img src="{{ asset($product->image) }}" alt="" style="height: 350px;">
            </div>
            <div class="col-xl-5 col-lg-5">
                <p style="color: rgb(255,102,131); font-weight: bolder;font-size: 26px;">Giá: {{ $product->price }} đ</p>
                <p class="description-product mt-1"><strong>Tình trạng hàng: </strong>{{ $product->status }}</p>
                <p class="description-product mt-1"><strong>Danh mục: </strong>{{ $product->category->name }}</p>
                <div class="d-flex justify-content-center">
                    <button onclick="addProductToCart({{ $product->id }})" class="btn btn-outline-danger me-1"
                        style="width: 15%">
                        <div class="d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                            </svg>
                        </div>
                    </button>
                    <button class="btn btn-danger ms-1" onclick="buy({{ $product }})" style="width: 85%">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="ms-1" style="font-weight: bold">
                                MUA NGAY
                            </span>
                        </div>
                    </button>
                </div>
            </div>
        </div>


        <div class=" mt-5">
            <h4>THÔNG TIN SẢN PHẨM:</h4>
            <p class="description-product mt-2 ms-2">
                {{ $product->description }}
            </p>
        </div>

    </div>
    <script>
        function addProductToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const baseUrl = window.location.origin;
            const url = baseUrl + "/Shop/public/dashboard/cart"
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('productId', productId);
            formData.append('quantity', 1);
            formData.append('operator', 1);

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {

                    }
                    window.location.href = url;
                })
                .then(data => console.log(data))
                .catch(error => console.error(error));
            //document.getElementById('formCart' + productId).submit();
        }

        function buy(product) {
            let products = [];
            products.push({
                productId: product.id,
                name: product.name,
                image: product.image,
                price: product.price,
                quantity: 1
            });

            document.getElementById('selected-products').value = JSON.stringify(products);
            document.getElementById('formCartCheckout').submit()

        }
    </script>
@endsection
