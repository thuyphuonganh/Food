@extends('customer.layouts.master')

@section('content')
<style>
    .contact-section {
        padding: 3rem 0;
    }
    .contact-info i {
        font-size: 1.5rem;
        color: #ff6600;
        margin-right: 10px;
    }
    .contact-card {
        border-radius: 15px;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .map-container iframe {
        border-radius: 15px;
        width: 100%;
        height: 350px;
        border: none;
    }
</style>

<div class="container contact-section">
    <h2 class="text-center mb-5 text-warning">Liên Hệ</h2>
    <div class="row g-4">
        
        <!-- Thông tin liên hệ -->
        <div class="col-md-5">
            <div class="contact-card">
                <h4 class="mb-4">Thông tin liên hệ</h4>
                <p class="contact-info"><i class="fas fa-map-marker-alt"></i>138z3/20 Nguyễn Văn Cừ nối dài, Ninh Kiều, TP.Cần Thơ</p>
                <p class="contact-info"><i class="fas fa-phone"></i> 0969 726 955</p>
                <p class="contact-info"><i class="fas fa-envelope"></i> food@email.com</p>
            </div>
        </div>

        <!-- Form liên hệ -->
        <div class="col-md-7">
            <div class="contact-card">
                <h4 class="mb-4">Gửi tin nhắn cho chúng tôi</h4>
                <form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Họ và tên</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Nhập họ tên">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email">
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Nội dung</label>
        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Nhập tin nhắn"></textarea>
    </div>
    <button type="submit" class="btn btn-warning text-white">Gửi</button>
</form>

            </div>
        </div>

    </div>

    <!-- Bản đồ -->
    <div class="row mt-5">
        <div class="col-12 map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d491.09039131083034!2d105.76092797029489!3d10.039690615048801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1754933840430!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endsection
