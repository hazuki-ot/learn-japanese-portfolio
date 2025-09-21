@extends('layouts.app')

@section('title', 'Edit Language')
    
@section('content')
    <div class="card card-body border border-2">
        <form action="{{ route('admin.language.update', $language->id) }}" method="post">
            @csrf
            @method('PATCH')

            <label for="language" class="form-label">Edit Language</label>

            <div class="input-group">
                <input type="text" name="language" id="language" class="form-control" value="{{ $language->language }}">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
@endsection