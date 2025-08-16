@extends('admin.layouts.master')

@section('content')<div class="container animate-slide-up">
<div style="margin-top: 2rem;">
    <a href="{{ route('admin.contacts.index') }}" style="text-decoration: none;">
        <button style="
            height: 2.5rem;
            display: flex;
            align-items: center;
            background-color: #BB3E03;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0 1rem;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.backgroundColor='#EE9B00'; this.style.transform='scale(1.05)';"
        onmouseout="this.style.backgroundColor='#BB3E03'; this.style.transform='scale(1)';">
            <img src="{{ asset('images/arrow-left-icon.png') }}" alt="Quay lại" style="
                height: 20px;
                margin-right: 8px;
                transition: transform 0.3s ease;
            "
            onmouseover="this.style.transform='translateX(-3px)';"
            onmouseout="this.style.transform='translateX(0)';">
            Quay về
        </button></a>
<div class="container mt-4">
    <h2>Chi tiết liên hệ</h2>

    {{-- Trạng thái phản hồi --}}
    <p>
        <strong>Trạng thái:</strong>
        @if($contact->is_replied)
            <span class="badge bg-success">✔ Đã phản hồi</span>
        @else
            <span class="badge bg-warning text-dark">⏳ Chưa phản hồi</span>
        @endif
    </p>

    <p><strong>Tên:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Nội dung:</strong> {{ $contact->message }}</p>
    <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
</div>
</div>

{{-- Nếu đã phản hồi rồi thì ẩn form --}}
@if(!$contact->is_replied)
<h3>Trả lời liên hệ của khách hàng</h3>
<form action="{{ route('admin.contacts.sendReply', $contact->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="reply" class="form-label">Nội dung trả lời</label>
        <textarea name="message" id="reply" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Gửi phản hồi</button>
</form>
@else
<p class="mt-3 text-success">Bạn đã gửi phản hồi cho liên hệ này.</p>
@endif

@endsection
