{{-- modal hiragana --}}
@if (request()->is('admin/hiragana/search*'))
<div class="modal fade" id="search-with-{{ $hiragana->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title">Search sound and connect with {{ $hiragana->word }}</h3>
            </div>
            <div class="modal-body">
                <div class="mt-2">
                    {{-- language select --}}
                    <label for="language-{{ $hiragana->id }}" class="form-label fw-bold mt-3">Choose language</label>
                    <select class="form-select" id="language-{{ $hiragana->id }}" onchange="fetchSounds({{ $hiragana->id }}, '{{ $hiragana->word }}')">
                        <option value="" hidden>Choose the language search with</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->language }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    {{-- sound select --}}
                    <label for="soundselect-{{ $hiragana->id }}" class="form-label">Select sound</label>
                    <select class="form-select" id="soundselect-{{ $hiragana->id }}">
                        <option value="" hidden>choose the sound</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="saveHiraganaSound({{ $hiragana->id }})">Save</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
/**
 * 言語を選んだら Ajax でサウンドを取得
 */
function fetchSounds(hiraganaId, word) {
    const languageId = document.getElementById(`language-${hiraganaId}`).value;
    const soundSelect = document.getElementById(`soundselect-${hiraganaId}`);

    if (!languageId) {
        soundSelect.innerHTML = '<option value="">言語を選んでください</option>';
        return;
    }

    soundSelect.innerHTML = '<option>Loading...</option>';

    fetch(`{{ route('admin.sounds.search') }}?language_id=${languageId}&word=${encodeURIComponent(word)}`)
        .then(res => res.json())
        .then(sounds => {
            soundSelect.innerHTML = '<option value="">Choose the sound</option>';
            sounds.forEach(s => {
                soundSelect.insertAdjacentHTML('beforeend',
                    `<option value="${s.id}">${s.file_name}</option>`);
            });
        })
        .catch(() => {
            soundSelect.innerHTML = '<option>取得できませんでした</option>';
        });
}

/**
 * サウンド選択を保存
 */
function saveHiraganaSound(hiraganaId) {
    const soundId = document.getElementById(`soundselect-${hiraganaId}`).value;

    if (!soundId) {
        alert('サウンドを選んでください');
        return;
    }

    fetch(`{{ route('admin.hiragana-sounds.store') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            hiragana_id: hiraganaId,
            sound_id: soundId
        })
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            alert('保存しました');

            // ★ モーダルを閉じる処理
            const modalEl = document.getElementById(`search-with-${hiraganaId}`);
            let modal = bootstrap.Modal.getInstance(modalEl);

            if (!modal) {
                modal = new bootstrap.Modal(modalEl);
            }
        
            modal.hide();
        
        }else {
            alert('保存に失敗しました');
        }
    })
}
</script>
@endpush

{{-- modal katakana --}}
@elseif (request()->is('admin/katakana/search*'))
<div class="modal fade" id="search-with-{{ $katakana->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title">Search sound and connect with {{ $katakana->word }}</h3>
            </div>
            <div class="modal-body">
                <div class="mt-2">
                    {{-- language select --}}
                    <label for="language-{{ $katakana->id }}" class="form-label fw-bold mt-3">Choose language</label>
                    <select class="form-select" id="language-{{ $katakana->id }}" onchange="fetchSounds({{ $katakana->id }}, '{{ $katakana->word }}')">
                        <option value="" hidden>Choose the language search with</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->language }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    {{-- sound select --}}
                    <label for="soundselect-{{ $katakana->id }}" class="form-label">Select sound</label>
                    <select class="form-select" id="soundselect-{{ $katakana->id }}">
                        <option value="" hidden>choose the sound</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="saveKatakanaSound({{ $katakana->id }})">Save</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
/**
 * 言語を選んだら Ajax でサウンドを取得
 */
function fetchSounds(katakanaId, word) {
    const languageId = document.getElementById(`language-${katakanaId}`).value;
    const soundSelect = document.getElementById(`soundselect-${katakanaId}`);

    if (!languageId) {
        soundSelect.innerHTML = '<option value="">言語を選んでください</option>';
        return;
    }

    soundSelect.innerHTML = '<option>Loading...</option>';

    fetch(`{{ route('admin.sounds.search') }}?language_id=${languageId}&word=${encodeURIComponent(word)}`)
        .then(res => res.json())
        .then(sounds => {
            soundSelect.innerHTML = '<option value="">Choose the sound</option>';
            sounds.forEach(s => {
                soundSelect.insertAdjacentHTML('beforeend',
                    `<option value="${s.id}">${s.file_name}</option>`);
            });
        })
        .catch(() => {
            soundSelect.innerHTML = '<option>取得できませんでした</option>';
        });
}

/**
 * サウンド選択を保存
 */
function saveKatakanaSound(katakanaId) {
    const soundId = document.getElementById(`soundselect-${katakanaId}`).value;

    if (!soundId) {
        alert('サウンドを選んでください');
        return;
    }

    fetch(`{{ route('admin.katakana-sounds.store') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            katakana_id: katakanaId,
            sound_id: soundId
        })
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            alert('保存しました');

            // ★ モーダルを閉じる処理
            const modalEl = document.getElementById(`search-with-${katakanaId}`);
            // const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            let modal = bootstrap.Modal.getInstance(modalEl);

            if (!modal) {
                modal = new bootstrap.Modal(modalEl);
            }
        
            modal.hide();
        
        }else {
            alert('保存に失敗しました');
        }
    })
}
</script>
@endpush


{{-- modal kanji --}}
@elseif (request()->is('admin/kanji/search*'))
<div class="modal fade" id="search-with-{{ $kanji->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h3 class="h5 modal-title">Search sound and connect with {{ $kanji->word }}</h3>
            </div>
            <div class="modal-body">
                <div class="mt-2">
                    {{-- language select --}}
                    <label for="language-{{ $kanji->id }}" class="form-label fw-bold mt-3">Choose language</label>
                    <select class="form-select" id="language-{{ $kanji->id }}" onchange="fetchSounds({{ $kanji->id }}, '{{ $kanji->read }}')">
                        <option value="" hidden>Choose the language search with</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->language }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    {{-- sound select --}}
                    <label for="soundselect-{{ $kanji->id }}" class="form-label">Select sound</label>
                    <select class="form-select" id="soundselect-{{ $kanji->id }}">
                        <option value="" hidden>choose the sound</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="saveKanjiSound({{ $kanji->id }})">Save</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
/**
 * 言語を選んだら Ajax でサウンドを取得
 */
function fetchSounds(kanjiId, read) {
    const languageId = document.getElementById(`language-${kanjiId}`).value;
    const soundSelect = document.getElementById(`soundselect-${kanjiId}`);

    if (!languageId) {
        soundSelect.innerHTML = '<option value="">言語を選んでください</option>';
        return;
    }

    soundSelect.innerHTML = '<option>Loading...</option>';

    fetch(`{{ route('admin.sounds.search.kanji') }}?language_id=${languageId}&read=${encodeURIComponent(read)}`)
        .then(res => res.json())
        .then(sounds => {
            soundSelect.innerHTML = '<option value="">Choose the sound</option>';
            sounds.forEach(s => {
                soundSelect.insertAdjacentHTML('beforeend',
                    `<option value="${s.id}">${s.file_name}</option>`);
            });
        })
        .catch(() => {
            soundSelect.innerHTML = '<option>取得できませんでした</option>';
        });
}

/**
 * サウンド選択を保存
 */
function saveKanjiSound(kanjiId) {
    const soundId = document.getElementById(`soundselect-${kanjiId}`).value;

    if (!soundId) {
        alert('サウンドを選んでください');
        return;
    }

    fetch(`{{ route('admin.kanji-sounds.store') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            kanji_id: kanjiId,
            sound_id: soundId
        })
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            alert('保存しました');

            // ★ モーダルを閉じる処理
            const modalEl = document.getElementById(`search-with-${kanjiId}`);
            let modal = bootstrap.Modal.getInstance(modalEl);

            if (!modal) {
                modal = new bootstrap.Modal(modalEl);
            }
        
            modal.hide();
        
        }else {
            alert('保存に失敗しました');
        }
    })
}
</script>
@endpush

@endif
