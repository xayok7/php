<?php
require_once '../eval/Task/trig_functions.php';

function add($a, $b) {
    return $a + $b;
}
function sub($a, $b) {
    return $a - $b;
}
function mul($a, $b) {
    return $a * $b;
}
function divide($a, $b) {
    if ((float)$b === 0.0) {
        throw new Exception("Деление на ноль");
    }
    return $a / $b;
}

function evalExpr($expr) {
    $expr = str_replace(' ', '', $expr);
    
    if (preg_match('/[^0-9+\-*/().]/', $expr)) {
        throw new Exception("Недопустимое выражение");
    }
    
    if (substr_count($expr, '(') !== substr_count($expr, ')')) {
        throw new Exception("Неправильные скобки");
    }

    while (preg_match('/(sin|cos|tan|cot)\((\d+)\)/', $expr, $matches)) {
        $function = $matches[1];
        $angle = $matches[2];
        $trigResult = calculateTrig($function, $angle);
        $expr = str_replace($matches[0], $trigResult, $expr);
    }
    
    while (preg_match('/\(([^()]+)\)/', $expr, $matches)) {
        $subExpr = $matches[1];
        $result = evalExpr($subExpr);
        $expr = str_replace($matches[0], $result, $expr);
    }
    
    while (preg_match('/(\d+\.?\d*)\s*([*\/])\s*(\d+\.?\d*)/', $expr, $matches)) {
        $left = $matches[1];
        $op = $matches[2];
        $right = $matches[3];
        
        if ($op === '*') {
            $result = mul($left, $right);
        } else {
            $result = divide($left, $right);
        }
        
        $expr = str_replace($matches[0], $result, $expr);
    }
    
    while (preg_match('/(\d+\.?\d*)\s*([+-])\s*(\d+\.?\d*)/', $expr, $matches)) {
        $left = $matches[1];
        $op = $matches[2];
        $right = $matches[3];
        
        if ($op === '+') {
            $result = add($left, $right);
        } else {
            $result = sub($left, $right);
        }
        
        $expr = str_replace($matches[0], $result, $expr);
    }
    
    if (is_numeric($expr)) {
        return (strpos($expr, '.') !== false) ? (float)$expr : (int)$expr;
    }
    
    throw new Exception("Ошибка вычисления");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expr'])) {
    try {
        $result = evalExpr($_POST['expr']);
    } catch (Exception $e) {
        $result = $e->getMessage();
    }
    header('Location: index.php?result=' . urlencode($result));
    exit;
}
?>
