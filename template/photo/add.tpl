<button id="addPhoto" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd">Add photo</button>


<div id="myModalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add photo</h4>
            </div>
            <div class="modal-content">
                <form id="my_form" enctype="multipart/form-data" method="post">

                    <div class="new-block">
                        <span>Photo: </span></br>
                        <input id="file" accept="image/jpeg,image/png" style="margin:10px;" name='photo_file' type="file"/></br>
                        <input class="btn btn-default" type="submit" value="Add" id="add">
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>