<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Форма обратной связи</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <img src="LogoMospolytech.jpg" alt="МосПолитех" height="50">
    <h1>4.1. Домашняя работа: Feedback Form</h1>
  </header>

  <main>
    <form action="output.php" method="post">
      <label>Имя пользователя: <input type="text" name="name" required></label><br>
      <label>E-mail: <input type="email" name="email" required></label><br>

      <label>Тип обращения:
        <select name="type">
          <option value="complaint">Жалоба</option>
          <option value="suggestion">Предложение</option>
          <option value="thanks">Благодарность</option>
        </select>
      </label><br>

      <label>Текст обращения:<br>
        <textarea name="message" rows="5" cols="40" required></textarea>
      </label><br>

      <label><input type="checkbox" name="reply_sms"> Ответ по SMS</label><br>
      <label><input type="checkbox" name="reply_email"> Ответ по Email</label><br>

      <button type="submit">Отправить</button>
    </form>

    <br>
    <a href="output.php">Перейти на вторую страницу</a>
  </main>

  <footer>
    <p>Задание для самостоятельной работы</p>
  </footer>
</body>
</html>
