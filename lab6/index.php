<?php
session_start();

// 1) По заходу на страницу запишите в сессию текст 'test'. Затем обновите страницу и выведите содержимое сессии на экран.
if (!isset($_SESSION['test'])) {
    $_SESSION['test'] = 'test';
}
echo "Содержимое сессии: " . $_SESSION['test'] . "<br>";

// 3) Сделайте счетчик обновления страницы пользователем. Данные храните в сессии. Скрипт должен выводить на экран количество обновлений. При первом заходе на страницу он должен вывести сообщение о том, что вы еще не обновляли страницу.
if (!isset($_SESSION['refresh_count'])) {
    $_SESSION['refresh_count'] = 0;
    echo "Вы еще не обновляли страницу<br>";
} else {
    $_SESSION['refresh_count']++;
    echo "Количество обновлений: " . $_SESSION['refresh_count'] . "<br>";
}

// 5) Запишите в сессию время захода пользователя на сайт. При обновлении страницы выводите сколько секунд назад пользователь зашел на сайт.
if (!isset($_SESSION['first_visit'])) {
    $_SESSION['first_visit'] = time();
}
$time_diff = time() - $_SESSION['first_visit'];
echo "Прошло секунд с первого захода: " . $time_diff . "<br>";

// 7) По заходу на страницу запишите в куку с именем test текст '123'. Затем обновите страницу и выведите содержимое этой куки на экран.
if (!isset($_COOKIE['test'])) {
    setcookie('test', '123', time() + 3600);
    echo "Кука установлена<br>";
} else {
    echo "Содержимое куки: " . $_COOKIE['test'] . "<br>";
}

// 9) Сделайте счетчик посещения сайта посетителем. Каждый раз, заходя на сайт, он должен видеть надпись: 'Вы посетили наш сайт % раз!'.
if (!isset($_COOKIE['visit_count'])) {
    setcookie('visit_count', 1, time() + 31536000); // 1 год
    echo "Вы посетили наш сайт 1 раз!<br>";
} else {
    $count = $_COOKIE['visit_count'] + 1;
    setcookie('visit_count', $count, time() + 31536000);
    echo "Вы посетили наш сайт " . $count . " раз!<br>";
}

// 10) Спросите дату рождения пользователя. При следующем заходе на сайт напишите сколько дней осталось до его дня рождения. Если сегодня день рождения пользователя - поздравьте его!
if (!isset($_COOKIE['birthday'])) {
    if (isset($_POST['birthday'])) {
        setcookie('birthday', $_POST['birthday'], time() + 31536000);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>
    <form method="post">
        <label>Введите дату рождения (YYYY-MM-DD):</label>
        <input type="date" name="birthday" required>
        <input type="submit" value="Сохранить">
    </form>
    <?php
} else {
    $birthday = new DateTime($_COOKIE['birthday']);
    $today = new DateTime();
    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));
    
    if ($birthday < $today) {
        $birthday->modify('+1 year');
    }
    
    $interval = $today->diff($birthday);
    
    if ($interval->days == 0) {
        echo "С Днем Рождения! 🎉<br>";
    } else {
        echo "До дня рождения осталось " . $interval->days . " дней<br>";
    }
}
?>
