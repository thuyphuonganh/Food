{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('customer.layouts.master')
@section('content')
<style>
    body {
        background: #f7f7ff;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .me-2 {
        margin-right: .5rem !important;
    }
</style>
<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('images/user-icon.png') }}" alt="Admin"
                                class="rounded-circle p-1 bg-light" width="110">
                            <div class="mt-3">
                                <h4>{{ $user->name }}</h4>
                                <p class="text-secondary mb-1">{{ $user->email }}</p>
                                <p class="text-muted font-size-sm">{{ $user->address }}</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Học và tên</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $user->name }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" class="form-control"
                                        value="{{ $user->email }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ $user->phone }}" >
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Địa chỉ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="address" class="form-control"
                                        value="{{ $user->address }}">
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9 text-secondary">
                                    <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
                                </div>
                                @if (session('status') === 'profile-updated')
                                    <span class="d-flex justify-content-center fw-bold">Lưu thông tin thành
                                        công</span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nhập mật khẩu cũ</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="current_password"
                                        autocomplete="current-password" class="form-control">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Mật khẩu mới</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" name="password" autocomplete="new-password"
                                        class="form-control">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Xác nhận mật khẩu</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="password_confirmation" type="password" class="form-control"
                                        autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row">
    <div class="col-sm-9 text-secondary">
        <button type="submit" class="btn btn-primary px-4">Lưu thay đổi</button>
    </div>
</div>

@if (session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
@endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
