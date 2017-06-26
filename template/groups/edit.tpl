<div class="group_container">
    <dvi class="edit">
        <form id="my_form" enctype="multipart/form-data" method="post" >

            <span>Name: </span>
            <input id="title" name='title' type="text" value="<?php echo $Group[0]['title'] ?>"/></br>

            <span>Photo: </span></br>
            <img class="oldImg" src="<?php echo $Group[0]['photo_url'] ?>" id="current-group-photo"/></br>
            <!--<input type="text" name="photo_url" value="<?php echo $Group[0]['photo_url'] ?>" >-->
            <span>Load new image: </span></br>
            <input id="file" style="margin:10px;" name='photo_url' type="file"/></br>


            <input class="btn btn-default" type="submit" value="Save">
        </form>
    </dvi>
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
<script src="/Content/js/groupEdit.js"></script>