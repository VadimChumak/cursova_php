/**
 * Created by zzzzz on 10.06.2017.
 */
window.onload =function () {
    var musicBlockElement = document.getElementById("contentBlock");
    musicBlockElement.addEventListener("click", Checker );

    var addBtnElement = document.getElementById('add');
    addBtnElement.addEventListener("click", addListener)
}

function addListener() {
    location.reload();
}

function Checker(event) {
    var id = event.target.id;

    var splitId = id.split('_');
    if( splitId[0]== 'deleteBtn' && splitId.length == 2)
    {
        var block = document.getElementById('element_' + splitId[1]);

        if (block.parentNode) {
            // удаляем элемент из дерева
            block.parentNode.removeChild(block);
        }
    }
}
