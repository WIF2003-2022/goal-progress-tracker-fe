//delete funtion
var elem = document.querySelectorAll(".deleteGoal");
var key = document.querySelector(".deleteButton");
for (i = 0; i < elem.length; i++) {
  elem[i].addEventListener("click", function () {
    var x = this.closest("div");
    key.addEventListener("click", function () {
      x.remove();
      this.closest("div").querySelector(".cancelButton").click();
    });
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
