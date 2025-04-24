<?php
function isLucky($ticket)
{
    if (strlen($ticket) != 6 || !ctype_digit($ticket)) {
        return false;
    }

    $digits = str_split($ticket);
    $firstSum = $digits[0] + $digits[1] + $digits[2];
    $secondSum = $digits[3] + $digits[4] + $digits[5];

    return $firstSum == $secondSum;
}

$luckyTickets = [];

if (isset($_POST['start']) && isset($_POST['end'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];

    if (strlen($start) != 6 || strlen($end) != 6 || !ctype_digit($start) || !ctype_digit($end)) {
        $error = "Некорректный ввод. Введите ровно 6 цифр.";
    } else {
        $startNum = (int)$start;
        $endNum = (int)$end;

        for ($i = $startNum; $i <= $endNum; $i++) {
            $ticket = strval($i);
            if (isLucky($ticket)) {
                $luckyTickets[] = $ticket;
            }
        }
    }
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
        <input type="number" name="start" required><br><br>

        <label>Конечный номер (6 цифр):</label><br>
        <input type="number" name="end" required><br><br>

        <button type="submit">Проверить</button>
    </form>

    <?php
    if (isset($error)) {
        echo $error;
    } elseif (isset($luckyTickets)) {
        echo "<h2>Счастливые билеты:</h2><ul>";
        foreach ($luckyTickets as $ticket) {
            echo "<li>$ticket</li>";
        }
        echo "</ul>";
    }
    ?>
</body>

</html>