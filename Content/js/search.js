function SendData() {
   var val = document.getElementById('search').value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if (xhttp.readyState==4 && xhttp.status==200)
            //document.getElementById("result").innerHTML=xhttp.responseText;
            alert(xhttp.responseText);
    };
    xhttp.open("GET","/search/find?search=" + val,true);
    xhttp.send();

}