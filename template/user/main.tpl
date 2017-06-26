<!------->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="/user/id/<?php echo $CurrentUser['id'] ?>">Моя сторінка</a></li>
    <li class="divider"></li>
    <li><a href="#!">Налаштування</a></li>
    <li><a href="/setting/edit">Редагувати</a></li>
    <li class="divider"></li>
    <li><a href="/registration/logout">Вихід</a></li>
    <input type="hidden" value="<?php echo $CurrentUser['id'] ?>" id="currentUserId"/>
</ul>
    <form action="" method="post" class="invisible" enctype="multipart/form-data" id="av">
        <input type="file" id="getAvatar" name="avatar">
    </form>
<?php if($UserInfo['user_id'] == $CurrentUser['id']): ?>
    <input type="hidden" id="isOwner" />
    
<?php endif; ?>
<?php if($UserInfo['user_id'] != $CurrentUser['id']): ?>
<div id="modal_createMessage" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div class="row">
        <form class="col l12 m12 s12" name="formMessage">
            <div class="row">
                <div class="input-field l12 m12 s12">
                    <input type="hidden" name="reciever_id" value="<?php echo $UserInfo['user_id'] ?>" />
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea" name="text"></textarea>
                    <label for="icon_prefix2">Що у вас нового</label>
                </div>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button class="modal-action modal-close waves-effect waves-green btn-flat main-color" id="sendMessage">Agree</button>
    </div>
  </div>
  <?php endif; ?>
<!------->

<div id="main">
    <header>
        <nav class="main-color row nav-wrapper">
            <div class="col l2 m3 s12 right-border-green nav-section valign-wrapper left-align">
                <h5>SiteName</h5>
            </div>
            <div class="col l8 m9 hide-on-small nav-section">
                <div class="row nav-section">
                    <div class="col l3 m4 right-border-green nav-section">
                        <ul class="hide-on-small-and-down  menu-list">
                            <li><a href="sass.html"><i class="material-icons main-color-text">supervisor_account</i></a></li>
                            <li><a href="badges.html"><i class="material-icons main-color-text">chat_bubble</i></a></li>
                        </ul>
                    </div>
                    <div class="col l9 m8 nav-section">
                        <form onsubmit="this.preventDefaults()">
                            <div class="input-field">
                                <input id="search" name="search" type="search" onchange="SendData()" placeholder="Search" required>
                                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                <i class="material-icons">close</i>
                            </div>
                        </form>
                        <div id="search_res"></div>
                    </div>
                </div>
            </div>
            <div class="col l2 hide-on-med-and-down left-border-green nav-section">
                <ul class="left hide-on-med-and-down">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $CurrentUser['name'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="row" id="content">
        <div class="col l2 m3 hide-on-small-and-down z-depth-4" id="left-menu">
            <div class="user-page-img">
                <?php if(explode('_', $UserInfo['image'])[0] == 'default'): ?>
                    <img id="avatar"  src="<?php echo "/media/users/".$UserInfo['image'] ?>" class="responsive-img left-menu-user-img" alt="">
                <?php else: ?>
                    <img id="avatar"  src="<?php echo "/media/users/".$UserInfo['user_id'].'/photo/'.$UserInfo['image'] ?>" class="responsive-img left-menu-user-img" alt="">
                <?php endif; ?>
                <?php if (isset($PageOwnerId)) :?>
                    <input type="hidden" value="<?php echo $PageOwnerId ?>" id="page_owner_id"/>
                <?php endif; ?>
            </div>
            <div class="left-menu-user-info">
                <p class="user-name"><?=$UserInfo['name']?></p>
                <p class="user-surname"><?=$UserInfo['surname']?><i class="material-icons right user-online">perm_identity</i></p>
                <?php if($UserInfo['user_id'] != $CurrentUser['id']): ?>
                    <?php if (Friends_Model::AlreadySended($CurrentUser['id'], $UserInfo['user_id']) == false) : ?>
                        <button onclick="AddToFriends(this)" class="waves-effect waves-light btn following"><i class="material-icons left">done</i>Add To Friend</button>
                    <?php endif; ?>
                    <button class="waves-effect waves-light btn chat" id="openMessage"><i class="material-icons left">chat</i>Chat</button>
                <?php else: ?>
                    <button onclick="photoChange()" class="waves-effect waves-light btn"><i class="material-icons left">photo_camera</i>Change photo</button>
                <?php endif; ?>
            </div>
            <div class="collection user-menu" id="user-menu">
                <?php if($NotificationsCount['count'] == 0): ?>
                    <a href="/notification/list" class="collection-item waves-effect waves-light">News</a>
                <?php else: ?>
                    <a href="/notification/list" class="collection-item waves-effect waves-light"><span class="new badge"><?php echo $NotificationsCount['count'] ?></span>News</a>
                <?php endif; ?>
                <a href="/friends/list" class="collection-item waves-effect waves-light"><span class="badge"><?php echo $_SESSION['user']['friends_count'] ?></span>Friends</a>
                <?php if($MessagesCount[0]['count'] == 0): ?>
                    <a href="/chat/messages" class="collection-item waves-effect waves-light">Messages</a>
                <?php else: ?>
                    <a href="/chat/messages" class="collection-item waves-effect waves-light"><span class="new badge"><?php echo $MessagesCount[0]['count'] ?></span>Messages</a>
                <?php endif; ?>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">45</span>Groups</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">874</span>Photo</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">9</span>Music</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">12</span>Video</a>
            </div>
        </div>
        <div class="col l10 m9 s12" id="main-content">
            <div class="row quick-acces">
                <header>
                    <?php $_SESSION['last_visited_user_id'] = $UserInfo['user_id']; ?>
                    <?php if($UserInfo['user_id'] != $CurrentUser['id']): ?>
                    <nav class="user-nav nav-extended">
                        <div class="nav-wrapper">
                            <ul class="user-nav-box">
                                <li><a href="/friends/frlist"><i class="material-icons left">contacts</i>Friends</a></li>
                                <li><a href="badges.html"><i class="material-icons left">supervisor_account</i>Groups</a></li>
                                <li><a href="badges.html"><i class="material-icons left">perm_media</i>Photos</a></li>
                                <li><a href="badges.html"><i class="material-icons left">library_music</i>Musics</a></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <div class="nav-content user-dop-panel">
                            <ul class="custom_tabs tabs-transparent user-nav-box">
                                <li class="tab"><a href="/friends/list">Your Friends</a></li>
                                <li class="tab"><a href="/friends/senders">Request</a></li>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
            <div class="row">
                <?php if(isset($AboutSection)) echo $AboutSection ?>
            </div>
            <div class="row wall">
                <?php if(isset($NewsSection)) echo $NewsSection ?>
            </div>
        </div>
    </div>
</div>

<div id="eror"></div>