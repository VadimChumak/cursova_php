<div id="element_<?php echo $value['id']?>">
    <span>  <?php echo $value['title'] ?>  </span></br>
    <audio controls style="width:400px;">
        <source src="/<?php echo $value['url']?>.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <?php if($CurrentId != $PageId) include 'template/music/addItemBlock.tpl';  ?>
    <?php if($CurrentId == $PageId) include 'template/music/deleteItemBlock.tpl';  ?>
    </br>
</div>