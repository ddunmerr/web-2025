<?php
function digit_to_word(int $digit)
{
    switch ($digit) {
        case 0:
            return "Ноль";
        case 1:
            return "Один";
        case 2:
            return "Два";
        case 3:
            return "Три";
        case 4:
            return "Четыре";
        case 5:
            return "Пять";
        case 6:
            return "Шесть";
        case 7:
            return "Семь";
        case 8:
            return "Восемь";
        case 9:
            return "Девять";
    }
}
// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['digit'])) {
        $digit = (int)$_POST['digit'];
    }
    $result = digit_to_word($digit);
    // Проверка на високосный год

}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Циферки</title>

</head>

<body>
    <h1>Циферки</h1>
    <form method="post">
        <p>Введите цифру:</p>
        <input type="number" name="digit" min="0" max="9" required>
        <button type="submit">Проверить</button>
    </form>

    <?php if (isset($result)) {
        echo $result;
    }
    ?>

</body>

</html>