@extends('customer.layouts.master')
@section('content')
    <div class="container animate-slide-up">
        <form action="{{ route('checkout.index') }}" method="post" id="formCartCheckout">
            @csrf
            <input type="hidden" name="selected_products" id="selected-products">
        </form>

        <div class="mt-5 d-flex flex-column flex-md-row">
            <div class="col-xl-5 col-lg-5 me-3 d-flex justify-content-center align-items-center">
                <img src="{{ asset($product->image) }}" class="image-product" alt="">
            </div>

            <div class="col-xl-7 col-lg-7 mt-3">
                <h1 class="name-product">{{ $product->name }}</h1>
                <p class="price-product">{{ $product->price }}đ</p>
                <div class="d-flex">
                    <div class="col-6">
                        <strong>Tình trạng hàng:</strong>
                        <p class="description-product mt-1">{{ $product->status }}</p>
                    </div>
                    <div class="col-6 text-center">
                        <strong>Phân loại:</strong>
                        <p class="description-product mt-1">{{ $product->category->name }}</p>
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <button onclick="addProductToCart({{ $product->id }})" class="btn btn-primary btn-general me-1">
                        <div class="d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" />
                            </svg>
                            <span class="btn-action ms-1">
                                THÊM VÀO GIỎ HÀNG
                            </span>
                        </div>

                    </button>
                    <button class="btn btn-success btn-general ms-1" onclick="buy({{ $product }})">
                        <div class="d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                                <path d="M19 21v1m0 -8v1" />
                                <path
                                    d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                                <path
                                    d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                                <path d="M8 14v.01" />
                                <path d="M8 17v.01" />
                                <path d="M12 13.99v.01" />
                                <path d="M12 17v.01" />
                            </svg>
                            <span class="btn-action ms-1">
                                THANH TOÁN
                            </span>
                        </div>
                    </button>
                </div>
                <div class="d-flex mt-3 text-des">
                    <ul class="list-unstyled me-auto">
                        <li>✔ 100% bông trắng tinh khiết</li>
                        <li>✔ Bảo hành đường chỉ 1 tháng</li>
                        <li>✔ Miễn phí Gói quà</li>
                        <li>✔ Miễn phí Nén chân không gấu</li>
                    </ul>
                    <ul class="list-unstyled">
                        <li>✔ 100% ảnh chụp tại shop</li>
                        <li>✔ Bảo hành Bông gấu 6 tháng</li>
                        <li>✔ Miễn phí Tặng thiệp</li>
                    </ul>
                </div>
                <p class="highlight mt-3">HÀ NỘI | 8:30 - 23:00</p>
                <ul class="list-unstyled text-des">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        275 Bạch Mai, Hai Bà Trưng, Hà Nội - 0979896616
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        368 Nguyễn Trãi, Trung Văn (Phùng Khoang) - 033.567.6616
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        411 Nguyễn Văn Cừ, Long Biên - 034.369.6616
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        161 Xuân Thủy, Cầu Giấy - 033.876.6616
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        104 - 106 Cầu Giấy - 03.9799.6616
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        1028 Đường Láng, Đống Đa - 035.369.6616
                    </li>
                </ul>
                <p class="highlight mt-3">HỒ CHÍ MINH | 8:30 - 23:000</p>
                <ul class="list-unstyled text-des">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-pin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18.364 4.636a9 9 0 0 1 .203 12.519l-.203 .21l-4.243 4.242a3 3 0 0 1 -4.097 .135l-.144 -.135l-4.244 -4.243a9 9 0 0 1 12.728 -12.728zm-6.364 3.364a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z"
                                style="color: gray" />
                        </svg>
                        228 Lê Văn Sỹ, Phường 1, Tân Bình - 097 989 6616
                    </li>
                </ul>
            </div>
        </div>


        <div class="tab-content" id="nav-tabContent">
            <span>THÔNG TIN SẢN PHẨM:</span>
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <p class="description-product mt-2 ms-2">
                    {{ $product->description }}
                </p>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div>
                    Vậy là dù bạn ở bất cứ nơi đâu cũng đều có thể đặt hàng online Gấu Bông một cách dễ dàng rồi nè, nhân
                    viên
                    bán hàng sẽ tư vấn đầy đủ từ lúc chọn gấu, đến cách thức mua hàng, giao hàng, thời gian giao, địa điểm
                    và
                    còn viết thiệp nữa đó.
                    Hãy đến ngay với Gấu Bông Online để chọn những món quà Gấu bông dễ thương cho những người thân yêu của
                    mình
                    nhé! <br>
                    ************************************ <br>
                    Nếu quý khách cần copy STK thì copy thông tin dưới đây nhé:
                    <br>

                    THÔNG TIN CHUYỂN KHOẢN <br>

                    + VIETCOMBANK <br>

                    STK : 0011004157606 <br>
                    Ngân hàng Ngoại Thương- Chi nhánh Láng Thượng <br>
                    Chủ TK : Nguyễn Phương Hoa <br>
                    + VIETINBANK

                    STK: 109004283283 <br>
                    Ngân hàng Công Thương Việt Nam – Chi nhánh Chùa Láng <br>
                    Chủ TK: Nguyễn Phương Hoa <br>
                    + AGRIBANK

                    STK: 1400205420139 <br>
                    Ngân hàng Nông nghiệp – Chi nhánh Láng Hạ <br>
                    Chủ TK: Nguyễn Phương Hoa <br>
                    + BIDV <br>

                    STK: 45010002406871 <br>
                    Ngân hàng Đầu tư & Phát triển Việt Nam – Chi nhánh Hà Tây <br>
                    Chủ TK: Nguyễn Phương Hoa <br>
                    + TECHCOMBANK <br>

                    STK: 13324816911019 <br>
                    Ngân hàng Kỹ Thương – Chi nhánh Láng Hạ <br>
                    Chủ TK: Nguyễn Phương Hoa <br>
                    + SACOMBANK <br>

                    STK: 020052529851 <br>
                    Ngân hàng Sài Gòn Thương Tín – Chi nhánh Từ Liêm <br>
                    Chủ TK: Nguyễn Phương Hoa
                    + ACB <br>

                    STK: 1395497 <br>
                    Ngân hàng Á Châu – Chi nhánh Láng thượng <br>
                    Chủ TK: Nguyễn Phương Hoa <br>
                </div>

            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                1. CHÍNH SÁCH BẢO HÀNH <br>

                Điều kiện áp dụng: <br>

                – Khách hàng vui lòng xuất trình hóa đơn mua hàng (ảnh chụp lại hóa đơn). Hoặc có tin nhắn/ inbox chứng minh
                mua sản phẩm tại shop <br>

                – Sản phẩm được bảo hành miễn phí trong suốt thời gian sử dụng trong các trường hợp sau: <br>

                Gấu bục rách, đứt chỉ trong quá trình sử dụng. <br>
                Các chi tiết trang trí, phụ kiện (nơ,hoa đính ) bị rơi hoặc lỏng. <br>
                Không bảo hành sản phẩm đối với các trường hợp: Phụ kiện mắt mũi , nơ mất hẳn. <br>
                BẢO HÀNH 3 THÁNG VỀ CHẤT LƯỢNG BÔNG: nếu bị xẹp cửa hàng sẽ hỗ trợ đánh tơi bông hoặc nhồi thêm bông. <br>

                2. QUY ĐỊNH ĐỔI TRẢ SẢN PHẨM <br>

                Đổi sản phẩm trong vòng 2 ngày kể từ ngày mua và chỉ đổi 01 lần duy nhất với giá trị bằng hoặc cao hơn, nếu
                thấp hơn khách hàng sẽ bị trừ 20% số tiền chênh lệch. <br>
                Sản phẩm đổi phải còn hóa đơn hoặc tin nhắn xác nhận mua hàng
                (Khách hàng gọi điện ngay thông báo đến cửa hàng không quá 5h kể từ khi nhận sản phẩm ) <br>
                Trả lại sản phẩm: khách hàng được trả trong vòng 2 ngày kể từ ngày mua và trừ 20% giá trị ban đầu. <br>
                Chỉ áp dụng với các sản phẩm phải còn nguyên vẹn, gấu: mắt, mũi, áo, phụ kiện… <br>
                CỬA HÀNG CÓ HỖ TRỢ : <br>

                – Giặt Gấu và kiểm tra chất lượng Gấu: <br>

                Nhận cả gấu khách mua bên ngoài, gấu ko mua tại cửa hàng.
                Kiểm tra Bông bên trong gấu trước khi giặt. ( Đa số sản phẩm mua vỉa hè đều là độn MÚT BẨN hoặc VẢI VỤN
                BẨN). <br>
                Nếu bông gấu là vải vụn hoặc bẩn thì khách có thể thay bằng toàn bộ bông trắng xoắn 3 chiều của shop (giá
                bông tính theo kg) <br>
                – Nhận lấy Gấu tận nhà: <br>

                Quý khách chỉ cần gọi điện, shop sẽ cho người đến tận nhà: LẤY GẤU – GIẶT SẠCH – TRẢ GẤU TẬN NHÀ <br>
                Giá giặt sẽ rẻ hơn ngoài tiệm giặt, và sẽ được giặt gấu theo đúng quy trình và tiêu chuẩn riêng dành cho gấu
                <br>
                bông (giá giặt theo kích thước mỗi loại- Giá ship sẽ đc tính theo từng khu vực). <br>
            </div>
        </div>

    </div>
    <script>
        function addProductToCart(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const baseUrl = window.location.origin;
            const url = baseUrl + "/shop/public/dashboard/cart"
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
                        window.location.href = url;
                    }
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
