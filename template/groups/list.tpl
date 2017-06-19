<?php
    if($User['id'] == $UserPage['id'])
        include 'template/groups/add.tpl';
?>
<div class="media_content group_content" id="contentBlock">
    <?php
    foreach ($List as $value) {
        include 'template/groups/listBlock.tpl';
    }
?>
</div>


