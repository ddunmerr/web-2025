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
    <div class="v412_53">
        <div class="v412_54">
            <div class="name"></div>
            <div class="name"></div>
            <div class="name"></div>
        </div>
        <div class="v412_58">
            <div class="v412_59">
                <div class="v412_60">
                    <div class="v412_61"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                </div><span class="v412_65">Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне, в городке, занесенном снегом по ручку двери...» </span><span class="v412_66">2 часа назад</span>
                <div class="name"></div>
                <div class="v412_68">
                    <div class="v412_69">
                        <div class="v412_70">
                            <div class="v412_71"></div>
                        </div><span class="v412_72">Ваня Денисов</span>
                    </div>
                    <div class="name"></div>
                </div><span class="v412_74">ещё</span>
            </div>
            <div class="v412_75">
                <div class="v412_76">
                    <div class="v412_77"></div>
                </div><span class="v412_78">1 день назад</span>
                <div class="name"></div>
                <div class="v412_80">
                    <div class="v412_81">
                        <div class="v412_82">
                            <div class="v412_83"></div>
                        </div><span class="v412_84">Лиза Дёмина</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="v412_89">
            <div class="v412_90"></div>
            <div class="v412_91"></div>
        </div>
    </div>
</body>

</html>