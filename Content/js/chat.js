
    $(window).on("load", function() {
        var interval = 360;
        connection();
        setInterval(connection, interval * 1000);
    });
    function connection() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/chat/set", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var userId = document.getElementById("currentUserId").value;
        var res = "user_id=" + encodeURIComponent(userId);
        xhr.send(res);
        xhr.onreadystatechange = function() {
            if(this.readyState == 4) {
            if(this.status != 200) {
                setTimeout(connection, 200);
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
            }
            else {
                document.getElementById("eror").innerHTML = xhr.responseText;
                var messages = JSON.parse(xhr.responseText);
                messages.forEach(function(item, i, arr) {
                    Materialize.toast(item.name + " : " + item.text, 4000);
                });
                setTimeout(connection, 200);
            }
            }
        }
    }