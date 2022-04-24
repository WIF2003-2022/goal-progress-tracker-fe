//delete funtion
var elem = document.querySelectorAll(".deleteAP");
for (i = 0; i < elem.length; i++) {
  elem[i].addEventListener("click", function () {
    if (confirm("Are you sure you want to delete this action plan?")) {
      this.closest("li").remove();
    }
  });
}

//JQuery
/*
$(".close").on("click", function () {
  if (confirm("Are you sure you want to delete this action plan?")) {
    $(this).closest("li").remove();
  }
});
*/
