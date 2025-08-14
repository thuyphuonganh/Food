@extends('admin.layouts.master')

@section('content')
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

    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Quay lại</a>
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
