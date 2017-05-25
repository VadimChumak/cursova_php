<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Content/css/style.css">
    <link rel="stylesheet" href="Content/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Khula" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
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
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Firstname<i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="row" id="content">
        <div class="col l2 m3 hide-on-small-and-down" id="left-menu">
            <div class="user-page-img">
                <img src="http://gearmix.ru/wp-content/uploads/2015/08/3253676-530x353.jpg" class="responsive-img left-menu-user-img" alt="">
            </div>
            <div class="left-menu-user-info">
                <p class="user-name">PutinPutinPutinPutin</p>
                <p class="user-surname">Xuylo<i class="material-icons right user-online">perm_identity</i></p>
                <button class="waves-effect waves-light btn following"><i class="material-icons left">done</i>Following</button>
                <button class="waves-effect waves-light btn chat"><i class="material-icons left">chat</i>Chat</button>
            </div>
            <div class="collection user-menu">
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">1</span>News</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">123</span>Friends</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="new badge">17</span>Messages</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">45</span>Groups</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">874</span>Photo</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">9</span>Music</a>
                <a href="#!" class="collection-item waves-effect waves-light"><span class="badge">12</span>Video</a>
            </div>
        </div>
        <div class="col l8 m9 s12" id="main-content">
            <div class="row quick-acces">
                <div class="col l6 m6 s12 right-border-gray valign-wrapper center-align quick-acces-item">
                    <span>Friends</span>
                    <a class="btn-floating btn-large waves-effect grey center-align center-align valign-wrapper"><i class="large material-icons">play_arrow</i></a>
                </div>
                <div class="col l6 m6 s12 valign-wrapper quick-acces-item">
                    <span>Groups</span>
                    <a class="btn-floating btn-large waves-effect grey center-align valign-wrapper"><i class="large material-icons">play_arrow</i></a>
                </div>
            </div>
            <div class="row quick-acces top-border-gray bottom-border-gray">
                <div class="col l6 m6 s12 right-border-gray valign-wrapper center-align quick-acces-item">
                    <span>Friends</span>
                    <a class="btn-floating btn-large waves-effect grey center-align center-align valign-wrapper"><i class="large material-icons">play_arrow</i></a>
                </div>
                <div class="col l6 m6 s12 valign-wrapper quick-acces-item">
                    <span>Groups</span>
                    <a class="btn-floating btn-large waves-effect grey center-align valign-wrapper"><i class="large material-icons">play_arrow</i></a>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <div class="col l2 hide-on-med-and-down left-border-gray" id="right-menu">
            <ul class="collection">
                <li class="collection-item avatar">
                    <img src="images/yuna.jpg" alt="" class="circle">
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="material-icons circle">folder</i>
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="material-icons circle green">insert_chart</i>
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="material-icons circle red">play_arrow</i>
                    <span class="title">Title</span>
                    <p>First Line <br>
                        Second Line
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php if (isset($Content)) echo $Content  ?>
<script src="Content/js/jquery-3.1.1.js"></script>
<script src="Content/js/materialize.js"></script>
<script src="Content/js/mainPage.js"></script>
<!--<script src="Content/js/setHeight.js"></script>-->
</body>
</html>