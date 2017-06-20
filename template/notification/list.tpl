<div class="col l12 m12 s12">
    <ul class="collection card notification">
    <?php while (!is_null($item = array_shift($notificationArray))): ?>
        <li class="collection-item avatar">
            <input type="hidden" value="<?php echo $item['user_id'] ?>" />
            <?php if(explode('_', $item['image'])[0] == 'default'): ?>
                <img src="<?php echo "/media/users/".$item['image'] ?>" class="circle message-img z-depth-3"/>
                <?php else: ?>
                    <img src="<?php echo "/media/users/". $item['user_id'] . "/photo/" .$item['image'] ?>" class="circle message-img z-depth-3"/>
                <?php endif; ?>
                <a href="/user/id/<?php echo $item['user_id'] ?>"><span class="title"><?php echo $item['surname'].' '.$item['name'] ?></span></a>
            <?php if($item['type'] == 'news'): ?>
                <p> залишив запис на вашій стіні </p>
                <img class='notificarion-type z-depth-3' src="/Content/img/post.png" />
            <?php elseif($item['type'] == 'like'): ?>
                <p> вподобав ваш запис </p>
                <img class='notificarion-type z-depth-3' src="/Content/img/like.png" />
            <?php elseif($item['type'] == 'comment'): ?>
                <p> залишив коментар під вашим записом </p>
                <img class='notificarion-type z-depth-3' src="/Content/img/comment.png" />
            <?php elseif($item['type'] == 'reply'): ?>
                <p> відповів на ваш коментар </p>
                <img class='notificarion-type z-depth-3' src="/Content/img/reply.png" />
            <?php endif; ?>
            <time class="timeago" datetime="<?php echo $item['date'] ?>"></time>
        </li>
    <?php endwhile; ?>
  </ul>
</div>