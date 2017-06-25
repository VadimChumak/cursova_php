function SendData() {
   var val = document.getElementById('search').value;
    var cur_id = document.getElementById('currentUserId').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            var res = JSON.parse(xhttp.responseText);
            var container = document.getElementById('search_res');
            container.classList.add('search_res');
            for (var i = 0; i < res.length; i++) {
                if (res[i].type == 'user' && res[i].id == cur_id) {

                }
                else {
                    var block = document.createElement('div');
                    var a = document.createElement('a');
                    var photo = document.createElement('img');
                    a.innerHTML = res[i].names;
                    if (res[i].type == 'user') {
                        a.href = '/user/id/' + res[i].id;
                        if (res[i].image == "default_m.png" || res[i].image == "default_w.png") {
                            photo.src = '/media/users/' + res[i].image;
                        }
                        else {
                            photo.src = '/media/users/' + res[i].id + '/photo/' + res[i].image;
                        }
                    }
                    else {
                        a.href = '/groups/group/' + res[i].id;
                        photo.src = '/media/groups/' + res[i].id + '/photo/' + res[i].image;
                    }
                    block.appendChild(photo);
                    block.appendChild(a);
                    container.appendChild(block);
                }
            }
        }
    };
    xhttp.open("GET","/search/find?search=" + val,true);
    xhttp.send();

}