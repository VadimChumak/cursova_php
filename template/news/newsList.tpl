<div class="col l6 m6 s12 wall-item create-post-area" id="createPostBlock">
    <button class="btn waves-effect waves-light" id="createPost">
    <i class="material-icons md-48">mode_edit</i>
</button>

</div>
<?php while (!is_null($item = array_shift($newsArray))): ?>
    <div class="col l6 m6 s12 wall-item">
        <div class="card">
            <input type="hidden" value="<?php echo $item['id'] ?>" />
            <div class="card-info">
                <?php if(explode('_', $item['image'])[0] == 'default'): ?>
                    <img src="<?php echo "/media/users/".$item['image'] ?>"/>
                <?php else: ?>
                    <img src="<?php echo "/media/users/". $item['user_id'] . "/photo/" .$item['image'] ?>"/>
                <?php endif; ?>
                <time class="timeago" datetime="<?php echo $item['publishing_date'] ?>"></time>
                <a href="<?php echo '/user/id/'.$item['user_id'] ?>"><?php echo $item['surname']." ".$item['name'] ?></a>
            </div>
            <?php if(!is_null($item['photo_url'])): ?>
            <div class="card-image">
                <img src="<?php echo "/media/users/". $item['page_owner_id'] . "/photo/" .$item['photo_url'] ?>"/>
            </div>
            <?php endif; ?>
            <div class="card-content">
                <?php if(($UserInfo['user_id'] == $CurrentUser['id']) || $CurrentUser['id'] == $item['user_id']): ?>
                        <a class="dropdown-button delete-news" href="#!" ><i class="material-icons right">delete</i></a></li>
                <?php endif; ?>
                <p><?php echo $item['post_text'] ?></p>
            </div>
            <div class="card-action">
                <?php if($item['isLiked'] == false): ?>
                    <span class="badge"><i class="material-icons like-heart">favorite_border</i><span><?php echo $item['count'] ?></span></span>
                <?php else: ?>
                    <span class="badge"><i class="material-icons like-heart">favorite</i><span><?php echo $item['count'] ?></span></span>
                <?php endif; ?>
                 <span class="badge"><i class="material-icons coment">comment</i><span><?php echo $item['comment_count'] ?></span></span>
            </div>
            <div class="divider"></div>
            <div class="card-content comment hidden">
                <div class="comment-list">
                </div>
                <div class="comment-field">
                    <input id="commentField" type="text">
                    <button class="btn comment-btn"><i class="material-icons">add_circle</i></button>
                </div>
            </div>
            </div>
    </div>
<?php endwhile; ?>
<script type="text" id="newsBlock">
    <div class="col l6 m6 s12 wall-item">
        <div class="card">
            <input type="hidden" value="[id]" />
            <div class="card-info">
                <img src="[userImage]"/>
                <time class="timeago" datetime="[date]"></time>
                <a href="/user/id/[userID]">[userName]</a>
            </div>
            [PostImage]
            <div class="card-content">
                [delete]
                <p>[text]</p>
            </div>
            <div class="card-action">
                <span class="badge"><i class="material-icons like-heart">[isLiked]</i><span>[count]</span></span>
                <span class="badge"><i class="material-icons coment">comment</i><span>[comment_count]</span></span>
            </div>
            <div class="card-content comment hidden">
                <div class="comment-list">
                </div>
                <div class="comment-field">
                    <input id="commentField" type="text">
                    <button class="btn comment-btn"><i class="material-icons">add_circle</i></button>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text" id="postIMG">
    <div class="card-image">
        <img src="[image]">
    </div>
</script>
<script type="text" id="postDelete">
    <a class="dropdown-button delete-news" href="#!"><i class="material-icons right">delete</i></a></li>
</script>
<script type="text" id="sendComment">
    <div class="comment-item">
        <div class="chip">
            <img src="[userImage]" />
            <a href="/user/id/[userID]">[userName]</a>
            <time class="timeago" datetime="[date]"></time>
        </div>
    <p>[text]<p>
    </div>
</script>