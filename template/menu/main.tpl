<!------->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="#!">Моя сторінка</a></li>
    <li class="divider"></li>
    <li><a href="#!">Налаштування</a></li>
    <li><a href="#!">Редагувати</a></li>
    <li class="divider"></li>
    <li><a href="#!">Вихід</a></li>
</ul>
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
                        <form>
                            <div class="input-field">
                                <input id="search" type="search" placeholder="Search" required>
                                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                <i class="material-icons">close</i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col l2 hide-on-med-and-down left-border-green nav-section">
                <ul class="left hide-on-med-and-down">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $UserSession['name'] ?><i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="row" id="content">
        <div class="col l2 m3 hide-on-small-and-down" id="left-menu">
            <div class="user-page-img">
                <img  src="http://gearmix.ru/wp-content/uploads/2015/08/3253676-530x353.jpg" class="responsive-img left-menu-user-img" alt="">
            </div>
            <div class="left-menu-user-info">
                <p class="user-name">PutinPutinPutinPutin</p>
                <p class="user-surname">Xuylo<i class="material-icons right user-online">perm_identity</i></p>
                <button class="waves-effect waves-light btn following"><i class="material-icons left">done</i>Following</button>
                <button class="waves-effect waves-light btn chat"><i class="material-icons left">chat</i>Chat</button>
            </div>
            <div class="collection user-menu" id="user-menu">
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">1</span>News</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">123</span>Friends</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="new badge">17</span>Messages</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">45</span>Groups</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">874</span>Photo</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">9</span>Music</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">12</span>Video</a>
            </div>
        </div>
        <div class="col l10 m9 s12" id="main-content">
            <div class="row quick-acces">
                <header>
                    <nav class="user-nav nav-extended">
                        <div class="nav-wrapper">
                            <ul class="user-nav-box">
                                <li><a href="sass.html"><i class="material-icons left">contacts</i>Friends</a></li>
                                <li><a href="badges.html"><i class="material-icons left">supervisor_account</i>Groups</a></li>
                                <li><a href="badges.html"><i class="material-icons left">perm_media</i>Photos</a></li>
                                <li><a href="badges.html"><i class="material-icons left">library_music</i>Musics</a></li>
                            </ul>
                        </div>
                        <div class="nav-content user-dop-panel">
                            <ul class="tabs tabs-transparent user-nav-box">
                                <li class="tab"><a href="#test1">All</a></li>
                                <li class="tab"><a class="active" href="#test2">Online</a></li>
                                <li class="tab"><a href="#test4">Request</a></li>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
            <div class="row wall">
                <div class="col l4 m6 s12 wall-item create-post-area">
                        <button class="btn waves-effect waves-light" id="createPost">
                        <i class="material-icons md-48">mode_edit</i>
                      </button>
                </div>
                <div class="col l4 m6 s12 wall-item">
                    <div class="card">
                        <div class="card-image">
                          <img src="https://pp.userapi.com/c639727/v639727615/21281/QpXdA9CRD54.jpg">
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information.
                              I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                           <a class="waves-effect btn"><i class="material-icons left">thumb_up</i>Вподобати</a>
                           <a class="waves-effect btn"><i class="material-icons left">mode_comment</i>Коментарі</a>
                           <a class="waves-effect btn"><i class="material-icons left">share</i>Поділитись</a>
                        </div>
                      </div>
                </div>
                <div class="col l4 m6 s12 wall-item">
                    <div class="card">
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information.
                              I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                          <a class="waves-effect btn"><i class="material-icons left">thumb_up</i>Вподобати</a>
                           <a class="waves-effect btn"><i class="material-icons left">mode_comment</i>Коментарі</a>
                           <a class="waves-effect btn"><i class="material-icons left">share</i>Поділитись</a>
                        </div>
                      </div>
                </div>
                <div class="col l4 m6 s12 wall-item">
                    <div class="card">
                        <div class="card-image">
                          <img src="https://pp.userapi.com/c639727/v639727245/2c043/OSPUeIMUgVo.jpg">
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information.
                              I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                          <a class="waves-effect btn"><i class="material-icons left">thumb_up</i>Вподобати</a>
                           <a class="waves-effect btn"><i class="material-icons left">mode_comment</i>Коментарі</a>
                           <a class="waves-effect btn"><i class="material-icons left">share</i>Поділитись</a>
                        </div>
                      </div>
                </div>
                <div class="col l4 m6 s12 wall-item">
                    <div class="card">
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information.
                              I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                          <a class="waves-effect btn"><i class="material-icons left">thumb_up</i>Вподобати</a>
                           <a class="waves-effect btn"><i class="material-icons left">mode_comment</i>Коментарі</a>
                           <a class="waves-effect btn"><i class="material-icons left">share</i>Поділитись</a>
                        </div>
                      </div>
                </div>
                <div class="col l4 m6 s12 wall-item">
                    <div class="card">
                        <div class="card-image">
                          <img src="https://pp.userapi.com/c836529/v836529536/3e76a/4KvMTuAfxlM.jpg">
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information.
                              I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                          <a class="waves-effect btn"><i class="material-icons left">thumb_up</i>Вподобати</a>
                           <a class="waves-effect btn"><i class="material-icons left">mode_comment</i>Коментарі</a>
                           <a class="waves-effect btn"><i class="material-icons left">share</i>Поділитись</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>