$('#my_form').on('submit', function(e){
    e.preventDefault();

    if( $("#title").val() == ''){
        ValidateMessage('Please select title field');
        return -1;
    }

    var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    formData.append('group_id', GetId());

    if($("#file").prop('files')[0]){
        if (!validateForm()) {
            ValidateMessage('Bad file extension');
            return -1;
        }
    }
    else{
        formData.delete('photo_url');
    }

    $.ajax({
        url: "/groups/EditGroup",
        type: "POST",
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        dataType: 'json',
        success: function(data){
            console.log(data);
            if (data == "edited") {
                location.reload();
            }
        }
    });
});

function ValidateMessage(msg) {
    $("#myModal .modal-content .modal-body p").text(msg);
    $("#myModal").modal('open');
}

function GetId() {
    var num = 4;
    var currentLocation = window.location.toString();
    var split = currentLocation.split('/');
    for(var i =0;i< num;i++){
        if(split[i] == "")
            num++;
    }
    return (split[num].split('?')[0]);
}

function validateForm()
{
    var ext = $('#file').val().split('.').pop().toLowerCase();

    if($.inArray(ext, ['png','jpg']) != -1) {
        return true;
    }

    return false;
}