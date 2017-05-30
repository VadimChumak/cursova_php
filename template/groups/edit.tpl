<form enctype="multipart/form-data" method="post" >

    <span>Название: </span>
    <input name='title' type="text" value="<?php echo $Group[0]['title'] ?>"/></br>

    <span>Фотография: </span></br>
    <img style="max-width:200px;" src="<?php echo $Group[0]['photo_url'] ?>" id="current-group-photo"/></br>
    <!--<input type="text" name="photo_url" value="<?php echo $Group[0]['photo_url'] ?>" >-->
    <span>Загрузить новую фотографию: </span></br>
    <input style="margin:10px;" name='photo_url' type="file"/></br>


    <input style="margin:10px; width:150px;" type="submit" value="Сохранить">
</form>