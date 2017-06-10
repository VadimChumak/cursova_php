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