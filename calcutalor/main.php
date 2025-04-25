<?php
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
    if ($expr[0] === '(' && $expr[strlen($expr)-1] === ')') {
        $depth = 0;
        $len = strlen($expr);
        for ($i = 0; $i < $len; $i++) {
            if ($expr[$i] === '(') $depth++;
            if ($expr[$i] === ')') $depth--;
            if ($depth === 0 && $i < $len - 1) {
                break;
            }
        }
        if ($i === $len - 1) {
            return evalExpr(substr($expr, 1, -1));
        }
    }
    $depth = 0;
    for ($i = strlen($expr)-1; $i >= 0; $i--) {
        $ch = $expr[$i];
        if ($ch === ')') $depth++;
        if ($ch === '(') $depth--;
        if ($depth === 0 && ($ch === '+' || $ch === '-') && $i > 0) {
            $left = substr($expr, 0, $i);
            $right = substr($expr, $i+1);
            if ($ch === '+') {
                return add(evalExpr($left), evalExpr($right));
            } else {
                return sub(evalExpr($left), evalExpr($right));
            }
        }
    }
    $depth = 0;
    for ($i = strlen($expr)-1; $i >= 0; $i--) {
        $ch = $expr[$i];
        if ($ch === ')') $depth++;
        if ($ch === '(') $depth--;
        if ($depth === 0 && ($ch === '*' || $ch === '/')) {
            $left = substr($expr, 0, $i);
            $right = substr($expr, $i+1);
            if ($ch === '*') {
                return mul(evalExpr($left), evalExpr($right));
            } else {
                return divide(evalExpr($left), evalExpr($right));
            }
        }
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
