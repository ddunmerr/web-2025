<?php
if (isset($_POST['year'])) {
    $year = (int)$_POST['year'];
    if ($year > 30000 || $year < 1) {
        $result = "Некорректное значение";
    } elseif ($year != null) {
        if ($year % 400 === 0 || ($year % 100 !== 0 && $year % 4 === 0)) {
            $result = 'YES';
        } else {
            $result = 'NO';
        }
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка високосного года</title>
</head>

<body>
    <h1>Проверка високосного года</h1>
    <form method="post">
        <p>Введите год:</p>
        <input type="number" name="year" min="1" max="30000" required>
        <button type="submit">Проверить</button>
    </form>

    <?php if (isset($result)) {
        echo $result;
    }
    ?>

</body>

</html>