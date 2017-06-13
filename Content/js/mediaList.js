/**
 * Created by zzzzz on 10.06.2017.
 */
window.onload =function () {
    var musicBlockElement = document.getElementById("contentBlock");
    musicBlockElement.addEventListener("click", Checker );

    var addBtnElement = document.getElementById('add');
    addBtnElement.addEventListener("click", addListener)
}

$('#my_form').on('submit', function(e){
    e.preventDefault();

    if(  !($("#title").val() && $("#file").prop('files')[0])  ){
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
            console.log(data);
        }
    });
    location.reload();
});

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
