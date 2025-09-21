@extends('layouts.app')

@section('title', 'Pictures')
    
@section('content')
<div class="container">
    <div class="row">
        @forelse ($category->pictures as $picture)
            <div class="col-2 me-4 mb-2">
                <!-- Image is clickable -->
                <img src="{{ asset('storage/images/'. $picture->image) }}" alt="{{ $picture->name }}" class="img-md border border-2 border-secondary" style="cursor:pointer" onclick="toggleAudio({{ $picture->id }})">

                <!-- Unique audio tag for each picture -->
                <audio id="audio-{{ $picture->id }}">
                    <source src="{{ $picture->sound }}" type="audio/mpeg">
                </audio>
            </div>
        @empty
            <div class="row">
                <p class="">There is no image.</p>
            </div>
        @endforelse 
    </div>
</div>

<script>
    function toggleAudio(id) {
        var audio = document.getElementById("audio-" + id);

        // Pause all other audios before playing the clicked one
        document.querySelectorAll("audio").forEach(a => {
            if (a !== audio) {
                a.pause();
                a.currentTime = 0; // reset to start
            }
        });

        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
    }
</script>
@endsection