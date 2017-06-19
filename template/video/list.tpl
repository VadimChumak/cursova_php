<?php
if($CurrentId == $PageId){
    include 'template/video/add.tpl';
}
?>
<div id="contentBlock">
    <?php
    foreach ($List as $value) {
        include 'template/video/listBlock.tpl';
    }
    ?>
</div>


<!-- Modal -->
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
<script src="/Content/js/videoList.js"></script>