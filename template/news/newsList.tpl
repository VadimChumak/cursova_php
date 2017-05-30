<? while ($item = array_unshift($newsArray)) != null ?>
    <div class="col l4 m6 s12 wall-item">
        <div class="card">
            <div class="card-image">
                <img src="<?php echo "media/users/". $item['page_owner_id'] . "/photo/" .$item['photo_url'] ?>".>
            </div>
            <div class="card-content">
                <p><?php echo $item['post_text'] ?></p>
            </div>
            <div class="card-action">
                <a class="waves-effect btn"><i class="material-icons left">thumb_up</i>Вподобати</a>
                <a class="waves-effect btn"><i class="material-icons left">mode_comment</i>Коментарі</a>
                <a class="waves-effect btn"><i class="material-icons left">share</i>Поділитись</a>
            </div>
            </div>
    </div>
<? endwhile ?>