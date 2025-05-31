<?php
require_once 'db.php';

function generateEditForm() {
    global $pdo;
    
    $message = '';
    $message_class = '';
    $current_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    
    $stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<div class="div-edit">';
    foreach ($contacts as $contact) {
        $class = ($current_id === $contact['id']) ? 'currentRow' : '';
        $html .= "<a href='index.php?page=edit&id={$contact['id']}' class='{$class}'>";
        $html .= htmlspecialchars($contact['surname'] . ' ' . $contact['name']);
        $html .= "</a><br>";
    }
    $html .= '</div>';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && $_POST['button'] === 'Сохранить') {
        try {
            $sql = "UPDATE contacts SET 
                    surname = :surname,
                    name = :name,
                    lastname = :lastname,
                    gender = :gender,
                    birth_date = :birth_date,
                    phone = :phone,
                    address = :address,
                    email = :email,
                    comment = :comment
                    WHERE id = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id' => $current_id,
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
            
            $message = 'Запись обновлена';
            $message_class = 'success';
        } catch (PDOException $e) {
            $message = 'Ошибка: запись не обновлена';
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
    
    if ($current_id) {
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$current_id]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($contact) {
            $row = [
                'surname' => $contact['surname'],
                'name' => $contact['name'],
                'lastname' => $contact['lastname'],
                'gender' => $contact['gender'],
                'date' => $contact['birth_date'],
                'phone' => $contact['phone'],
                'location' => $contact['address'],
                'email' => $contact['email'],
                'comment' => $contact['comment']
            ];
        }
    }
    
    $button = 'Сохранить';
    
    if ($message) {
        $html .= "<div class='{$message_class}'>{$message}</div>";
    }
    
    ob_start();
    include 'form.php';
    $form_html = ob_get_clean();
    $html .= $form_html;
    
    return $html;
}
?> 