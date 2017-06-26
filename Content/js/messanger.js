$(window).on("load", function() {
    var currentUserId = $("#currentUserId").val();
    var recieverId = null;
    var selectedUser = null;

    $("#openMessage").on("click", function() {
        $('#modal_createMessage').modal('open');
    });

    $("#modal_createMessage #sendMessage").on("click", function() {
        var text = $("#modal_createMessage textarea[name='text']").val();
        var reciever_id = $("#modal_createMessage input[name='reciever_id']").val();
        var res = "recieverId=" + encodeURIComponent(reciever_id) + "&text=" + encodeURIComponent(text) ;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/chat/save", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(res);
        xhr.onload = function() {
        }
        xhr.onreadystatechange = function() {
            if(this.readyState !=4) return;
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                return;
            }
            else {
            }
        }
    });

    $("#messagesSection #sendMessages").on("click", function(event) {
        event.preventDefault();
        var text = $("#messagesSection textarea[name='text']").val();
        if(selectedUser != null) {
            if(text.trim().length > 0) {
                var reciever_id = recieverId;
                var res = "recieverId=" + encodeURIComponent(reciever_id) + "&text=" + encodeURIComponent(text) ;
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/chat/save", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send(res);
                xhr.onreadystatechange = function() {
                    if(this.readyState !=4) return;
                    if(this.status != 200) {
                        alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                        return;
                    }
                    else {
                        document.getElementById("eror").innerHTML = xhr.responseText;
                        var item = JSON.parse(xhr.responseText);
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
            }
            else {
                Materialize.toast('Поле не може бути пустим!', 1000);
            }
        }
        else {
            Materialize.toast('Оберіть користувача!', 1000);
        }
    });

    $("#usersMessages .collection").on("click", ".collection-item", function() {
        if(selectedUser == null) {
            selectedUser = $(this);
            selectedUser.toggleClass("selected-message");
        }
        else {
            selectedUser.toggleClass("selected-message");
            selectedUser = $(this);
            selectedUser.toggleClass("selected-message");
        }
        if($(this).find('.newMessageCount')[0] != undefined) {
            $(this).find('.newMessageCount').remove();
        }
        $("#textMessages").html("");
        recieverId = $(this).find("input[type='hidden']").val();
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/chat/list", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var res = "userId=" + encodeURIComponent(recieverId);
        xhr.send(res);
        xhr.onreadystatechange = function() {
            if(this.readyState == 4) {
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
            }
            else {
                var messages = JSON.parse(xhr.responseText);
                messages.forEach(function(item, i, arr) {
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
                });
                var block = document.getElementById("textMessages");
                block.scrollTop = block.scrollHeight;
            }
            }
        }
    });
});