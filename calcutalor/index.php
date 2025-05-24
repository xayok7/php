<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Калькулятор</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form id="calcForm" method="POST" action="main.php">
    <div class="calculator">
      <input type="text" id="display" readonly>
      <input type="hidden" name="expr" id="exprPost">
      <div id="preview"></div>
      <div class="buttons">
        <?php
          $buttons = [
            ['sin','cos','tan','cot'],
            ['7','8','9','/'],
            ['4','5','6','*'],
            ['1','2','3','-'],
            ['0','(',')','+'],
            ['←','C','=']
          ];
          foreach ($buttons as $row) {
            foreach ($row as $key) {
              if ($key === '←') {
                echo "<button type='button' class='back' onclick='backspace()'>←</button>";
              } elseif ($key === 'C') {
                echo "<button type='button' class='clear op' onclick='clearDisplay()'>C</button>";
              } elseif ($key === '=') {
                echo "<button type='button' class='equals op wide' onclick='calculate()'>=</button>";
              } elseif (in_array($key, ['+','-','*','/'])) {
                echo "<button type='button' class='op' onclick=\"append('$key')\">$key</button>";
              } elseif (in_array($key, ['sin','cos','tan','cot'])) {
                echo "<button type='button' class='trig' onclick=\"appendTrig('$key')\">$key</button>";
              } else {
                echo "<button type='button' onclick=\"append('$key')\">$key</button>";
              }
            }
            echo "\n";
          }
        ?>
      </div>
    </div>
  </form>
  <script src="main.js"></script>
</body>
</html>
