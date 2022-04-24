//delete funtion
var elem = document.querySelectorAll(".deleteAct");
for (i = 0; i < elem.length; i++) {
  elem[i].addEventListener("click", function () {
    if (confirm("Are you sure you want to delete this activity?")) {
      this.closest("li").remove();
    }
  });
}

//Jquery
/*
$(".deleteAct").on("click", function () {
  if (confirm("Are you sure you want to delete this action plan?")) {
    $(this).closest("li").remove();
  }
});
*/
