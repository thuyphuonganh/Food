@extends('admin.layouts.master')

@section('content')
<h2>Trả lời liên hệ</h2>
<p><strong>Tên:</strong> {{ $contact->name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>

<form action="{{ route('admin.contacts.sendReply', $contact->id) }}" method="POST">
    @csrf
    <textarea name="message" rows="5" class="form-control"></textarea>
    <button type="submit" class="btn btn-primary mt-2">Gửi</button>
</form>
@endsection
