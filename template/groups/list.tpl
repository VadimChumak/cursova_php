<form enctype="multipart/form-data" method="post"  action="../groups/AddGroup">

    <div class="newGroup-block">
        <span>Название: </span>
        <input name='title' type="text" value=""/></br>

        <span>Фотография: </span></br>
        <img style="max-width:200px;" src="<?php echo $Group[0]['photo_url'] ?>" id="current-group-photo"/></br>
        <input style="margin:10px;" name='photo_url' type="file"/></br>

        <input type="submit" value="Создать">
    </div>

</form>

<?php
foreach ($List as $value) {
    include 'template/groups/listBlock.tpl';
}
?>


