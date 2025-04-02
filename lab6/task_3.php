<?php



function zodiak(int $date)
{
    $day = $date['mday'];
    $month = $date['mon'];
    return $month;
}
// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['digit'])) {
        $date = (int)$_POST['digit'];
    }
    $result = zodiak($date);
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
        <input type="date" name="date" required>
        <button type="submit">Проверить</button>
    </form>

    <?php if (isset($result)) {
        echo $result;
    }
    ?>

</body>

</html>