function AddToFriends() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            document.getElementById('eror').innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("POST","/friends/add", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var pageOwnerId = $("#page_owner_id").val();
    var res = "user_id=" + encodeURIComponent(pageOwnerId);
    xhttp.send(res);
}
