<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Решение уравнения</title>
</head>
<body>
  <?php
    // Вариант 1
    $equation = "X + 3 = 7";
    $array = explode(" ", $equation);

    $left = $array[0];
    $operator = $array[1];
    $right = $array[2];
    $result = $array[4];

    if (strtolower($left) === 'x') {
      switch ($operator) {
        case '+':
          $answer = intval($result) - intval($right);
          break;
        case '-':
          $answer = intval($result) + intval($right);
          break;
        case '*':
          $answer = intval($result) / intval($right);
          break;
        case '/':
          $answer = intval($result) * intval($right);
          break;
      }
    } elseif (strtolower($right) === 'x') {
      switch ($operator) {
        case '+':
          $answer = intval($result) - intval($left);
          break;
        case '-':
          $answer = intval($left) - intval($result);
          break;
        case '*':
          $answer = intval($result) / intval($left);
          break;
        case '/':
          $answer = intval($left) / intval($result);
          break;
      }
    } else {
      $answer = 'Ошибка';
    }

    echo '<p>Ответ: ' . $answer . '</p>';
  ?>
</body>
</html>
