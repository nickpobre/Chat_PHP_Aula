<?php
if (isset($_POST['nickname']) && isset($_POST['message'])) {
    $nickname = htmlspecialchars($_POST['nickname']);
    $message = htmlspecialchars($_POST['message']);

    function getColorFromNickname($nickname) {
        $hash = md5($nickname);
        $color = substr($hash, 0, 6); 
        return "#" . $color;
    }

    $color = getColorFromNickname($nickname);

    $log = fopen('chat.log', 'a');
    fwrite($log, "<div class='message-card' id='message-card'><p><span class='hidden' style='color: $color;'>$nickname</span> $message</p></div>\n");
    fclose($log);
}
?>
