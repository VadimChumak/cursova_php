<div class="col l4 m6 s12 wall-item create-post-area" id="createPostBlock">
    <button class="btn waves-effect waves-light" id="createPost">
    <i class="material-icons md-48">mode_edit</i>
</button>

</div>
<?php while (!is_null($item = array_shift($newsArray))): ?>
    <div class="col l4 m6 s12 wall-item">
        <div class="card">
            <input type="hidden" value="<?php echo $item['id'] ?>" />
            <?php if(!is_null($item['photo_url'])): ?>
            <div class="card-image">
                <img src="<?php echo "/media/users/". $item['page_owner_id'] . "/photo/" .$item['photo_url'] ?>"/>
            </div>
            <?php endif; ?>
            <div class="card-content">
                <div class="chip">
                    <img src="<?php echo "/media/users/". $item['user_id'] . "/photo/" .$item['image'] ?>" />
                    <a href="<?php echo '/user/id/'.$item['user_id'] ?>"><?php echo $item['surname']." ".$item['name'] ?></a>
                </div>
                <p><?php echo $item['post_text'] ?></p>
            </div>
            <div class="card-action">
                <time class="timeago" datetime="<?php echo $item['publishing_date'] ?>"></time>
                <a class="dropdown-button delete-news" href="#!"><i class="material-icons right">delete</i></a></li>
            </div>
            </div>
    </div>
<?php endwhile; ?>
<script type="text" id="newsBlock">
    <div class="col l4 m6 s12 wall-item">
        <div class="card">
            <input type="hidden" value="[id]" />
            [PostImage]
            <div class="card-content">
                <div class="chip">
                    <img src="/media/users/[userID]/photo/[userImage]"/>
                    <a href="/user/id/[userID]">[userName]</a>
                </div>
                <p>[text]</p>
            </div>
            <div class="card-action">
                <time class="timeago" datetime="[date]"></time>
                <a class="dropdown-button delete-news" href="#!"><i class="material-icons right">delete</i></a></li>
            </div>
        </div>
    </div>
</script>
<script type="text" id="postIMG">
    <div class="card-image">
        <img src="[image]">
    </div>
</script>