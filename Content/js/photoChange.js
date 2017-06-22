function photoChange() {
    var file = document.getElementById('getAvatar');
    file.click();
    var formData;
    var flag = false;
    file.onchange = function () {
        formData = new FormData(document.forms.av);
        Send(formData);
    };
}
function Send(formData) {
    var id = document.getElementById('currentUserId').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            document.getElementById('eror').innerHTML = xhttp.responseText;
            var res = xhttp.responseText;
            document.getElementById('avatar').src = "/media/users/" + id + "/photo/" + res;
            location.reload();
        }
    };
    xhttp.open("POST","/setting/changephoto", true);
    //xhttp.setRequestHeader('Content-Type', 'multipart/form-data');
    xhttp.send(formData);
}