<div class="group_container">
    <dvi class="edit">
        <form enctype="multipart/form-data" method="post" >

            <span>Name: </span>
            <input name='title' type="text" value="<?php echo $Group[0]['title'] ?>"/></br>

            <span>Photo: </span></br>
            <img class="oldImg" src="<?php echo $Group[0]['photo_url'] ?>" id="current-group-photo"/></br>
            <!--<input type="text" name="photo_url" value="<?php echo $Group[0]['photo_url'] ?>" >-->
            <span>Load new image: </span></br>
            <input style="margin:10px;" name='photo_url' type="file"/></br>


            <input class="btn btn-default" type="submit" value="Save">
        </form>
    </dvi>
</div>