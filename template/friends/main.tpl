<div class="col m12" id="friendList">
    <ul class="collection card">
        <?php if (!empty($userArray)) :?>
            <?php while (!is_null($item = array_shift($userArray))): ?>
            <li class="collection-item avatar">
                <input type="hidden" value="<?php echo $item['user_id'] ?>" />
                <?php if(explode('_', $item['image'])[0] == 'default'): ?>
                <img src="<?php echo "/media/users/".$item['image'] ?>" class="circle message-img z-depth-3"/>
                <?php else: ?>
                <img src="<?php echo "/media/users/". $item['user_id'] . "/photo/" .$item['image'] ?>" class="circle message-img z-depth-3"/>
                <?php endif; ?>
                <a href="/user/id/<?php echo $item['user_id'] ?>"><span class="title"><?php echo $item['surname'].' '.$item['name'] ?></span></a>
                <?php if($_SERVER['REQUEST_URI'] == "/friends/senders"): ?>
                    <button onclick="Accept(this)" id = "<?php echo $item['user_id'] ?>" class="waves-effect waves-light btn following accept_btn">Accept</button>
                <?php elseif($_SERVER['REQUEST_URI'] == "/friends/list") : ?>
                <button onclick="Remove(this)" id = "<?php echo $item['user_id'] ?>" class="waves-effect waves-light btn following accept_btn">Remove</button>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        <?php else :?>
            <h3>You haven`t any information!</h3>
        <?php endif; ?>
    </ul>
</div>