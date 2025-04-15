<?php
function factorial($number)
{
    if ($number <= 1) {
        return 1;
    }
    return $number * factorial($number - 1);
}

if (isset($_POST['number'])) {
    $number = $_POST['number'];

    $result = factorial($number);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гадалок.net</title>

</head>

<body>
    <h1>Узнай свой знак зодиака</h1>
    <form method="post">
        <p>Введите дату:</p>
        <input name="number" type="number" required>
        <button type="submit">Узнать знак</button>
    </form>

    <?php if (isset($result)) {
        echo $result;
    }
    ?>

</body>

</html>