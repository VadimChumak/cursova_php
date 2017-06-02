<?php while (!is_null($item = array_shift($newsArray))): ?>
    <div class="col l4 m6 s12 wall-item">
        <div class="card">
            <?php if(!is_null($item['photo_url'])): ?>
            <div class="card-image">
                <img src="<?php echo "/media/users/". $item['page_owner_id'] . "/photo/" .$item['photo_url'] ?>".>
            </div>
            <?php endif; ?>
            <div class="card-content">
                <p><a href="<?php echo '/user/id/'.$item['user_id'] ?>"><?php echo $item['surname']." ".$item['name'] ?></a></p>
                <p><?php echo $item['post_text'] ?></p>
            </div>
            <div class="card-action">
                <time class="timeago" datetime="<?php echo $item['publishing_date'] ?>"></time>
            </div>
            </div>
    </div>
<?php endwhile; ?>