var deleteTag = document.getElementsByClassName("delete-btn");
var targetContent = document.getElementsByClassName("content");
var i;
function myfunction(){
    for(i=0; i<deleteTag.length; i++){
        deleteTag[i].addEventListener("click", function(){
            this.parentElement.style.display = "none";
        });
    }
}