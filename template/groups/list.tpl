<form method="post">
    <div class="newGroup-block">
        <span>Название: </span>
        <input name='title' type="text" value=""/></br>

        <span>Фотография: </span>
        <input name='photo_url' type="text" value=""/></br>

        <input type="submit" value="Создать">
    </div>
</form>

<?php
foreach ($List as $value) {
    include 'template/groups/listBlock.tpl';
}
?>


