@extends('admin.dashboard')
@section('title', 'Create new Category')
@section('main')

<div class="row">
    <div class="col-md-4">

        <form action="{{ route('admin.category.store') }}" method="POST" role="form">
            @csrf  <!-- Token bảo mật CSRF -->

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Input category name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </form>

    </div>
</div>

@stop()
