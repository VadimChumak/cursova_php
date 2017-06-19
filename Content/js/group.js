/**
 * Created by zzzzz on 29.05.2017.
 */

$('#group-inout').on('click', function(e) {
    var currentGr = getNumFromLocation();
    console.log(currentGr);
    $.ajax({
        url: "/groups/LeaveOrJoin",
        type: "POST",
        dataType: 'text',
        data: ('id=' + currentGr),
        success: function(data){
            operate(data);
        }
    });
});

function operate(data) {
    if(data == '"leave"'){
        toJoinBtn();
    }
    if(data =='"join"'){
        toLeaveBtn();
    }
}

function toLeaveBtn() {
    var btn = document .getElementById('group-inout');
    btn.value = "Leave";
}

function toJoinBtn() {
    var btn = document .getElementById('group-inout');
    btn.value = "Join";
}

function getNumFromLocation() {
    var num = 4;
    var currentLocation = window.location.toString();
    var split = currentLocation.split('/');
    for(var i =0;i< num;i++){
        if(split[i] == "") {
            num++;
        }
    }
    return(split[num]);
}













