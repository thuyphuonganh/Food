<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trang Chủ - Food Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Đảm bảo đang dùng Vite -->
</head>
<body>
    <div class="container mt-4">
        <header class="bg-primary text-white p-3 rounded">
            <h1>🍽️ Chào mừng đến với Food Order</h1>
        </header>

        <nav class="mt-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#">Trang Chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Thực Đơn</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Giỏ Hàng</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Liên Hệ</a></li>
            </ul>
        </nav>

        <section class="mt-4">
            <div class="alert alert-success text-center">Khuyến mãi hôm nay: Mua 2 tặng 1 🎉</div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Món ăn">
                        <div class="card-body">
                            <h5 class="card-title">Phở Bò</h5>
                            <p class="card-text">Đậm đà, thơm ngon, truyền thống.</p>
                            <a href="#" class="btn btn-success">Đặt món</a>
                        </div>
                    </div>
                </div>
                <!-- Lặp thêm các món khác ở đây -->
            </div>
        </section>
    </div>
</body>
</html>
