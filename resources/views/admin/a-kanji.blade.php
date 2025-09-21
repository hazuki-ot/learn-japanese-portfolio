@extends('layouts.app')

@section('title', '漢字')
    
@section('content')
    <div class="card card-body border border-2">
        <form action="{{ route('admin.kanji.store') }}" method="post">
            @csrf

            <label for="hiragana" class="form-label">Add Word （漢字）</label>

            <div class="mt-2">
                <select class="form-select" name="category" id="category">
                    <option selected>Choose the category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                </select>
            </div>

            <div class="mt-2">
                <input type="text" name="kanji" id="kanji" class="form-control" placeholder="word">
                <input type="text" name="read" id="read" class="form-control mt-2" placeholder="how to read kanji">
                <button type="submit" class="btn btn-primary w-25 btn-sm mt-3">Add</button>
            </div>
                {{-- Error --}}
                @error('kanji')
                    <div class="text-danger small">{{ $message }}</div>    
                @enderror

                @error('read')
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
        <p class="mb-0"><i class="fa-brands fa-searchengin"></i> Search 漢字 word you want to get here.</p>
        <form action="{{ route('admin.kanji.search') }}" style="with: 200px">
            <input type="search" name="search" placeholder="Saerch..." class="form-control form-control-sm">
        </form>
    </div>

@endsection