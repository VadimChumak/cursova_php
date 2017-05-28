<?php

foreach ($List as $value) {
    echo "<a href=./group/".$value['id'].">".$value['title']."</a>";
    echo '<img src='.$value['photo_url'].'>';
}

?>


