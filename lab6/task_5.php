<?php
function bambam($start, $end)
{
    for ($i = 1; $i < 3; $i++) {
        $firstSumm += $start[$i];

        $secondSumm += $start[6 - $i];
    }
    if ($firstSumm == $secondSumm) {
        return $start;
    }
}

if (isset($_POST['start']) && isset($_POST['end'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $start = str_split($start, 1);
    $end = str_split($end, 1);
}
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