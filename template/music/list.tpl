<?php
if($CurrentId == $PageId){
    include 'template/music/add.tpl';
}
?>
<div id="contentBlock">
    <?php
    foreach ($List as $value) {
        include 'template/music/listBlock.tpl';
    }
    ?>
</div>