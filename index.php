<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Chats</title>
</head>
<body>
    <div class="main">
        <div class="main-circle">
        </div>
        <h1>Bem-vindo(a) ao Chat PHP</h1>
        <p>para começar, digite o seu nome</p>
        <div class="main-form">
            <form action="chat.php" method="post" class="form">
                <input type="text" id="nickname" name="nickname" required class="input-nickname" placeholder="Digite seu nome">
                <button type="submit" class="btn-submit">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>