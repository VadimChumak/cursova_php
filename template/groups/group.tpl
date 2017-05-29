<span id="title"> <?php echo $List[0]['title'] ?></span>
</br>
<img id="photo" style="max-width: 200px;" class="group-photo-main" src="<?php echo $List[0]['photo_url']?>">

<br/>
<form method="post" action="../LeaveOrJoin/<?php echo $List[0]['id'] ?>" >

<?php
    if(! $member)
        echo '<input type="submit" id="group-inout" value="Вступить" />';
    else
        echo '<input type="submit" id="group-inout" value="Покинуть"/>';
?>

</form>


<br/>

<?php
    if($admin)
       include 'template/groups/groupAdminMenu.tpl'
?>