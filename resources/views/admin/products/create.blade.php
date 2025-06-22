@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg mt-10">
    <h2 class="text-2xl font-bold text-center text-green-600 mb-6">Thêm Món Ăn Mới</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Tên món ăn</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Giá tiền (VNĐ)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Mô tả món ăn</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Hình ảnh</label>
            <input type="file" name="image"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded file:border-0 file:text-sm file:font-semibold
                          file:bg-green-100 file:text-green-700 hover:file:bg-green-200" />
        </div>

        <div class="text-center">
            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded font-semibold">
                Lưu món ăn
            </button>
        </div>
    </form>
</div>
@endsection
