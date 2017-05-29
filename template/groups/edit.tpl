<form method="post" >

    <span>Название: </span>
    <input name='title' type="text" value="<?php echo $Group[0]['title'] ?>"/></br>

    <span>Фотография: </span>
    <input name='photo_url' type="text" value="<?php echo $Group[0]['photo_url'] ?>"/></br>

    <input type="submit" value="Сохранить">
</form>