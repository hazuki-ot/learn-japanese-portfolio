@extends('layouts.app')

@section('title', 'カタカナ')
    
@section('content')
    <div class="card card-body border border-2">
        <form action="{{ route('admin.katakana.store') }}" method="post">
            @csrf

            <label for="hiragana" class="form-label">Add Word （カタカナ）</label>

            <div class="mt-2">
                <select class="form-select" name="category" id="category">
                    <option selected>Choose the category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                </select>
            </div>

            <div class="input-group mt-2">
                <input type="text" name="katakana" id="katakana" class="form-control" placeholder="word">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
                {{-- Error --}}
                @error('katakana')
                    <div class="text-danger small">{{ $message }}</div>    
                @enderror

                @error('category')
                    <div class="text-danger small">{{ $message }}</div>    
                @enderror
        </form>
    </div>

    <div class="mt-5">
        <p class="fw-bold">There are {{ $words_count }} words in the database.</p>
    </div>

    <div class="mt-5">
        <p class="mb-0"><i class="fa-brands fa-searchengin"></i> Search カタカナ word you want to get here.</p>
        <form action="{{ route('admin.katakana.search') }}" style="with: 200px">
            <input type="search" name="search" placeholder="Saerch..." class="form-control form-control-sm">
        </form>
    </div>

@endsection