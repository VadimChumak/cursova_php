window.onload =function () {
    var musicBlockElement = document.getElementById("contentBlock");
    musicBlockElement.addEventListener("click", Checker );

    $('#my_form').on('submit', function(e){
        e.preventDefault();

        if(  ($("#title").val() == '' || !$("#file").prop('files')[0])  ){
            ValidateMessage('Please select all field');
            return -1;
        }
        
        if(!validateForm()) {
            ValidateMessage('Bad file extension. Please select audio file .mp3.');
            return -1;
        }

        var $that = $(this),
            formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        $.ajax({
            url: "/music/Add",
            type: "POST",
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            dataType: 'json',
            success: function(data){
                location.reload();
            }
        });
        ;
    });
}

function ValidateMessage(msg) {
    $("#myModal .modal-content .modal-body p").text(msg);
    $("#myModal").modal('open');
}

function validateForm()
{
    var ext = $('#file').val().split('.').pop().toLowerCase();
    
    if($.inArray(ext, ['mp3']) != -1) {
       return true;
    }
    
    return false;
}


function addListener() {

}

function Checker(event) {
    var id = event.target.id;

    var splitId = id.split('_');

    if( splitId[0]== 'deleteBtn' && splitId.length == 2)
    {
        var block = document.getElementById('element_' + splitId[1]);

        $.ajax({
            url: "/music/Delete",
            type: "POST",
            dataType: 'text',
            data: ('num=' + splitId[1]),
            success: function(data){
                var response = data.split('__')[1];
                isDeleted(response, block);
            }
        });
    }

    if( splitId[0]== 'add' && splitId.length == 2) {

        $.ajax({
            url: "/music/Copy",
            type: "POST",
            dataType: 'text',
            data: ('id=' + splitId[1]),
            success: function(data){
                var response = data.split('__')[1];
                if(response == 'Add') {
                    AddToYou(event.target);
                }
            }
        });
    }
}

function AddToYou(btn) {
    console.log(1);
    btn.value = "✔";
    btn.setAttribute("disabled","")
    console.log(btn);
}

function isDeleted(response, block){
    console.log(response);

    if(response == 'deleted') {
        if (block.parentNode) {
            // удаляем элемент из дерева
            block.parentNode.removeChild(block);
        }
    }

    if(response == 'error') {
        $("#myModal").modal('show');
    }
    
}
