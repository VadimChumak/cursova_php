$(window).on('load', function() {
    var newsLoadPosition = 0;
    var newsEmpty = false;
    var isOwner = false;
    if(document.getElementById('isOwner') != undefined) {
        isOwner = true;
    }

    $('#createPost').on("click", function(){
        $('#modal_createPost').modal('open');
    });

    $(".wall").on("click", ".comment-btn", function(event) {
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
                Materialize.toast('' + (this.status ? this.statusText : 'запит не вдався'), 1000);
                return;
            }
            else {
                var count = $(commentImg).html();
                count++;
                $(commentImg).html(count.toString());
                var result = JSON.parse(xhr.responseText);
                var comment = new CommentModel(
                    result.user_id,
                    result.name,
                    result.surname,
                    result.image,
                    result.date,
                    result.text
                );
                var block = comment.getCommentBlock();
                var blockObject = $(block);
                $(commentList).append(blockObject);
                $("time.timeago").timeago();
                setTimeout(reloadMasonry, 100);
                setTimeout(setMenuHeight, 101);
            }
        }
    });

    $(".wall").on("click", ".delete-news", function() {
        var newsId = $(this).parent().parent().find("input[type=hidden]").val();
        var block = $(this).parent().parent().parent();
        $(block).fadeOut(200, function(){
            $(block).remove();
            setTimeout(reloadMasonry, 100);
            setTimeout(setMenuHeight, 101);
        });
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/news/delete", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var res = "postId=" + encodeURIComponent(newsId);
        xhr.send(res);
        Materialize.toast("Запис видалено.", 1000);
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
                Materialize.toast('' + (this.status ? this.statusText : 'запит не вдався'), 1000);
                return;
            }
            else {
                var result = JSON.parse(xhr.responseText);
                if(result.length == 0) {
                }
                else {
                    result.forEach(function(item, i, arr) {
                        var comment = new CommentModel(
                            item.user_id,
                            item.name,
                            item.surname,
                            item.image,
                            item.date,
                            item.text
                        );
                        var block = comment.getCommentBlock();
                        var blockObject = $(block);
                        $(commentList).append(blockObject);
                        $("time.timeago").timeago();
                        setTimeout(reloadMasonry, 100);
                        setTimeout(setMenuHeight, 101);
                    });
                }
                card.find(".comment").slideDown(10, function() {
                setTimeout(reloadMasonry, 0);
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

    $(window).scroll(function() 
    {
        if  (($(window).scrollTop() == $(document).height() - $(window).height()) && newsEmpty == false) 
        {
            var newsEnd = 99;
            newsLoadPosition += 10;
            var pageOwnerId = document.getElementById('page_owner_id').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/news/get', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var res = "from=" + encodeURIComponent(newsLoadPosition) + "&to=" + encodeURIComponent(newsEnd) + "&owner=" + encodeURIComponent(pageOwnerId);
            xhr.send(res);
            xhr.onreadystatechange = function() {
            if(this.readyState != 4) return;
                if(this.status != 200) {
                    Materialize.toast('' + (this.status ? this.statusText : 'запит не вдався'), 1000);
                }
                else {
                    var result = JSON.parse(xhr.responseText);
                    if(result.length == 0) {
                        newsEmpty = true;
                    }
                    else {
                        result.forEach(function(item, i, arr) {
                            var images = null;
                            var videos = null;
                            var audios = null;
                            if(item.images.length > 0) {
                                var arr = [];
                                item.images.forEach(function(list, i, ar) {
                                    arr.push(list.title);
                                });
                                images = {
                                    'name': arr
                                }
                            }
                            if(item.videos.length > 0) {
                                var arr = [];
                                item.videos.forEach(function(list, i, ar) {
                                    arr.push(list.title);
                                });
                                videos = {
                                    'name': arr
                                }
                            }
                            if(item.audios.length > 0) {
                                var arr = [];
                                item.audios.forEach(function(list, i, ar) {
                                    arr.push(list.title);
                                });
                                audios = {
                                    'name': arr
                                }
                            }
                            var post = new NewsModel(
                                item.id, 
                                item.page_owner_id, 
                                item.user_id, 
                                item.image, 
                                item.name, 
                                item.surname, 
                                item.isLiked,
                                item.comment_count,
                                item.count,
                                item.post_text,
                                item.publishing_date,
                                images,
                                videos,
                                audios
                            );
                            var block = post.getNewsBlock();
                            var blockObject = $(block);
                            $(".wall").append(blockObject).masonry("appended", blockObject);
                            $("time.timeago").timeago();
                        });
                        setTimeout(reloadMasonry, 210);
                        setTimeout(setMenuHeight, 215);
                    }
                }
            }
        }
        else if  (($(window).scrollTop() == $(document).height() - $(window).height()) && newsEmpty != false) {
            Materialize.toast('На стіні більше немає записів.', 4000);
        }
    });

    $('#sendPost').on('click', function(event) {
        event.preventDefault();
        var formData = new FormData(document.forms.formPost);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/news/save', true);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if(this.readyState != 4) return;
            if(this.status != 200) {
                Materialize.toast('' + (this.status ? this.statusText : 'запит не вдався'), 1000);
            }
            else {
                var result = JSON.parse(xhr.responseText);
                var post = new NewsModel(
                    result.id, 
                    result.page_owner_id, 
                    result.user_id, 
                    result.image, 
                    result.name, 
                    result.surname, 
                    false,
                    0,
                    0,
                    result.post_text,
                    result.publishing_date,
                    result.images,
                    result.videos,
                    result.audios
                );
                var block = post.getNewsBlock();
                var blockObject = $(block);
                $(block).insertAfter($("#createPostBlock"));
                $('time.timeago').timeago();
                $('.wall').masonry('prepended', blockObject).masonry('layout');
                newsLoadPosition++;
                setTimeout(reloadMasonry, 210);
                setTimeout(setMenuHeight, 211);
            }
        }
    });


    function reloadMasonry() {
        $('.wall').masonry('reloadItems');
        $('.wall').masonry('layout');
    }
    function setMenuHeight() {
        var contentHeight = document.getElementById("main-content").offsetHeight;
        var leftHeight = document.getElementById("left-menu").offsetHeight;
        if(contentHeight > leftHeight) {
        document.getElementById("left-menu").style.height = contentHeight + "px";
    }
    }


    function CommentModel(userId, name, surname, userImage, date, text) {
        this.userId = userId;
        this.userImage = userImage;
        this.date = date;
        this.text = text;
        this.name = name;
        this.surname = surname;
    }
    CommentModel.prototype.getCommentBlock = function() {
        var blockHtml = document.getElementById('sendComment').innerHTML;
        blockHtml = blockHtml.replace('[userID]', this.userId);
        blockHtml = blockHtml.replace('[userID]', this.userId);
        if(this.userImage.split('_')[0] == 'default') {
            blockHtml = blockHtml.replace("[userImage]", "/media/users/" + this.userImage);
        }
        else {
            blockHtml = blockHtml.replace("[userImage]", "/media/users/" + this.userId + "/photo/" + this.userImage);
        }
        blockHtml = blockHtml.replace('[userName]', this.surname + ' ' + this.name);
        blockHtml = blockHtml.replace('[date]', this.date);
        blockHtml = blockHtml.replace('[text]', this.text);
        return blockHtml;
    }

    function NewsModel(id = null, pageOwner = null, authorId = null, authorImage = null, authorName = null, authorSurname = null, isLiked = null, commentCount = null, likeCount = null, text = null, date = null, images = null, videos = null, audios = null) {
        this.id = id;
        this.text = text;
        this.date = date;
        this.images = images;
        this.videos = videos;
        this.audios = audios;
        this.authorId = authorId;
        this.authorImage = authorImage;
        this.authorName = authorName;
        this.authorSurname = authorSurname;
        this.commentCount = commentCount;
        this.likeCount = likeCount;
        this.pageOwner = pageOwner;
        this.isLiked = isLiked;
    }
    NewsModel.prototype.getNewsBlock = function() {
        var blockHtml = document.getElementById("newsBlock").innerHTML;
        var postImages = "";
        var postVideos = "";
        var postAudios = "";
        var deleteSection = "";
        if(this.images != undefined) {
            if(this.images != null && this.images.name.length > 0) {
                postImages = document.getElementById("postIMG").innerHTML;
                postImages = postImages.replace('[MainImage]', '<img src="/media/users/' + this.pageOwner + '/photo/' + this.images.name[0] + '">');
                if(this.images.name.length > 1) {
                    var otherImages = "<div>";
                    for(var i = 1; i < this.images.name.length; i++) {
                        otherImages += "<img src='/media/users/" + this.pageOwner + "/photo/" + this.images.name[i] + "'>";
                    }
                    otherImages += "</div>"
                    postImages = postImages.replace('[OtherImage]', otherImages);
                }
                else {
                    postImages = postImages.replace('[OtherImage]', '');
                }
            }
        }
        if(this.videos != undefined) {
            if(this.videos.name.length > 0 && this.videos != null) {
                var videoList = "";
                this.videos.name.forEach(function(item, i, arr) {
                    videoList += "<video controls><source src='/media/video/" + item + "'></video>";
                });
                postVideos = document.getElementById('postVIDEO').innerHTML;
                postVideos = postVideos.replace('[videoList]', videoList);
            }
        }
        if(this.audios != undefined){
            if(this.audios.name.length > 0 && this.audios != null) {
                var audioList = "";
                this.audios.name.forEach(function(item, i, arr) {
                    audioList += '<p>' + item + '<audio controls><source src="/media/music/' + item+ '"></audio>';
                });
                postAudios = document.getElementById('postAUDIO').innerHTML;
                postAudios = postAudios.replace("[musicList]", audioList);
            }
        }
        if(isOwner || this.authorId == document.getElementById('currentUserId').value) {
            deleteSection = document.getElementById('postDelete').innerHTML;
        }
        blockHtml = blockHtml.replace('[id]', this.id);
        if(this.text.length > 0) {
            blockHtml = blockHtml.replace('[text]', '<div class="card-content"><p>' + this.text + '</p></div>');
        }
        else {
            blockHtml = blockHtml.replace('[text]', '');
        }
        blockHtml = blockHtml.replace('[date]', this.date);
        blockHtml = blockHtml.replace('[userID]', this.authorId);
        blockHtml = blockHtml.replace('[userID]', this.authorId);
        blockHtml = blockHtml.replace('[PostImage]', postImages);
        blockHtml = blockHtml.replace('[PostVideo]', postVideos);
        blockHtml = blockHtml.replace('[PostAudio]', postAudios);
        if(this.authorImage.split('_')[0] == 'default') {
            blockHtml = blockHtml.replace('[userImage]', '/media/users/' + this.authorImage);
        }
        else {
            blockHtml = blockHtml.replace("[userImage]", "/media/users/" + this.authorId + "/photo/" + this.authorImage);
        }
        blockHtml = blockHtml.replace('[userName]', this.authorSurname + ' ' + this.authorName);
        blockHtml = blockHtml.replace('[delete]', deleteSection);
        if(this.isLiked) {
            blockHtml = blockHtml.replace('[isLiked]', 'favorite');
        }
        else {
            blockHtml = blockHtml.replace('[isLiked]', 'favorite_border');
        }
        blockHtml = blockHtml.replace('[count]', this.likeCount);
        blockHtml = blockHtml.replace('[comment_count]', this.commentCount);
        return blockHtml;
    }
});