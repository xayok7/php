<?php
require_once 'db.php';

function generateAddForm() {
    global $pdo;
    
    $message = '';
    $message_class = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && $_POST['button'] === 'Добавить') {
        try {
            $sql = "INSERT INTO contacts (surname, name, lastname, gender, birth_date, phone, address, email, comment) 
                    VALUES (:surname, :name, :lastname, :gender, :birth_date, :phone, :address, :email, :comment)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':surname' => $_POST['surname'],
                ':name' => $_POST['name'],
                ':lastname' => $_POST['lastname'],
                ':gender' => $_POST['gender'],
                ':birth_date' => $_POST['date'],
                ':phone' => $_POST['phone'],
                ':address' => $_POST['location'],
                ':email' => $_POST['email'],
                ':comment' => $_POST['comment']
            ]);
            
            $message = 'Запись добавлена';
            $message_class = 'success';
        } catch (PDOException $e) {
            $message = 'Ошибка: запись не добавлена';
            $message_class = 'error';
        }
    }
    
    $row = [
        'surname' => '',
        'name' => '',
        'lastname' => '',
        'gender' => '',
        'date' => '',
        'phone' => '',
        'location' => '',
        'email' => '',
        'comment' => ''
    ];
    
    $button = 'Добавить';
    
    ob_start();
    include 'form.php';
    $form_html = ob_get_clean();
    
    $html = '';
    if ($message) {
        $html .= "<div class='{$message_class}'>{$message}</div>";
    }
    $html .= $form_html;
    
    return $html;
}
?> 