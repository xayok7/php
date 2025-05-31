<?php
require_once 'db.php';

function generateView($sort = 'default', $page = 1) {
    global $pdo;
    
    $records_per_page = 10;
    $offset = ($page - 1) * $records_per_page;
    
    $order_by = match($sort) {
        'surname' => 'ORDER BY surname ASC, name ASC',
        'birth_date' => 'ORDER BY birth_date ASC',
        default => 'ORDER BY id ASC'
    };
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM contacts");
    $total_records = $stmt->fetchColumn();
    $total_pages = ceil($total_records / $records_per_page);
    
    $sql = "SELECT * FROM contacts {$order_by} LIMIT {$offset}, {$records_per_page}";
    $stmt = $pdo->query($sql);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<table>';
    $html .= '<tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>Телефон</th>
        <th>Адрес</th>
        <th>Email</th>
        <th>Комментарий</th>
    </tr>';
    
    foreach ($contacts as $contact) {
        $html .= '<tr>';
        $html .= "<td>{$contact['surname']}</td>";
        $html .= "<td>{$contact['name']}</td>";
        $html .= "<td>{$contact['lastname']}</td>";
        $html .= "<td>{$contact['gender']}</td>";
        $html .= "<td>{$contact['birth_date']}</td>";
        $html .= "<td>{$contact['phone']}</td>";
        $html .= "<td>{$contact['address']}</td>";
        $html .= "<td>{$contact['email']}</td>";
        $html .= "<td>{$contact['comment']}</td>";
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    if ($total_pages > 1) {
        $html .= '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? 'class="select"' : '';
            $html .= "<a href='index.php?page=view&sort={$sort}&p={$i}' {$active}>{$i}</a> ";
        }
        $html .= '</div>';
    }
    
    return $html;
}
?> 