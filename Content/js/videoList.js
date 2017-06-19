/**
 * Created by zzzzz on 10.06.2017.
 */
window.onload =function () {
    var videoBlockElement = document.getElementById("contentBlock");
    videoBlockElement.addEventListener("click", Checker );

    $('#my_form').on('submit', function(e){
        e.preventDefault();

        if(  ($("#title").val() == '' || !$("#file").prop('files')[0])  ){
            ValidateMessage('Please select all field');
            return -1;
        }

        if(!validateForm()) {
            ValidateMessage('Bad file extension');
            return -1;
        }

        if(!sizeValidation()){
            ValidateMessage('Too big file, max 50mb');
            return -1;
        }

        var $that = $(this),
            formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        $.ajax({
            url: "/video/Add",
            type: "POST",
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            dataType: 'json',
            success: function(data){
                if (data == "Add") {
                    location.reload();
                }
            }
        });
        //
    });
}

function ValidateMessage(msg) {
    $("#myModal .modal-content .modal-body p").text(msg);
    $("#myModal").modal('open');
}

function sizeValidation() {
    var size = document.getElementById('file').files[0].size;

    if(size < 50 * 1024 * 1024) {//50mb
        return true;
    }
    console.log(size);

    return false;
}

function validateForm()
{
    var ext = $('#file').val().split('.').pop().toLowerCase();

    if($.inArray(ext, ['mp4']) != -1) {
        return true;
    }

    return false;
}


function Checker(event) {
    var id = event.target.id;

    var splitId = id.split('_');

    if( splitId[0]== 'deleteBtn' && splitId.length == 2)
    {
        var block = document.getElementById('element_' + splitId[1]);

        $.ajax({
            url: "/video/Delete",
            type: "POST",
            dataType: 'text',
            data: ('num=' + splitId[1]),
            success: function(data){
                var response = data.toString() + '';
                isDeleted(response, block);
            }
        });
    }
}


function isDeleted(response, block){
    console.log(response);

    if(response == 'error') {
        $("#myModal").modal('show');
        return 0;
    }

    if (block.parentNode) {
        block.parentNode.removeChild(block);
    }

}

