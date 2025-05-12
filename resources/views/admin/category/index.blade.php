@extends('admin.dashboard')
@section('title', 'Category manager')
@section('main')

<form action="" method="POST" class="form-inline" role="form">
    <a href="{{ route('admin.category.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new</a>
</form>


<br>


<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Category Name</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $key => $category)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $category->name }}</td>
            <td class="text-right">
                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@stop()
