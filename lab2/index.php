<!-- Задание 17. array_slice -->
<?php
$arr = [1, 2, 3, 4, 5];
$result = array_slice($arr, 1, 3);
print_r($result);
?>

<!-- Задание 23. count -->
<?php
$arr = ['a', 'b', 'c', 'd', 'e'];
echo $arr[count($arr) - 1] . "\n";
?>

<!-- Задание 27. GET -->
<?php
if (isset($_GET['num'])) {
    if ($_GET['num'] == 1) {
        echo "привет\n";
    } elseif ($_GET['num'] == 2) {
        echo "пока\n";
    }
}
?>

<!-- Задание 33. Ассоциативные массивы -->
<?php
$arr = ['Коля' => '1000$', 'Вася' => '500$', 'Петя' => '200$'];
echo $arr['Петя'] . "\n";
echo $arr['Коля'] . "\n";
?>

<!-- Задание 48. Пользовательская функция -->
<?php
function isNumberInRange($num) {
    return $num > 0 && $num < 10;
}

$numbers = [1, -5, 12, 5, 8, 0, 15];
$filtered = [];

foreach ($numbers as $n) {
    if (isNumberInRange($n)) {
        $filtered[] = $n;
    }
}

print_r($filtered);
?>

<!-- Задание 60. Создание массива -->
<?php
$arr = ['Привет, ', 'мир', '!'];
$text = $arr[0] . $arr[1] . $arr[2];
echo $text . "\n";
?>
