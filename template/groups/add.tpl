<button id="addGroup" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd">Add group</button>


<div id="myModalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add group</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post"  action="../groups/AddGroup">

                    <div class="newGroup-block">
                        <span>Название: </span>
                        <input name='title' type="text" value=""/></br>

                        <span>Фотография: </span></br>
                        <img style="max-width:200px;" src="<?php echo $Group[0]['photo_url'] ?>" id="current-group-photo"/></br>
                        <input style="margin:10px;" accept="image/jpeg,image/png" name='photo_url' type="file"/></br>

                        <input class="btn btn-default" type="submit" value="Create">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>