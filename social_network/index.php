<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Войти</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="page">
        <!-- Изображение на заднем плане -->
        <div class="background-image"></div>

        <!-- Заголовок "Войти" -->
        <h1 class="page-title">Войти</h1>

        <!-- Форма входа -->
        <form class="login-form">
            <div class="field">
                <label for="email">Электропочта</label>
                <input type="email" id="email" required>
                <p class="input-description">Введите электропочту в формате *****@******</p>
            </div>
            <div class="field">
                <label for="password">Пароль</label>
                <input type="password" id="password" required>
            </div>
            <!--a href="pages/feed.php" class="continue-button"> Войти </a-->
            <button onclick="window.location.href='pages/feed.php'" type="submit" class="continue-button">Продолжить</button>
        </form>
    </div>
</body>

</html>