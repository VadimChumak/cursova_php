<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Content/css/style.css">
    <link rel="stylesheet" href="Content/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
</div>
<script src="Content/js/jquery-3.1.1.js"></script>
<script src="Content/js/materialize.js"></script>
<script src="Content/js/mainPage.js"></script>
</body>
</html>