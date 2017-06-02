$(window).on("load", function() {

    $("#openMessage").on("click", function() {
        $('#modal_createMessage').modal('open');
    });

    $("#sendMessage").on("click", function() {
        var text = $("#modal_createMessage textarea[name='text']").val();
        var recieverId = $("#modal_createMessage input[name='reciever_id']").val();
        var res = "recieverId=" + encodeURIComponent(recieverId) + "&text=" + encodeURIComponent(text) ;
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
});