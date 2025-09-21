@extends('layouts.app')

@section('title', 'Sound')
    
@section('content')
    <div class="row">
        <div class="col-8 ms-4">
            <form action="{{ route('admin.sound.store') }}" method="post" enctype="multipart/form-data" class="ms-4">
                @csrf

                <div class="mt-2 col-10 ms-4">
                    <h2 class="text-center">Add Sound</h2>
                    
                    <label for="name" class="form-label fw-bold mt-3">Word Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="name should be hiragana. ">

                    <label for="sound" class="form-label fw-bold mt-3">File</label>
                    <input type="file" name="sound" id="sound" accept="audio/*" class="form-control" aria-describedby="sound-info">
                    <div id="sound-info" class="form-text">
                        {{-- The acceptable formats are jpeg, jpg, png, and gif only. <br> --}}
                        Max file size is 20kB.
                    </div>  

                    <div class="mt-3">
                        <select class="form-select" name="language" id="language">
                            <option selected>Choose the language</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->language }}</option>
                                @endforeach
                        </select>
                    </div>
                    {{-- Error --}}
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror

                    @error('sound')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror

                    @error('language')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror

                    <button type="submit" class="btn btn-primary px-5 mt-3">Add</button>
                </div>
            </form>
        </div>
        <div class="col-3 text-end">
            <a href="https://ttsmp3.com/" class="btn">making sound <i class="fa-solid fa-arrow-right"></i></a>
            <br>
            <a href="https://translate.google.com/?hl=ja&tab=TT&sl=ja&tl=en&op=translate" class="btn">translator <i class="fa-solid fa-arrow-right"></i></a>
            <a href="{{ route('admin.sound.see-all') }}" class="btn">See all sounds <i class="fa-solid fa-music" style="color: #63E6BE;"></i></a>
        </div>
  

        <div class="mt-5 card card-body border border-warning">
            <p class="mb-0"><i class="fa-brands fa-searchengin"></i> Search audio file you want to get here.</p>
            <form action="{{ route('admin.sound.search') }}" style="with: 200px">
                <input type="search" name="search" placeholder="Search..." class="form-control form-control-sm">
            </form>
        </div>
    </div>
@endsection