@extends('layouts.app')

@section('title', 'Admin Pictures')
    
@section('content')
    <div class="row justify-content-center">
        <div class="col-1"></div>
        <div class="col-6 card card-body">
            <form action="{{ route('admin.pictures.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mt-2 col-10 ms-4 mx-auto">
                    <label for="image" class="form-label fw-bold">Add Image</label>
                    <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
                    <div id="image-info" class="form-text">
                        The acceptable formats are jpeg, jpg, png, and gif only. <br>
                        Max file size is 1048KB.
                    </div> 

                    <label for="name" class="form-label fw-bold mt-3">Image About</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="image name here"> 

                    {{-- <label for="sound" class="form-label fw-bold mt-3">Add Sound （Japanese）</label>
                    <input type="file" name="sound" id="sound" accept="audio/*" class="form-control" aria-describedby="sound-info">
                    <div id="sound-info" class="form-text">
                        Max file size is 20MB.
                    </div>  --}}

                    <div class="mt-2">
                        <label for="category" class="form-label fw-bold mt-3">Category</label>
                        <select class="form-select" name="category" id="category">
                            <option selected>Choose the category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                        </select>
                    </div>
                    {{-- Error --}}
                    @error('image')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror

                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror

                    {{-- @error('sound')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror --}}

                    @error('category')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror

                    <button type="submit" class="btn btn-primary px-5 mt-3">Add</button>
                </div>
            </form>
        </div>

        <div class="col-4 text-end">
            <a href="https://ttsmp3.com/" class="btn">making sound <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
    <div class="mt-5">
        <div class="row">
            <div class="col-6">
                <p class="fw-bold">There are {{ $pictures_count }} pictures in the database.</p>
            </div>
            <div class="col-6">
                <div class="me-auto">
                    <p class="mb-0">Search Image you want to get here.</p>
                    <form action="{{ route('admin.pictures.search') }}" style="with: 200px">
                        <input type="search" name="search" placeholder="Saerch..." class="form-control form-control-sm">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection