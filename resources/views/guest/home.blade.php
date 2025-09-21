@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h3 class="">Let's learn Japanese</h3>

    <div class="card card-body border border-2 mt-5">
        <div>
            <form action="{{ route('start.session') }}" method="POST">
                @csrf

                <label for="language" class="form-label fw-bold">Choose Your Language</label>

                <div class="mt-2">
                    <select class="form-select" name="language" id="language">
                        <option selected>Choose your language</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->language }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="input-group mt-3 ms-auto">
                    <button type="submit" class="btn btn-primary col-4 mx-auto">Start</button>
                </div>
                    {{-- Error --}}
                    @error('language')
                        <div class="text-danger small">{{ $message }}</div>    
                    @enderror
            </form>
        </div>
    </div>
@endsection