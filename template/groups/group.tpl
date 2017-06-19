<div class="group_container">
    <div class="groupMenu">
        <img id="photo" class="group-photo-main" src="<?php echo $List[0]['photo_url']?>">
        <span id="title"> <?php echo $List[0]['title'] ?></span>
        </br>
        <!--<form method="post" action="../LeaveOrJoin/<?php echo $List[0]['id'] ?>" -->
        <?php
            if(! $member)
                echo '<input type="submit" class="btn btn-default" id="group-inout" value="Join" />';
            else
                echo '<input type="submit" class="btn" id="group-inout" value="Leave"/>';
        ?>
        <br/>
        <?php
            if($admin)
               include 'template/groups/groupAdminMenu.tpl'
        ?>
    </div>
</div>
<script src="/Content/js/group.js"></script>