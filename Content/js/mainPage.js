window.addEventListener("load", function() {
    
    var contentHeight = document.getElementById("main-content").offsetHeight;
    var leftHeight = document.getElementById("left-menu").offsetHeight;
    if(contentHeight > leftHeight) {
        document.getElementById("left-menu").style.height = contentHeight + "px";
    }
    
    /*$('.wall').masonry({
        itemSelector: '.wall-item',
        percentPosition: true
    });*/
    var msnry = new Masonry( '.wall', {
        itemSelector: '.wall-item',
        percentPosition: true
    });
    $('.modal').modal();

    $('#createPost').on("click", function(){
        $('#modal_createPost').modal('open');
    });
    
    $("time.timeago").timeago();
    
    $("#getFile").on("click", function(event) {
        event.preventDefault();
        $("#file").click(); 
    });

    $("#sendPost").on("click", function() {
        var formData = new FormData(document.forms.formPost);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "news/save", true);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if(this.readyState !=4) return;
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                return;
            }
            else {
                var result = JSON.parse(xhr.responseText);
                var fragment = document.createDocumentFragment();
                var tmp = $("#newsBlock").html();
                tmp = tmp.replace("[image]",("/media/users/" + result.page_owner_id + "/photo/" + result.photo_url));
                tmp = tmp.replace("[text]",result.post_text);
                var div = document.createElement("div");
                div.classList.add("col","l4","m6","s12","wall-item");
                div.innerHTML = tmp;
                document.querySelector(".wall").insertBefore(div, document.querySelector(".wall").firstElementChild.nextSibling);
                msnry.appended(div);
                msnry.reloadItems();
            }
        }
        /*var post = $("#modal_createPost");
        var postText = $(post).find("textarea").val();
        var file = $(post).find("input[type=file]");
        var fd = new FormData();
        fd.append('img', file.prop('files')[0]);
        console.log(file.prop('files')[0]);
        $.ajax({
            url: "news/save",
            type: "POST",
            async: true,
            processData: false,
            data: {"text": postText, "image": fd},
            error: function(data) {
                alert("error");
            },
            success: function(data) {
                alert(data);
            }
        });*/
    });
    
    $(document).resize(function() {
        var contentHeight = document.getElementById("main-content").offsetHeight;
    var leftHeight = document.getElementById("left-menu").offsetHeight;
    if(contentHeight > leftHeight) {
        document.getElementById("left-menu").style.height = contentHeight + "px";
    }
    });
    
function showFile(e) {
    var files = e.target.files;
    for (var i = 0, f; f = files[i]; i++) {
      if (!f.type.match('image.*')) continue;
      var fr = new FileReader();
      fr.onload = (function(theFile) {
        return function(e) {
            var img = document.createElement("img");
            img.setAttribute("src", ""+e.target.result);
            img.classList.add("hidden");
            img.classList.add("z-depth-3");
            img.classList.add("img-post");
            document.getElementById("img-post-section").appendChild(img);
            $(img).slideDown(300); 
        };
      })(f);
 
      fr.readAsDataURL(f);
    }
  }
 
    
});

window.addEventListener("scroll", function() {
    if(window.pageYOffset > 430) {
        document.getElementById("user-menu").style.position = "fixed";
        document.getElementById("user-menu").style.top = "0px";
        
    }
    else {
        document.getElementById("user-menu").style.position = "static";
    }
    console.log(window.pageYOffset);
})

$(document).ready(function(){
    $('.materialboxed').materialbox();
  });