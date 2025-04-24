<?php
function getZodiacSign($day, $month): string
{
    if (($month == 1  && $day >= 20) || ($month == 2  && $day <= 18)) return 'Водолей';
    if (($month == 2  && $day >= 19) || ($month == 3  && $day <= 20)) return 'Рыбы';
    if (($month == 3  && $day >= 21) || ($month == 4  && $day <= 19)) return 'Овен';
    if (($month == 4  && $day >= 20) || ($month == 5  && $day <= 20)) return 'Телец';
    if (($month == 5  && $day >= 21) || ($month == 6  && $day <= 20)) return 'Близнецы';
    if (($month == 6  && $day >= 21) || ($month == 7  && $day <= 22)) return 'Рак';
    if (($month == 7  && $day >= 23) || ($month == 8  && $day <= 22)) return 'Лев';
    if (($month == 8  && $day >= 23) || ($month == 9  && $day <= 22)) return 'Дева';
    if (($month == 9  && $day >= 23) || ($month == 10 && $day <= 22)) return 'Весы';
    if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) return 'Скорпион';
    if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) return 'Стрелец';
    return 'Козерог';
}

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $date = strtotime($date);
    if ($date !== false) {
        $day = (int)date("d", $date);
        $month = (int)date("m", $date);
        $result = getZodiacSign($day, $month);
    } else {
        $result = 'Неверный формат даты.';
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Знак зодиака</title>

</head>

<body>
    <h1>Узнай свой знак зодиака</h1>
    <form method="post">
        <p>Введите дату:</p>
        <input type="date" name="date" required>
        <button type="submit">Узнать знак</button>
    </form>

    <?php if (isset($result)) {
        echo $result;
    }
    ?>

</body>

</html>