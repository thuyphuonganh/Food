@extends('admin.dashboard')
@section('title', 'Edit a Category')

@section('main')
<div class="row">
    <div class="col-md-4">
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" role="form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </form>
    </div>
</div>
@stop
