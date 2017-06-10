<div id="element_<?php echo $value['id']?>">
    <span>  <?php echo $value['title'] ?>  </span></br>
    <video  controls style="width:400px;">
        <source src="/<?php echo $value['url']?>.mp4" type="video/mpeg">
        Your browser does not support the audio element.
    </video >
    <?php if($CurrentId == $PageId) include 'template/video/deleteItemBlock.tpl';  ?></br>
</div>