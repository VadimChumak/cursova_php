<button id="addGroup" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd">Add group</button>


<div id="myModalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add group</h4>
            </div>
            <div class="modal-body">
                <form id="my_form" enctype="multipart/form-data" method="post">

                    <div class="newGroup-block">
                        <span>Название: </span>
                        <input name='title' type="text" value=""/></br>

                        <span>Фотография: </span></br>
                        <img style="max-width:200px;" src="<?php echo $Group[0]['photo_url'] ?>" id="current-group-photo"/></br>
                        <input id="file" style="margin:10px;" accept="image/jpeg,image/png" name='photo_url' type="file"/></br>

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

<div class="modal fade errorModal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default modal-action modal-close waves-effect waves-green close"
                        data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="/Content/js/groupAdd.js"></script>