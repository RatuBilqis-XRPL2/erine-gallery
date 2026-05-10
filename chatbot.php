<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Chatbot Erine's</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #282828;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .chat-container {
      width: 350px;
      height: 500px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    .chat-header {
      background: #c79a42;
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: bold;
    }

    .chat-box {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
    }

    .message {
      margin: 8px 0;
      padding: 10px;
      border-radius: 10px;
      max-width: 75%;
    }

    .user {
      background: #282828;
      color: white;
      margin-left: auto;
    }

    .bot {
      background: #f1f1f1;
    }

    .chat-input {
      display: flex;
      border-top: 1px solid #ddd;
    }

    .chat-input input {
      flex: 1;
      border: none;
      padding: 10px;
      outline: none;
    }

    .chat-input button {
      background: #282828;
      border: none;
      color: white;
      padding: 10px 15px;
      cursor: pointer;
    }

    .chat-input button:hover {
      background: #c79a42;
    }
  </style>
</head>
<body>

  <div class="chat-container">
    <div class="chat-header">🤖 Chatbot Erine's </div>
    
    <div class="chat-box" id="chatBox"></div>

    <div class="chat-input">
      <input type="text" id="userInput" placeholder="Ketik pesan...">
      <button onclick="sendMessage()">Kirim</button>
    </div>
  </div>

  <script>
    function sendMessage() {
      const userInput = document.getElementById("userInput");
      const chatBox = document.getElementById("chatBox");
      const message = userInput.value.trim();
      if (message === "") return;

      const userMsg = document.createElement("div");
      userMsg.className = "message user";
      userMsg.textContent = message;
      chatBox.appendChild(userMsg);

      const botMsg = document.createElement("div");
      botMsg.className = "message bot";
      botMsg.textContent = botResponse(message);
      chatBox.appendChild(botMsg);

      chatBox.scrollTop = chatBox.scrollHeight;

      userInput.value = "";
    }

    function botResponse(input) {
      input = input.toLowerCase();

      const keywords = ['kategori', 'identitas', 'tentang', 'agensi', 'fanbase', 'team', 'gen', 'web'];
      const responses = [
      'Kategori foto: Daily, Fancam, With Friends, Photobook, dan Foto Official. Cek menu Galeri untuk lebih lengkap.',
      'Identitas Erine: Nama lengkap Catherina Vallencia, lahir 21 Agustus 2007, tinggi 163cm. Info lengkap ada di menu Profile.',
      'Website ini menampilkan foto-foto Erine dari aktivitas harian, fancam, interaksi dengan member lain, hingga penampilan resmi.',
      'Erine berasal dari agensi JKT48, agensi idol terbesar di Indonesia.',
      'Fanbase Erine bernama Cavalery. Bisa cek media sosial mereka untuk info lebih lanjut.',
      'Erine berada di Team Pession, debut setlist tanggal 11 April 2026.',
      'Erine dari Generasi 12, debut tahun 2023 saat berusia 16 tahun.',
      'Website ini menyimpan momen-momen Erine, dari kegiatan sehari-hari hingga penampilan resmi, sebagai tempat nostalgia bagi penggemar.'
    ];

      for (let i = 0; i < keywords.length; i++) {
        if (input.includes(keywords[i])) {
          return responses[i];
        }
      }
      return "Maaf, saya tidak mengerti pertanyaannya.";
    }

    // Optional: Enter key bisa juga untuk kirim
    document.getElementById("userInput").addEventListener("keypress", function(e) {
      if (e.key === "Enter") sendMessage();
    });
  </script>
</body>
</html>