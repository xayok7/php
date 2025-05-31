<?php require dirname(__DIR__).'/header.php';?>

<h3>Редактировать комментрарий</h3>
<form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comments/<?=$comment -> getID();?>/update" method="post">
    <div class="mb-3">
        <label for="text" class="form-label">Текст</label>
        <textarea class="form-control" id="text" rows="3" name="text"><?=$comment -> getText();?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
</form>

<?php require dirname(__DIR__).'/footer.html';?>