function toggleAudio(word) {
    fetch('/translate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ 
            text: word,
            target_lang: "EN-US" // Katakana → English
        })
    })
    .then(response => response.json())
    .then(data => {
        const translatedText = data.translations[0].text;
        console.log("Translated:", translatedText);
        readAloudEnglish(translatedText);
    })
    .catch(error => console.error("Error:", error));
}

function readAloudEnglish(text) {
    console.log("Reading aloud:" , text);
    if(!text) return;
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = "en-US"; 
    speechSynthesis.speak(utterance);
}





