<div class="media_elements video_elements" id="element_<?php echo $value['id']?>">
    <span>  <?php echo $value['title'] ?>  </span></br>
    <video  controls >
        <source src="/<?php echo $value['url']?>.mp4" type="video/mp4">
        Your browser does not support the audio element.
    </video >
    <?php if($CurrentId != $PageId) include 'template/video/addItemBlock.tpl';  ?>
    <?php if($CurrentId == $PageId) include 'template/video/deleteItemBlock.tpl';  ?>
    </br>
</div>