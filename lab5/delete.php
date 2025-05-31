<?php
require_once 'db.php';

function generateDeleteForm() {
    global $pdo;
    
    $message = '';
    $message_class = '';
    
    if (isset($_GET['id'])) {
        try {
            $stmt = $pdo->prepare("SELECT surname FROM contacts WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($contact) {
                $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                
                $message = "Запись с фамилией {$contact['surname']} удалена";
                $message_class = 'success';
            }
        } catch (PDOException $e) {
            $message = 'Ошибка при удалении записи';
            $message_class = 'error';
        }
    }
    
    $stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '';
    if ($message) {
        $html .= "<div class='{$message_class}'>{$message}</div>";
    }
    
    $html .= '<div class="div-edit">';
    foreach ($contacts as $contact) {
        $html .= "<a href='index.php?page=delete&id={$contact['id']}'>";
        $html .= htmlspecialchars($contact['surname'] . ' ' . substr($contact['name'], 0, 1) . '.');
        $html .= "</a><br>";
    }
    $html .= '</div>';
    
    return $html;
}
?> 