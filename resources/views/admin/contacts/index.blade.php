@extends('admin.layouts.master')

@section('title', 'Danh sách liên hệ')

@section('content')
<div class="container mt-4">
    <h1>Danh sách liên hệ</h1>

    @if($contacts->isEmpty())
        <p>Chưa có liên hệ nào.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center align-middle">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Ngày gửi</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ Str::limit($contact->message, 50) }}</td>
                    <td>
                        @if($contact->is_replied)
                            <span class="badge bg-success">✔ Đã phản hồi</span>
                        @else
                            <span class="badge bg-warning text-dark">⏳ Chưa phản hồi</span>
                        @endif
                    </td>
                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-info btn-sm">
                            Xem
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
