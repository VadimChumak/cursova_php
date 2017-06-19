$(window).on("load", function() {
    var interval = 360;
    connection();
    setInterval(connection, interval * 1000);

    function connection() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/notification/check", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        var currentDate = '' + year + '-';
        if((month) < 10 ) {
            currentDate += '0' + month;
        }
        else {
            currentDate += month;
        } 
        currentDate += '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
        var res = "date=" + encodeURIComponent(currentDate);
        xhr.send(res);
        xhr.onreadystatechange = function() {
            if(this.readyState == 4) {
            if(this.status != 200) {
                setTimeout(connection, 1000);
            }
            else {
                document.getElementById("eror").innerHTML = xhr.responseText;

                var messages = JSON.parse(xhr.responseText);
                messages.forEach(function(item, i, arr) {
                    var text = null;
                    if(item.type == 'news') {
                        text = 'залишив запис на вашій стіні'
                    }
                    else if(item.type == 'like') {
                        text = 'вподобав ваш запис'
                    }
                    else if(item.type == 'comment') {
                        text = 'прокоментував ваш запис'
                    }
                    else if(item.type == 'reply') {
                        text = 'відповів на ваш коментар'
                    }
                    Materialize.toast(item.surname + " " + item.name + " " + text, 4000);
                });
                setTimeout(connection, 1000);
            }
            }
        }
    }
});