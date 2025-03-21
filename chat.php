<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nickname'])) {
    $_SESSION['nickname'] = htmlspecialchars($_POST['nickname']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Chat em PHP</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@4.6.0/dist/index.min.js"></script>

</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="chat-header">
            <a href="index.php " class="return-home">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </a>
            <h1 class="chat-name">Chat em PHP</h1>
            <div class="dropdown">
                <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis-vertical">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" />
                    </svg></button>
                <div class="dropdown-content">
                    <button onclick="clearChat()">Limpar Chat</button>
                </div>
            </div>

            <style>

            </style>
        </div>

        <!-- Chat body -->
        <div class="chat-body">
            <div id="chat-box" class="chat-box"></div><br />
        </div>

        <!-- Chat input -->
        <div class="chat-input">
            <input type="text" id="message" placeholder="Sua mensagem" class="input-send">
            
            <button onclick="sendMessage()" class="btn-send"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send">
                    <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                    <path d="m21.854 2.147-10.94 10.939" />
                </svg></button>
        </div>
    </div>

    <script>
        function sendMessage() {
            var nickname = "<?php echo isset($_SESSION['nickname']) ? $_SESSION['nickname'] : ''; ?>";
            var message = document.getElementById('message').value;
            if (nickname && message) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'postMessage.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('nickname=' + nickname + '&message=' + message);
                document.getElementById('message').value = '';
            }
        }

        function getMessages() {
            var xhr = new XMLHttpRequest();
            var nickname = "<?php echo isset($_SESSION['nickname']) ? $_SESSION['nickname'] : ''; ?>";
            xhr.open('GET', 'getMessages.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('chat-box').innerHTML = this.responseText;
                    document.querySelectorAll('.message-card').forEach((message) => {
                        let span = message.querySelector('span.hidden');
                        if (span) {
                            let sender = span.textContent.trim();

                            if (sender.includes(nickname)) {
                                message.classList.add('my-message');
                            } else {
                                span.classList.remove('hidden');
                                message.classList.add('other-message'); 
                            }
                        }
                    });
                }
            }
            xhr.send();
        }

        function clearChat() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'clearChat.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('chat-box').innerHTML = '';
                }
            }
            xhr.send();
        }
        getMessages();
        setInterval(getMessages, 1000);
    </script>
</body>

</html>