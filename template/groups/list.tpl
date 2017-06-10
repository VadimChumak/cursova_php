<?php
    if($User['id'] == $UserPage['id'])
        include 'template/groups/add.tpl';
?>


<?php
foreach ($List as $value) {
    include 'template/groups/listBlock.tpl';
}
?>


