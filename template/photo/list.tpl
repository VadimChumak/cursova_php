<!--<span class="spanLink" id="addAlbum">Add Album</span>-->
<?php
if($CurrentId == $PageId){
    include 'template/photo/add.tpl';
}
?>
<div id="contentBlock">
    <div class="media_elements photo_media" id="element_<?php echo $value['id']?>">
        <?php
        foreach ($List as $value) {
            include 'template/photo/block.tpl';
        }
        ?>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<div id="myModalBigPic" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img id="img_Big" class="img_Big" src=""/>
            </div>
        </div>

    </div>
</div>
<script src="/Content/js/photoList.js"></script>