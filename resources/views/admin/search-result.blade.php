@extends('layouts.app')

@section('title', 'Search Result')
    
@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <p class="h4 text-muted mb-5">Search results for "<span class="fw-bold">{{ $search }}</span>"</p>

        {{-- Pictures --}}
        @if (request()->is('admin/pictures/search*'))
            <div class="mt-4">
                @forelse ($pictures as $picture)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            <img src="{{ asset('storage/images/'. $picture->image) }}" alt="{{ $picture->name }}" class="rounded-circle img-sm">
                        </div>
                        <div class="col text-truncate">
                            <p class="text-muted mb-0">{{ $picture->name }}</p>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('admin.pictures.delete', ['id' => $picture->id, 'image' => $picture->image]) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="lead text-muted text-center">No Pictures Found.</p>
                @endforelse
            </div>

            {{ $pictures->links() }}

        {{-- Hiragana --}}
        @elseif (request()->is('admin/hiragana/search*'))
            <div class="mt-4">
                @forelse ($hiraganas as $hiragana)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto text-truncate">
                            <p class="text-muted mb-0">{{ $hiragana->id }}</p>
                        </div>
                        <div class="col text-truncate">
                            <p class="mb-0">{{ $hiragana->word }}</p>
                        </div>
                        <div class="col text-truncate">
                            <i class="fa-solid fa-paperclip" data-bs-toggle="modal" data-bs-target="#search-with-{{ $hiragana->id }}"></i>
                        </div>
                        @include('admin.modal.search-sound')
                        <div class="col-auto">
                            <form action="{{ route('admin.hiragana.delete', $hiragana->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="lead text-muted text-center">No Hiraganas Found.</p>
                @endforelse
            </div>

            {{ $hiraganas->links() }}

        {{-- Katakana --}}
        @elseif (request()->is('admin/katakana/search*'))
            <div class="mt-4">
                @forelse ($katakanas as $katakana)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto text-truncate">
                            <p class="text-muted mb-0">{{ $katakana->id }}</p>
                        </div>
                        <div class="col text-truncate">
                            <p class="mb-0">{{ $katakana->word }}</p>
                        </div>
                        <div class="col text-truncate">
                            <i class="fa-solid fa-paperclip" data-bs-toggle="modal" data-bs-target="#search-with-{{ $katakana->id }}"></i>
                        </div>
                        @include('admin.modal.search-sound')
                        <div class="col-auto">
                            <form action="{{ route('admin.katakana.delete', $katakana->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="lead text-muted text-center">No Katakanas Found.</p>
                @endforelse
            </div>

            {{ $katakanas->links() }}

        {{-- Kanji --}}
        @elseif (request()->is('admin/kanji/search*'))
            <div class="mt-4">
                @forelse ($kanjis as $kanji)
                    <div class="row align-items-center mb-3">
                        <div class="col-auto text-truncate">
                            <p class="text-muted mb-0">{{ $kanji->id }}</p>
                        </div>
                        <div class="col text-truncate">
                            <p class="mb-0">{{ $kanji->word }}</p>
                        </div>
                        <div class="col text-truncate">
                            <i class="fa-solid fa-paperclip" data-bs-toggle="modal" data-bs-target="#search-with-{{ $kanji->id }}"></i>
                        </div>
                        @include('admin.modal.search-sound')
                        <div class="col-auto">
                            <form action="{{ route('admin.kanji.delete', $kanji->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="lead text-muted text-center">No Kanjis Found.</p>
                @endforelse
            </div>

            {{ $kanjis->links() }}

        {{-- Sounds --}}
        @elseif (request()->is('admin/sound/search*'))
            <div class="mt-4">
                @forelse ($sounds as $sound)
                    <div class="row align-items-center mb-3">
                        <div class="col-1 text-truncate">
                            <p class="text-muted mb-0">{{ $sound->id }}</p>
                        </div>
                        <div class="col text-truncate">
                            <p class="mb-0">{{ $sound->name }}</p>
                        </div>
                        <div class="col-auto text-truncate">
                            <p class="text-muted mb-0">{{ $sound->file_name }}</p>
                        </div>
                        <div class="col-3 text-truncate">
                            <p class="text-muted mb-0">{{ $sound->language->language }}</p>
                        </div>
                        <div class="col-1">
                            <form action="{{ route('admin.sound.delete', $sound->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-sm"><i class="fa-solid fa-trash-can" style="color: #ef341f;"></i></button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="lead text-muted text-center">No Sounds Found.</p>
                @endforelse
            </div>

            {{ $sounds->links() }}
        @endif
    </div>
</div>
@endsection