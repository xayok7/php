<?php
function generateMenu() {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'view';
    $current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    
    $menu_items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];
    
    $sort_items = [
        'default' => 'По порядку добавления',
        'surname' => 'По фамилии',
        'birth_date' => 'По дате рождения'
    ];
    
    $html = '<header>';
    
    foreach ($menu_items as $key => $value) {
        $class = ($current_page === $key) ? 'select' : '';
        $html .= "<a href='index.php?page={$key}' class='{$class}'>{$value}</a>";
    }
    
    $html .= '</header>';
    
    if ($current_page === 'view') {
        $html .= '<div class="submenu">';
        foreach ($sort_items as $key => $value) {
            $class = ($current_sort === $key) ? 'select' : '';
            $html .= "<a href='index.php?page=view&sort={$key}' class='{$class}'>{$value}</a>";
        }
        $html .= '</div>';
    }
    
    return $html;
}
?> 