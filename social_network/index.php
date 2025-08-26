<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Войти</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="/js/likes.js" defer></script>

</head>

<body>
    <div class="page">
        <!-- Изображение на заднем плане -->
        <div class="page__background-image"></div>

        <!-- Заголовок "Войти" -->
        <h1 class="page__title">Войти</h1>

        <!-- Форма входа -->
        <form class="auth-form">
            <div class="auth-form__error">🤓 Поля обязательные</div>

            <div class="auth-form__field">
                <label class="auth-form__label" for="email">Электропочта</label>
                <input class="auth-form__input" type="email" id="email">
                <p class="auth-form__description">Введите электропочту в формате *****@******</p>
            </div>
            <div class="auth-form__field">
                <label class="auth-form__label" for="password">Пароль</label>
                <input class="auth-form__input" type="password" id="password">
            </div>
            <!--a href="pages/feed.php" class="continue-button"> Войти </a-->
            <button type="submit"
                class="auth-form__continue-button">Продолжить</button>
        </form>
    </div>
    <script>
        const errorMessage = document.querySelector('.auth-form__error');
        //errorMessage.style.display = 'none';
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        emailInput.style.outlineColor = '';
        passwordInput.style.outlineColor = '';

        document.getElementById('email').addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.outline = '';
            }
        });
        document.getElementById('password').addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.outline = '';
            }
        });

        document.querySelector('.auth-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email || !password) {
                errorMessage.style.visibility = 'visible';
                return;
            } else {
                errorMessage.style.visibility = 'hidden';
                emailInput.style.outline = '';
                passwordInput.style.outline = '';
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
                    emailInput.style.outline = '1px solid #E64646';
                    passwordInput.style.outline = '1px solid #E64646';
                }
            }


        });
    </script>

</body>

</html>