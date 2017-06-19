<?php
if($CurrentId == $PageId){
    include 'template/file/add.tpl';
}
?>
<div id="contentBlock">
    <?php
    foreach ($List as $value) {
        include 'template/file/Block.tpl';
    }
    ?>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p>Something where wrong</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="/Content/js/fileList.js"></script>