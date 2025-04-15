<?php

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Счастливые билеты</title>
</head>

<body>
    <h1>Найти счастливые билеты</h1>
    <form method="post">
        <label>Начальный номер (6 цифр):</label><br>
        <input type="number" name="start" min="0" max="999999" required><br><br>

        <label>Конечный номер (6 цифр):</label><br>
        <input type="number" name="end" min="0" max="999999" required><br><br>

        <button type="submit">Проверить</button>
    </form>

    <?php if (isset($result)) {
        echo "<p><strong>$result</strong></p>";
    } ?>
</body>

</html>