
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
            object-fit: cover; /* Dùng 'cover' để ảnh gấu bông hiển thị đẹp */
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

        /* Hiệu ứng cho tiêu đề phần */
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
            /*background-color: #000000;  Màu hồng phấn hợp với gấu bông */
            transition: width 0.3s ease;
        }

        .section-title:hover::after {
            width: 100%;
        }

        /* Định dạng phần giới thiệu cửa hàng */
        .about-section {
            background-color: #ffffff; /* Nền hồng nhạt dễ thương */
            padding: 3rem 0;
        }

        .about-img {
            width: 100%;
            height: auto;
            border-radius: 15px; /* Bo góc mềm mại */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container my-5">
        <!-- Phần 1: Giới thiệu về cửa hàng bán gấu bông -->
        <section class="about-section">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="section-title">Về Cửa Hàng Gấu Bông Yêu Thương</h2>
                    <p>Chào mừng bạn đến với Gấu Bông Yêu Thương! Chúng tôi tự hào mang đến những chú gấu bông đáng yêu, được làm thủ công với tình yêu và sự tỉ mỉ. Thành lập từ năm 2015, cửa hàng của chúng tôi đã trở thành điểm đến yêu thích cho những ai tìm kiếm món quà ý nghĩa.</p>
                    <p>Mỗi chú gấu bông được làm từ chất liệu mềm mại, an toàn cho cả trẻ em và người lớn, đảm bảo mang lại cảm giác ấm áp như một cái ôm. Sứ mệnh của chúng tôi là lan tỏa niềm vui và yêu thương qua từng sản phẩm.</p>
                </div>

            </div>
        </section>

        <!-- Phần 2: Giới thiệu gấu bông chất lượng -->
        <section class="my-5">
            <h2 class="text-center section-title">Gấu Bông Chất Lượng Của Chúng Tôi</h2>
            <div class="row row-all">
                <!-- Gấu bông 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <img src="{{ asset('images/CanhCutBongDeoYemKhongLo5.jpg') }}" class="card-img-top image-card" alt="Gấu nâu classic">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gấu Cánh Cụt</h5>
                            <p class="card-text">Chú gấu cánh cụt mềm mại, kích thước 30cm, làm từ lông tơ cao cấp, hoàn hảo để ôm và trang trí phòng.</p>
                        </div>
                    </div>
                </div>

                <!-- Gấu bông 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <img src="{{ asset('images/GauBongStitchOmVit4.jpg') }}" class="card-img-top image-card" alt="Gấu hồng phấn">
                        <div class="card-body text-center">
                            <h5 class="card-title">Gấu Stitch</h5>
                            <p class="card-text">Gấu Stitch phấn dễ thương, kích thước 25cm, chất liệu hữu cơ an toàn, phù hợp cho trẻ em.</p>
                        </div>
                    </div>
                </div>

                <!-- Gấu bông 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card card-hover">
                        <img src="{{ asset('images/20230701_Np3P8aWu.jpg') }}" class="card-img-top image-card" alt="Gấu trắng jumbo">
                        <div class="card-body text-center">
                            <h5 class="card-title">Mèo DUDU</h5>
                            <p class="card-text">Mèo bông trắng khổng lồ, kích thước 60cm, siêu mềm, lý tưởng để làm quà tặng đặc biệt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

