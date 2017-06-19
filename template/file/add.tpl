<button id="addFile" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd">Add File</button>


<div id="myModalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add file</h4>
            </div>
            <div class="modal-body">
                <form id="my_form" enctype="multipart/form-data" method="post"  action="../Add">

                    <div class="newGroup-block">
                        <span>Название: </span>
                        <input name='title' type="text" value=""/></br>

                        <span>File: </span></br>
                        <input class="btn btn-default" id="file" accept="text/plain" style="margin:10px;" name='file_file' type="file"/></br>
                        <input class="btn btn-default" type="submit" value="Добавить" id="add">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>