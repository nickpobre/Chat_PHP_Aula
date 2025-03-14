<?php
if (isset($_POST['nickname']) && isset($_POST['message'])) {
    $nickname = htmlspecialchars($_POST['nickname']);
    $message = htmlspecialchars($_POST['message']);
    $log = fopen('chat.log', 'a');
    fwrite($log, "<h1><strong>$nickname:</strong> $message</h1>\n");
    fclose($log);
}
?>