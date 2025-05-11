<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Заголовки сайта</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <img src="LogoMospolytech.jpg" alt="МосПолитех" height="50">
    <h1>Заголовки сайтов</h1>
  </header>

  <main>
    <?php
      $url = 'https://httpbin.org/post';
      $output = @get_headers($url);

      if ($output) {
        echo "<h2>Заголовки для: $url</h2>";
        echo "<textarea rows='12' cols='80' readonly>";
        echo implode("\n", $output);
        echo "</textarea>";
      } else {
        echo "<p>Не удалось получить заголовки с $url</p>";
      }
    ?>
  </main>


  <footer>
    <p>Задание для самостоятельной работы</p>
  </footer>
</body>
</html>
