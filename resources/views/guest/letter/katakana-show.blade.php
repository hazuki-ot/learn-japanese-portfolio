@extends('layouts.app')

@section('title', 'カタカナ')
    
@section('content')
<div class="row">
    @forelse ($category->katakana as $word)
        <div class="col-auto me-3 mb-4">
            {{-- *language sound button --}}
            <h3 class="card card-body border border-success text-center" style="cursor:pointer" onclick="playAudio({{ $word->id }})">{{ $word->word }}</h3>

            {{-- +japanese sound button --}}
            <span type="button" onclick="speakJapanese('{{ $word->word }}')" class="text-secondary"><i class="fa-solid fa-circle-play"></i></span>
        </div>

        @php
            // language_id=1 の最初のサウンドを取得
            $sound = optional(
                $word->katakanaSound->firstWhere('sound.language_id', session('user_language'))
            )->sound;
        @endphp

        @if ($sound)
            <audio id="audio-{{ $word->id }}" preload="auto">
                <source src="{{ asset('storage/audio/' . $sound->file_name) }}" type="audio/mpeg">
            </audio>
        @endif
    @empty
        <div class="row">
            <p class="h3">There is no カタカナ word.</p>
        </div>
    @endforelse
</div>

    {{-- *for each language sound button --}}
    <script>
    function playAudio(id) {
        const audio = document.getElementById('audio-' + id);
        if (audio) {
            audio.currentTime = 0; // 毎回先頭から再生したい場合
            audio.play().catch(err => {
                console.error("再生エラー:", err);
            });
        }
    }
    </script>

    {{-- +for japanese sound button --}}
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
