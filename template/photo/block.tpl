<div class="media_elements_list photo_elements" id="element_<?php echo $value['id']?>">
        <img class="img_AllListItem" src="/<?php echo $value['url']?>"/>
        <?php if($CurrentId == $PageId) include 'template/photo/deleteBlock.tpl';  ?>
</div>