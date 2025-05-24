<?php
require_once 'Task/trig_functions.php';

function calculateExpression($expression) {
    preg_match('/(\d+)\s*\/\s*cot\((\d+)\)/', $expression, $matches);
    
    if (count($matches) !== 3) {
        throw new Exception("Неверный формат выражения");
    }
    
    $number = $matches[1];
    $angle = $matches[2];
    
    $cotValue = calculateTrig('cot', $angle);
    
    return $number / $cotValue;
}

$expression = trim(file_get_contents('Task/expression.txt'));
$result = '';
$error = '';

try {
    $result = calculateExpression($expression);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eval</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Eval</h1>
        <div class="calculator">
            <div class="expression">
                <h2>Выражение:</h2>
                <p><?php echo htmlspecialchars($expression); ?></p>
            </div>
            <div id="result">
                <?php if ($error): ?>
                    <p class="error">Ошибка: <?php echo htmlspecialchars($error); ?></p>
                <?php else: ?>
                    <p>Результат: <?php echo number_format($result, 4); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
