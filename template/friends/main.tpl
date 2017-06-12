<div class="col l4 m4" id="friendList">
    <ul class="collection card">
        <?php while (!is_null($item = array_shift($userArray))): ?>
        <li class="collection-item avatar">
            <input type="hidden" value="<?php echo $item['user_id'] ?>" />
            <?php if(explode('_', $item['image'])[0] == 'default'): ?>
            <img src="<?php echo "/media/users/".$item['image'] ?>" class="circle message-img z-depth-3"/>
            <?php else: ?>
            <img src="<?php echo "/media/users/". $item['user_id'] . "/photo/" .$item['image'] ?>" class="circle message-img z-depth-3"/>
            <?php endif; ?>
            <a href="/user/id/<?php echo $item['user_id'] ?>"><span class="title"><?php echo $item['surname'].' '.$item['name'] ?></span></a>
        </li>
        <?php endwhile; ?>
    </ul>
</div>