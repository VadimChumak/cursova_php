function SendData() {
   var val = document.getElementById('search').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200) {
            var res = JSON.parse(xhttp.responseText);
            var container = document.getElementById('search_res');
            container.classList.add('search_res');
            for (var i = 0; i < res.length; i++) {
                var block = document.createElement('div');
                var a = document.createElement('a');
                a.innerHTML = res[i].names;
                if (res[i].type == 'user') {
                    a.href = '/user/id/' + res[i].id;    
                }
                else {
                    a.href = '/groups/group/' + res[i].id;
                }
                var photo = document.createElement('img');
                photo.src = '/media/users/' + res[i].id + '/photo/' + res[i].image;
                block.appendChild(photo);
                block.appendChild(a);
                container.appendChild(block);
            }
        }
    };
    xhttp.open("GET","/search/find?search=" + val,true);
    xhttp.send();

}