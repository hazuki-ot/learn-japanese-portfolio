document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".word").forEach((btn) => {
    btn.addEventListener("click", async () => {
      const text = item.dataset.text;

      // 翻訳リクエストをバックエンドに送る
      const res = await fetch("/translate", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        },
        body: JSON.stringify({ text }),
      });

      if (!res.ok) {
        console.error("Translation request failed");
        return;
      }

      const data = await res.json();
      const vietnamese = data.translated;

      // 音声読み上げ
      // const utter = new SpeechSynthesisUtterance(vietnamese);
      // utter.lang = "vi-VN";
      // speechSynthesis.speak(utter);
      const utter = new SpeechSynthesisUtterance(english);
      utter.lang = "en-US"; //or "en-GB"
      speechSynthesis.speak(utter);
    });
  });
});
