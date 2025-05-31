<?php
$host = 'localhost';
$dbname = 'contacts_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

$sql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    lastname VARCHAR(50),
    gender ENUM('мужской', 'женский') NOT NULL,
    birth_date DATE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    email VARCHAR(100),
    comment TEXT
)";

try {
    $pdo->exec($sql);
} catch(PDOException $e) {
    die("Ошибка создания таблицы: " . $e->getMessage());
}
?> 