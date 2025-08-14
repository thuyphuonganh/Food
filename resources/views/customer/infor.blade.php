@extends('customer.layouts.master')

@section('content')
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background-color: #f2f4f5;
        }

        .image-card {
            height: 19rem;
            width: 100%;
            object-fit: cover;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        @media (min-width: 768px) {
            .card {
                width: 100%;
                height: 27rem;
            }
        }

        @media (max-width: 767.98px) {
            .row-all {
                justify-content: center;
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin: 0 auto;
                padding: 0 1rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }

            .card {
                width: 80%;
                height: 25rem;
            }
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50%;
            height: 3px;
            transition: width 0.3s ease;
        }

        .section-title:hover::after {
            width: 100%;
        }

        .about-section {
            background-color: #ffffff;
            padding: 3rem 0;
        }

        .about-img {
            width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .section-title {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem;
    color: #ff6600; /* Màu cam */
    font-weight: bold;
}
.section-title::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 50%;
    height: 3px;
    background-color: #ff6600; /* Màu gạch chân */
    transition: width 0.3s ease;
}
.section-title:hover::after {
    width: 100%;
}

    </style>

    <div class="container my-5">
        <!-- Phần 1: Giới thiệu -->
<section class="about-section">
    <div class="row align-items-center">
        <!-- Cột hình ảnh bên trái -->
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('images/logo_auth.png') }}" 
                 alt="Về Food" 
                 class="about-img">
        </div>

        <!-- Cột nội dung bên phải -->
        <div class="col-md-6">
            <h2 class="section-title">Về Food</h2>
            <p>Chào mừng bạn đến với <strong>Food - Fuel your day with flavor</strong> – nơi mang đến những bữa ăn ngon miệng, an toàn và tiện lợi mỗi ngày.  
                Chúng tôi ra đời với sứ mệnh mang hương vị ẩm thực phong phú từ khắp nơi đến bàn ăn của bạn, với nguyên liệu tươi sạch và quy trình chế biến đảm bảo vệ sinh.</p>
            <p>Food không chỉ là nơi bán đồ ăn, mà còn là cầu nối để lan tỏa sự ấm áp, niềm vui và sự tiện lợi trong từng bữa ăn.  
                Dù bạn bận rộn hay muốn thưởng thức món ngon tại nhà, Food luôn sẵn sàng phục vụ.</p>
        </div>
    </div>
</section>


        <!-- Phần 2: Chính sách -->
        <section class="my-5">
            <h2 class="text-center section-title">Chính Sách & Cam Kết</h2>
            <div class="row row-all">
                <!-- Chính sách 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <img src="{{ asset('images/camket1.png') }}" class="card-img-top image-card" alt="Nguyên liệu tươi">
                        <div class="card-body text-center">
                            <h5 class="card-title">Nguyên Liệu Tươi Sạch</h5>
                            <p class="card-text">Tất cả nguyên liệu được chọn lọc kỹ lưỡng từ các nhà cung cấp uy tín, đảm bảo độ tươi ngon và an toàn.</p>
                        </div>
                    </div>
                </div>

                <!-- Chính sách 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <img src="{{ asset('images/camket2.png') }}" class="card-img-top image-card" alt="Giao hàng nhanh">
                        <div class="card-body text-center">
                            <h5 class="card-title">Giao Hàng Nhanh</h5>
                            <p class="card-text">Đặt món chỉ trong vài thao tác, chúng tôi sẽ giao tận nơi nhanh chóng để bạn thưởng thức khi còn nóng hổi.</p>
                        </div>
                    </div>
                </div>

                <!-- Chính sách 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <img src="{{ asset('images/camket3.png') }}" class="card-img-top image-card" alt="An toàn thực phẩm">
                        <div class="card-body text-center">
                            <h5 class="card-title">An Toàn Thực Phẩm</h5>
                            <p class="card-text">Tuân thủ nghiêm ngặt quy định vệ sinh an toàn thực phẩm để đảm bảo sức khỏe cho khách hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
