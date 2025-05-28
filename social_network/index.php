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
        <div class="page__background-image"></div>

        <!-- Заголовок "Войти" -->
        <h1 class="page__title">Войти</h1>

        <!-- Форма входа -->
        <form class="auth-form">
            <div class="auth-form__field">
                <label class="auth-form__label" for="email">Электропочта</label>
                <input class="auth-form__input" type="email" id="email" required>
                <p class="auth-form__description">Введите электропочту в формате *****@******</p>
            </div>
            <div class="auth-form__field">
                <label class="auth-form__label" for="password">Пароль</label>
                <input class="auth-form__input" type="password" id="password" required>
            </div>
            <!--a href="pages/feed.php" class="continue-button"> Войти </a-->
            <button onclick="window.location.href='pages/feed.php'" type="submit"
                class="auth-form__continue-button">Продолжить</button>
        </form>
    </div>
</body>

</html>