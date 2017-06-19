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
        var res = "user_id=" + encodeURIComponent(userId) + "&date=" + encodeURIComponent(currentDate);
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
                    if(location.pathname != "/chat/messages") {
                        Materialize.toast(item.name + " : " + item.text, 4000);
                    }
                    else {
                        var reciever_id = $("#usersMessages .collection .selected-message").find("input[type='hidden']").val();
                        if(reciever_id != item.sender_id) {
                            Materialize.toast(item.name + " : " + item.text, 4000);
                        }
                        else {
                            var tmp = $("#messageItem").html();
                            tmp = tmp.replace("[text]", item.text);
                            if(item.sender_id == currentUserId) {
                            tmp = tmp.replace("[sender]", "my");
                            }
                            else {
                                tmp = tmp.replace("[sender]", "user");
                            }
                            tmp = tmp.replace("[date]", item.Date);
                            $("#textMessages").append($(tmp));
                            var block = document.getElementById("textMessages");
                            block.scrollTop = block.scrollHeight;
                        }
                    }
                });
                setTimeout(connection, 1000);
            }
            }
        }
    }