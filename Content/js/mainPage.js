window.addEventListener("load", function() {
    var contentHeight = document.getElementById("main-content").offsetHeight;
    var leftHeight = document.getElementById("left-menu").offsetHeight;
    var rightHeight = document.getElementById("right-menu").offsetHeight;
    if(contentHeight > leftHeight) {
        document.getElementById("left-menu").style.height = contentHeight + "px";
    }
    if(contentHeight > rightHeight) {
        document.getElementById("right-menu").style.height = contentHeight + "px";
    }
    
    $("#getFile").on("click", function(event) {
        event.preventDefault();
       $("#file").click(); 
    });
    
    
    $(document).resize(function() {
        var contentHeight = document.getElementById("main-content").offsetHeight;
    var leftHeight = document.getElementById("left-menu").offsetHeight;
    var rightHeight = document.getElementById("right-menu").offsetHeight;
    if(contentHeight > leftHeight) {
        document.getElementById("left-menu").style.height = contentHeight + "px";
    }
    if(contentHeight > rightHeight) {
        document.getElementById("right-menu").style.height = contentHeight + "px";
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
 
  document.getElementById('file').addEventListener('change', showFile, false);

    
    
    
    
});

$(document).ready(function(){
    $('.materialboxed').materialbox();
  });