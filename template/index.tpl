<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/Content/css/style.css">
    <link rel="stylesheet" href="/Content/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Khula" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Port+Lligat+Slab" rel="stylesheet">

    <script src="/Content/js/jquery-3.1.1.js"></script>
    <script src="/Content/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
</head>
<body class="grey lighten-2">
<?php if (isset($Content)) echo $Content ?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCj1Zt3Zvmuuh4YA7DTYmc1RtV-sevDSsE&callback=initMap"></script>
<script src="/Content/js/search.js"></script>
<script src="/Content/js/friends.js"></script>
<script src="/Content/js/map.js"></script>
<script src="/Content/js/masonry.js"></script>
<script src="/Content/js/mainPage.js"></script>
<script src="/Content/js/timeago.js"></script>
<script src="/Content/js/timeagoLocalization.js"></script>
<script src="/Content/js/mediaList.js"></script>
<script src="/Content/js/materialize.js"></script>
<script src="/Content/js/notification.js"></script>
<?php if(isset($Script)) echo $Script ?>
</body>
</html>