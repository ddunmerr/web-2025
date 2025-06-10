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
            <button type="submit"
                class="auth-form__continue-button">Продолжить</button>
        </form>
    </div>
    <script>
        document.querySelector('.auth-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            const res = await fetch('/api/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email,
                    password
                })
            });

            const result = await res.json();

            if (res.status === 200) {
                window.location.href = '/pages/feed.php';
            } else {
                alert(result.message || 'Ошибка входа');
            }
        });
    </script>

</body>

</html>