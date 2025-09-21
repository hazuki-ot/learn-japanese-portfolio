@extends('layouts.app')

@section('title', 'Category Edit')
    
@section('content')
    <div class="card card-body border border-2 mt-3">
        <form action="{{ route('admin.category.update', $cate_id->id) }}" method="post">
            @csrf
            @method('PATCH')

            <label for="category" class="form-label">Edit Category</label>

            <div class="input-group">
                <input type="text" name="category" id="category" class="form-control" value="{{ $cate_id->category }}">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>

@endsection