<?php
// Задание 2. Запись в файл. Пусть в корне вашего сайта лежит файл test.txt. Запишите в него текст '12345'.
file_put_contents('test.txt', '12345');

// Задание 8. Копия файла. Пусть в корне вашего сайта лежит файл test.txt. Скопируйте его в файл copy.txt.
copy('test.txt', 'copy.txt');

// Задание 12. Переименование файлов. Пусть в корне вашего сайта лежит файл old.txt. Переименуйте его на new.txt.
rename('old.txt', 'new.txt');

// Задание 19. Работа с переносом строки. Дан файл test.txt. В нем на каждой строке написано какое-то число. Найдите сумму этих чисел и запишите ее в файл sum.txt.
if (file_exists('test.txt')) {
    $lines = file('test.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $sum = 0;
    foreach ($lines as $line) {
        $sum += (int) $line;
    }
    file_put_contents('sum.txt', $sum);
}

// Задание 25. Удаление файла. Пусть в корне вашего сайта лежат файлы 1.txt, 2.txt и 3.txt. Вручную сделайте массив с именами этих файлов. Переберите его циклом и удалите все эти файлы.
$files = ['1.txt', '2.txt', '3.txt'];
foreach ($files as $file) {
    if (file_exists($file)) {
        unlink($file);
    }
}

// Задание 28. Функция file. Дан файл test.txt. В нем на каждой строке написано какое-то число. 
// С помощью функции file найдите сумму этих чисел и запишите эту сумму обратно в конец файла, с новой строки.
if (file_exists('test.txt')) {
    $lines = file('test.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $sum = 0;
    foreach ($lines as $line) {
        $sum += (int) $line;
    }
    file_put_contents('test.txt', PHP_EOL . $sum, FILE_APPEND);
}
?>
