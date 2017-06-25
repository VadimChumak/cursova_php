function AddToFriends(btn) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            Materialize.toast("Request has sended", 1000);
            btn.style.display = 'none';

        }
    };
    xhttp.open("POST","/friends/add", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var pageOwnerId = $("#page_owner_id").val();
    var res = "user_id=" + encodeURIComponent(pageOwnerId);
    xhttp.send(res);
}
function Accept(btn) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            Materialize.toast("Accepted", 1000);
        }
    };
    xhttp.open("POST","/friends/accept", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var senderId = btn.id;
    var res = "user_id=" + encodeURIComponent(senderId);
    xhttp.send(res);
}

function Remove(btn) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            Materialize.toast("Removed", 1000);
        }
    };
    xhttp.open("POST","/friends/remove", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var senderId = btn.id;
    var res = "user_id=" + encodeURIComponent(senderId);
    xhttp.send(res);
}