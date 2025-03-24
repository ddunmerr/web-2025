<?php
if (!empty($_GET['q'])) {
    $query = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8');

    switch ($query) {
        case 'info':
            phpinfo();
            exit;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Invalid query parameter.";
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лента</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <div class="container">
        <div id="banner" class=" header"></div>
        <div class="sidebar">
            <ul>
                <li>
                    <a class="icon icon--home"></a>
                </li>
                <li>
                    <a class="icon icon--profile"></a>
                </li>
                <li>
                    <a class="icon icon--add"></a>
                </li>
            </ul>
        </div>

        <main class="feed">
            <!-- Контент ленты -->
            <div class="post">
                <div class="post-header">
                    <div class="user">
                        <div class="user-avatar"></div>
                        <h1 class="user-name">Ваня денисов</h1>
                    </div>
                    <div class="edit-button"></div>
                </div>
                <div>
                    <img class="post-image" src="/images/v412_61.png">
                </div>
            </div>
        </main>

    </div>

</body>

</html>