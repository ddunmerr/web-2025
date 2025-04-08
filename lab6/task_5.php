<?php
function is_lucky_ticket($ticket)
{
    // Преобразуем в строку с ведущими нулями
    $ticket = str_pad($ticket, 6, "0", STR_PAD_LEFT);
    $sum1 = $ticket[0] + $ticket[1] + $ticket[2];
    $sum2 = $ticket[3] + $ticket[4] + $ticket[5];
    return $sum1 == $sum2;
}

$lucky_tickets = [];

if (isset($_POST["start"]) && isset($_POST["end"])) {
    $start = (int)$_POST["start"];
    $end = (int)$_POST["end"];

    if ($start > $end) {
        $result = "Начальный номер должен быть меньше или равен конечному.";
    } elseif ($start < 0 || $end > 999999) {
        $result = "Номера билетов должны быть от 000000 до 999999.";
    } else {
        for ($i = $start; $i <= $end; $i++) {
            if (is_lucky_ticket($i)) {
                $lucky_tickets[] = str_pad($i, 6, "0", STR_PAD_LEFT);
            }
        }
        $result = count($lucky_tickets) > 0
            ? "Счастливые билеты:<br>" . implode(", ", $lucky_tickets)
            : "В этом диапазоне нет счастливых билетов.";
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