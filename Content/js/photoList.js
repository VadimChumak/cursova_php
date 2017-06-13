/**
 * Created by zzzzz on 10.06.2017.
 */
window.onload =function () {
    var musicBlockElement = document.getElementById("contentBlock");
    musicBlockElement.addEventListener("click", Checker );
    
    var AddAlbum = document.getElementById("addAlbum");
    AddAlbum.addEventListener("click", AddAlb );

    $('#my_form').on('submit', function(e){
        e.preventDefault();

        if(  !($("#file").prop('files')[0])  ){
            return -1;
        }

        var $that = $(this),
            formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        $.ajax({
            url: "/photo/Add",
            type: "POST",
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            dataType: 'json',
            success: function(data){
                if (data == "Add")
                {
                    setTimeout(location.reload(), 1000);
                }
            }
        });
        //
    });
}

function AddAlb() {
    
}

function Checker(event) {
    var id = event.target.id;

    var splitId = id.split('_');

    if( splitId[0]== 'deleteBtn' && splitId.length == 2)
    {
        var block = document.getElementById('element_' + splitId[1]);

        $.ajax({
            url: "/photo/Delete",
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

