<div id="modal_createPost" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="row">
        <form class="col l12 m12 s12" name="formPost" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field l12 m12 s12">
                    <input type="hidden" name="pageType" value="user" />
                    <input type="hidden" name="ownerId" value="<?php echo $UserInfo['user_id'] ?>" />
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea" name="newsText"></textarea>
                    <label for="icon_prefix2">Що у вас нового</label>
                </div>
                <div class="file-field input-field l12 m12 s12">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="news_images[]" accept="image/*" multiple />
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="news_images_text">
                    </div>
                </div>
                <div class="file-field input-field l12 m12 s12">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="news_audios[]" accept="audio/*" multiple />
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="news_audios_text">
                    </div>
                </div>
                <div class="file-field input-field l12 m12 s12">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="news_videos[]" accept="video/*" multiple />
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" name="news_videos_text">
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button class="modal-action modal-close waves-effect waves-green btn-flat main-color" id="sendPost">Agree</button>
    </div>
  </div>

<div class="col l6 m12 s12 wall-item create-post-area" id="createPostBlock">
    <button class="btn waves-effect waves-light" id="createPost">
        <i class="material-icons md-48">mode_edit</i>
    </button>
</div>
<?php while (!is_null($item = array_shift($newsArray))): ?>
    <div class="col l6 m12 s12 wall-item">
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
                <?php if(strlen($item['post_text']) > 0): ?>
                    <div class="card-content">
                        <p><?php echo $item['post_text'] ?></p>
                    </div>
                <?php endif; ?>
            <?php if(!empty($item['images'])): ?>
                <div class="card-image">
                    <img src="<?php echo "/media/users/". $item['page_owner_id'] . "/photo/" . array_shift($item['images'])['title'] ?>"/>
                    <div>
                        <?php while (!is_null($photo = array_shift($item['images']))): ?>
                            <img src="<?php echo "/media/users/". $item['page_owner_id'] . "/photo/". $photo['title']  ?>"/>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($item['videos'])): ?>
                <div class="card-content videos">
                    <?php while (!is_null($audio = array_shift($item['videos']))): ?>
                        <video controls>
                            <source src="<?php echo "/media/video/". $audio['title']  ?>" />
                        </audio>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if(!empty($item['audios'])): ?>
                <div class="card-content musics">
                    <?php while (!is_null($audio = array_shift($item['audios']))): ?>
                        <p><?php echo $audio['title'] ?></p>
                        <audio controls>
                            <source src="<?php echo "/media/music/". $audio['title']  ?>" />
                        </audio>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <div class="card-action">
                <?php if($item['isLiked'] == false): ?>
                    <span class="badge"><i class="material-icons like-heart">favorite_border</i><span><?php echo $item['count'] ?></span></span>
                <?php else: ?>
                    <span class="badge"><i class="material-icons like-heart">favorite</i><span><?php echo $item['count'] ?></span></span>
                <?php endif; ?>
                 <span class="badge"><i class="material-icons coment">comment</i><span><?php echo $item['comment_count'] ?></span></span>
                <?php if(($UserInfo['user_id'] == $CurrentUser['id']) || $CurrentUser['id'] == $item['user_id']): ?>
                      <a class="dropdown-button delete-news" href="#!" ><i class="material-icons right">delete</i></a></li>
                <?php endif; ?>
            </div>
            <div class="divider"></div>
            <div class="card-content comment hidden">
                <div class="comment-list">
                </div>
                <div class="comment-field">
                    <span></span>
                    <input id="commentField" type="text" class="comment-text">
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
            [text]
            [PostImage]
            [PostVideo]
            [PostAudio]
            <div class="card-action">
                <span class="badge"><i class="material-icons like-heart">[isLiked]</i><span>[count]</span></span>
                <span class="badge"><i class="material-icons coment">comment</i><span>[comment_count]</span></span>
                [delete]
            </div>
            <div class="card-content comment hidden">
                <div class="comment-list">
                </div>
                <div class="comment-field">
                    <span></span>
                    <input id="commentField" type="text" class="comment-text">
                    <button class="btn comment-btn"><i class="material-icons">add_circle</i></button>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text" id="postIMG">
    <div class="card-image">
        [MainImage]
        [OtherImage]
    </div>
</script>
<script type="text" id="postDelete">
    <a class="dropdown-button delete-news" href="#!"><i class="material-icons right">delete</i></a></li>
</script>
<script type="text" id="sendComment">
    <div class="comment-item">
        <input type="hidden" value="[commentId]" />
        <div class="chip">
            <img src="[userImage]" />
            <a href="/user/id/[userID]">[userName]</a>[reply_comment]
            <time class="timeago" datetime="[date]"></time><br>
        </div>
        [delete]
        <button class="btn reply-comment">reply</button>
    <p>[text]<p>
    </div>
</script>
<script type="text" id="deleteComment">
    <a class="dropdown-button delete-comment" href="#!"><i class="material-icons right">delete</i></a></li>
</script>
<script type="text" id="postAUDIO">
    <div class="card-content musics">
        [musicList]
    </div>
</script>
<script type="text" id="postVIDEO">
    <div class="card-content videos">
        [videoList]
    </div>
</script>