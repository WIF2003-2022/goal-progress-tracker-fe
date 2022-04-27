var deleteTag = document.getElementsByClassName("delete-btn");
var i;
for(i=0; i<deleteTag.length; i++){
    deleteTag[i].addEventListener("click", function(){
        this.parentElement.style.display = "none";
    });
}