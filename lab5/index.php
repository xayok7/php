<?php
require_once 'menu.php';
require_once 'viewer.php';
require_once 'add.php';
require_once 'edit.php';
require_once 'delete.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'view';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$menu_html = generateMenu();

$content = match($page) {
    'view' => generateView($sort, $p),
    'add' => generateAddForm(),
    'edit' => generateEditForm(),
    'delete' => generateDeleteForm(),
    default => generateView($sort, $p)
};
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php echo $menu_html; ?>
    <main>
        <?php echo $content; ?>
    </main>
    <footer></footer>
</body>
</html> 