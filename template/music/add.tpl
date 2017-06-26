<button id="addSong" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalAdd">Add Song</button>


<div id="myModalAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add song</h4>
            </div>
            <div class="modal-body">
                <form id="my_form" enctype="multipart/form-data" method="post">

                    <div class="newAudio-block">
                        <span>Название: </span>
                        <input class="media_title audio_title" id="title" name='title' type="text" value=""/></br>

                        <span>Файл: </span></br>
                        <input class="btn btn-default" id="file" accept=".mp3" style="margin:10px;" name='song_file' type="file"/></br>
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