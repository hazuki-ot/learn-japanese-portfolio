@extends('layouts.app')

@section('title', 'Pictures')
    
@section('content')
<div class="container">
    <div class="row">
        @forelse ($category->pictures as $picture)
            <div class="col-2 me-4 mb-2">
                <!-- Image is clickable -->
                {{-- <img src="{{ asset('storage/images/'. $picture->image) }}" alt="{{ $picture->name }}" class="img-md border border-2 border-secondary" style="cursor:pointer" onclick="toggleAudio({{ $picture->id }})"> --}}
                <img src="{{ asset('storage/images/'. $picture->image) }}" alt="{{ $picture->name }}" class="img-md border border-2 border-secondary" style="cursor:pointer" onclick="speakJapanese('{{ $picture->name }}')">
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


<script>
    let jpVoice = null;

    function loadVoices() {
        const voices = speechSynthesis.getVoices();

        // Debug: log voices to check available ones 利用可能な音声をチェック
        console.log("Available voices:", voices);

        jpVoice = voices.find(v => v.lang === "ja-JP" && v.name.includes("Google"))
            || voices.find(v => v.lang === "ja-JP")
            || voices.find(v => v.lang.startsWith("ja")) // fallback to any Japanese
            || null;

        console.log("Selected voice:", jpVoice);
    }

    // Ensure voices load even if delayed
    speechSynthesis.onvoiceschanged = () => {
        loadVoices();
    };

    function speakJapanese(text){
        if (!text) return;

        // Cancel any pending speech before speaking
        speechSynthesis.cancel();

        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = "ja-JP";

        if (jpVoice) utterance.voice = jpVoice;

        speechSynthesis.speak(utterance);
    }

    // Force voices to load after a small delay (Chrome sometimes needs it)
    setTimeout(loadVoices, 500);
    </script>
@endsection