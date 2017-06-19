<div class="media_elements file_elements" id="element_<?php echo $value['id']?>">
    <a href="/<?php echo $value['url']?>" ><?php echo $value['title'] ?></a>

    <!--<?php if($CurrentId != $PageId) include 'template/music/addItemBlock.tpl';  ?>-->
    <?php if($CurrentId == $PageId) include 'template/file/deleteBlock.tpl';  ?>
    </br>
</div>