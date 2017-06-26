$('#my_form').on('submit', function(e){
    e.preventDefault();
    console.log(1);
    if( $("#title").val() == ''){
        ValidateMessage('Please select title field');
        return -1;
    }

    var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)

    if($("#file").prop('files')[0]){
        if (!validateForm()) {
            ValidateMessage('Bad file extension');
            return -1;
        }
    }
    else{
        formData.delete('photo_url');
    }

    var $that = $(this),
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
    $.ajax({
        url: "/groups/AddGroup",
        type: "POST",
        contentType: false, // важно - убираем форматирование данных по умолчанию
        processData: false, // важно - убираем преобразование строк по умолчанию
        data: formData,
        dataType: 'json',
        success: function(data){
            console.log(data);
            if (data == "created") {
                //console.log(data);
                location.reload();
            }
        }
    });
});

function ValidateMessage(msg) {
    $("#myModal .modal-content .modal-body p").text(msg);
    $("#myModal").modal('open');
}

function validateForm()
{
    var ext = $('#file').val().split('.').pop().toLowerCase();

    if($.inArray(ext, ['png','jpg']) != -1) {
        return true;
    }

    return false;
}
