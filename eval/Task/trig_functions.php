<?php
function calculateTrig($function, $angle) {
    $radians = deg2rad($angle);
    
    $trigFunctions = [
        'sin' => 'sin',
        'cos' => 'cos',
        'tan' => 'tan',
        'cot' => function($x) { return 1 / tan($x); }
    ];
    
    if (!isset($trigFunctions[$function])) {
        throw new Exception("Неизвестная тригонометрическая функция: $function");
    }
    
    if (is_callable($trigFunctions[$function])) {
        return $trigFunctions[$function]($radians);
    } else {
        return $trigFunctions[$function]($radians);
    }
}
?> 