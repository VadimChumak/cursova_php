window.addEventListener("load", function() {
    function setMenuHeight() {
        var contentHeight = document.getElementById("main-content").offsetHeight;
        var leftHeight = document.getElementById("left-menu").offsetHeight;
        if(contentHeight > leftHeight) {
        document.getElementById("left-menu").style.height = contentHeight + "px";
    };
    setMenuHeight();
}

$('.dropdown-button').dropdown({
         constrainWidth: false
         }
    );
    var newsStartFrom = 0;
    var newsEnd = 10;
    var allNews = true;
    var isOwner = false;
    if($("#isOwner")[0] != undefined) {
        isOwner = true;
    }
    $(window).on("resize", function() {
        setTimeout(setMenuHeight, 2000);
    });

    $(window).scroll(function() 
    {
        if  (($(window).scrollTop() == $(document).height() - $(window).height()) && allNews == true) 
        {
            newsStartFrom = newsEnd;
            newsEnd += 10;
            var pageOwnerId = $("#page_owner_id").val();
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/news/get", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var res = "from=" + encodeURIComponent(newsStartFrom) + "&to=" + encodeURIComponent(newsEnd) + "&owner=" + encodeURIComponent(pageOwnerId);
            xhr.send(res);
            xhr.onload = function() {
                var result = xhr.responseText;
                var array = JSON.parse(result);
                if(array.length == 0) {
                    allNews = false;
                }
                else {  
                array.forEach(function(item, i, arr) {
                    var postImg = "";
                    var deletePost = "";
                    if(item.photo_url != null) {
                        postImg = $("#postIMG").html();
                        postImg = postImg.replace("[image]", ("/media/users/" + item.page_owner_id + "/photo/" + item.photo_url));
                    }
                    if(isOwner || item.owner_id == $("#currentUserId").val()) {
                        deletePost = $("#postDelete").html();
                    }
                    var tmp = $("#newsBlock").html();
                    tmp = tmp.replace("[id]", item.id);
                    tmp = tmp.replace("[PostImage]", postImg);
                    tmp = tmp.replace("[text]",item.post_text);
                    tmp = tmp.replace("[date]", item.publishing_date);
                    tmp = tmp.replace("[userID]", item.user_id);
                    tmp = tmp.replace("[userID]", item.user_id);
                    if(item.image.split('_')[0] == 'default') {
                        tmp = tmp.replace("[userImage]", "/media/users/" + item.image);
                    }
                    else {
                        tmp = tmp.replace("[userImage]", "/media/users/" + item.user_id + "/photo/" + item.image);
                    }
                    tmp = tmp.replace("[userName]", item.surname + " " + item.name);
                    tmp = tmp.replace("[delete]", deletePost);
                    if(item.isLiked == true) {
                        tmp = tmp.replace("[isLiked]", "favorite");
                    }
                    else {
                        tmp = tmp.replace("[isLiked]", "favorite_border");
                    }
                    tmp = tmp.replace("[count]", item.count);
                    tmp = tmp.replace('[comment_count]', item.comment_count);
                    var tmpObj = $(tmp);
                    grid.append(tmpObj).masonry("appended", tmpObj);
                    $("time.timeago").timeago();
                });
                setTimeout(setReload, 210);
                setTimeout(setMenuHeight, 211);
                }
            }
            xhr.onreadystatechange = function() {
                if(this.status != 200) {
                if(this.readyState !=4) return;
                 alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                    return;
                }
                else {
                }
            }   
        }
        else if  (($(window).scrollTop() == $(document).height() - $(window).height()) && allNews != true) {
            Materialize.toast('На стіні більше немає записів.', 4000);
        } 
    });


    var grid = $('.wall').masonry({
        itemSelector: '.wall-item',
        percentPosition: true
    });
    $('.modal').modal();

    $('#createPost').on("click", function(){
        $('#modal_createPost').modal('open');
    });

    $(".wall").on("click", ".delete-news", function() {
        var newsId = $(this).parent().parent().find("input[type=hidden]").val();
        var block = $(this).parent().parent().parent();
        $(block).fadeOut(200, function(){
            $(block).remove();
            setTimeout(setReload, 100);
            setTimeout(setMenuHeight, 101);
        });
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/news/delete", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var res = "postId=" + encodeURIComponent(newsId);
        xhr.send(res);
        Materialize.toast("Запис видалено.", 1000);
    });

    $(".wall").on("click", ".comment-btn", function() {
        var id = $(this).parent().parent().parent().parent().find("input[type=hidden]").val();
        var text = $(this).parent().find("input").val();
        var commentImg = $(this).parent().parent().parent().find(".coment").parent().find("span");
        var commentList = $(this).parent().parent().find(".comment-list");
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/news/addcomment", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var res = "postId=" + encodeURIComponent(id) + "&text=" + encodeURIComponent(text);
        xhr.send(res);
        xhr.onreadystatechange = function() {
            if(this.readyState !=4) return;
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                return;
            }
            else {
                var count = $(commentImg).html();
                count++;
                $(commentImg).html(count.toString());
                var result = JSON.parse(xhr.responseText);
                var tmp = $("#sendComment").html();
                tmp = tmp.replace('[userID]', result.user_id);
                tmp = tmp.replace('[userID]', result.user_id);
                if(result.image.split('_')[0] == 'default') {
                    tmp = tmp.replace("[userImage]", "/media/users/" + result.image);
                }
                else {
                    tmp = tmp.replace("[userImage]", "/media/users/" + result.user_id + "/photo/" + result.image);
                }
                tmp = tmp.replace("[userName]", result.surname + " " + result.name);
                tmp = tmp.replace('[date]', result.date);
                tmp = tmp.replace('[text]', result.text);
                $(commentList).append($(tmp));
                $("time.timeago").timeago();
                setTimeout(setReload, 100);
                setTimeout(setMenuHeight, 101);
            }
        }
    });


    $(".wall").on("click", ".coment", function() {
        var thisComment = $(this);
        var card = $(this).parent().parent().parent();
        var id = $(this).parent().parent().parent().find("input[type=hidden]").val();
        var commentList = $(this).parent().parent().parent().find(".comment-list");
        commentList.html("");
        if(card.find(".comment").hasClass("hidden")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/news/getcomment", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var res = "postId=" + encodeURIComponent(id);
            xhr.send(res);
            xhr.onreadystatechange = function() {
            if(this.readyState !=4) return;
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                return;
            }
            else {
                var result = JSON.parse(xhr.responseText);
                if(result.length == 0) {
                }
                else {
                    result.forEach(function(item, i, arr) {
                        var tmp = $("#sendComment").html();
                        tmp = tmp.replace('[userID]', item.user_id);
                        tmp = tmp.replace('[userID]', item.user_id);
                        if(item.image.split('_')[0] == 'default') {
                            tmp = tmp.replace("[userImage]", "/media/users/" + item.image);
                        }
                        else {
                            tmp = tmp.replace("[userImage]", "/media/users/" + item.user_id + "/photo/" + item.image);
                        }
                        tmp = tmp.replace("[userName]", item.surname + " " + item.name);
                        tmp = tmp.replace('[date]', item.date);
                        tmp = tmp.replace('[text]', item.text);
                        $(commentList).append($(tmp));
                        $("time.timeago").timeago();
                        setTimeout(setReload, 100);
                        setTimeout(setMenuHeight, 101);
                    });
                }
                card.find(".comment").slideDown(10, function() {
                setTimeout(setReload, 0);
                setTimeout(setMenuHeight, 1);
                card.find(".comment").removeClass("hidden");
            });
            }
        }
        }
        else {
            card.find(".comment").slideUp(10, function() {
                setTimeout(setReload, 0);
                setTimeout(setMenuHeight, 1);
                card.find(".comment").addClass("hidden");
            });
        }
    });

    $(".wall").on("click", ".like-heart", function() {
        var thisHeart = $(this);
        var likeConditions =  $(this).html();
        var id = $(this).parent().parent().parent().find("input[type=hidden]").val();
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/news/like", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        if(likeConditions == "favorite") {
            $(this).html("favorite_border");
            var res = "postId=" + encodeURIComponent(id) + "&action='delete'";
        }
        else{
            $(this).html("favorite");
            var res = "postId=" + encodeURIComponent(id) + "&action=set";
        }
        xhr.send(res);
        xhr.onreadystatechange = function() {
            if(this.readyState !=4) return;
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                return;
            }
            else {
                var likeCount = +xhr.responseText;
                if(likeCount > 0) {
                    $(thisHeart).parent().find("span").html(likeCount.toString());
                }
                else {
                    $(thisHeart).parent().find("span").html("0");
                }
            }
        }
    });
    
    $("time.timeago").timeago();
    
    $("#getFile").on("click", function(event) {
        event.preventDefault();
        $("#file").click(); 
    });

    $("#sendPost").on("click", function() {
        var formData = new FormData(document.forms.formPost);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/news/save", true);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if(this.readyState !=4) return;
            if(this.status != 200) {
                alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
                return;
            }
            else {
                var result = JSON.parse(xhr.responseText);
                var postImg = "";
                var deletePost = "";
                if(result.photo_url != undefined) {
                    postImg = $("#postIMG").html();
                    postImg = postImg.replace("[image]", ("/media/users/" + result.page_owner_id + "/photo/" + result.photo_url));
                }
                if(isOwner || result.owner_id == $("#currentUserId").val()) {
                    deletePost = $("#postDelete").html();
                }
                var tmp = $("#newsBlock").html();
                tmp = tmp.replace("[id]", result.id);
                tmp = tmp.replace("[PostImage]", postImg);
                tmp = tmp.replace("[text]", result.post_text);
                tmp = tmp.replace("[date]", result.publishing_date);
                tmp = tmp.replace("[userID]", result.user_id);
                tmp = tmp.replace("[userID]", result.user_id);
                if(result.image.split('_')[0] == 'default') {
                    tmp = tmp.replace("[userImage]", "/media/users/" + result.image);
                }
                else {
                    tmp = tmp.replace("[userImage]", "/media/users/" + result.user_id + "/photo/" + result.image);
                }
                tmp = tmp.replace("[userName]", result.surname + " " + result.name);
                tmp = tmp.replace("[delete]", deletePost);
                tmp = tmp.replace("[isLiked]", "favorite_border");
                tmp = tmp.replace("[count]", "0");
                tmp = tmp.replace('[comment_count]', "0");
                var tmpObj = $(tmp);
                $(tmp).insertAfter($("#createPostBlock"));
                $("time.timeago").timeago();
                grid.masonry("prepended", tmpObj).masonry('layout');;
                setTimeout(setReload, 210);
                newsEnd++;
                setTimeout(setMenuHeight, 211);
            }
        }
    });

function setReload() {
    grid.masonry("reloadItems");
    grid.masonry('layout');
}
    
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
 
  setTimeout(setReload, 100);
  setTimeout(setMenuHeight, 251);
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