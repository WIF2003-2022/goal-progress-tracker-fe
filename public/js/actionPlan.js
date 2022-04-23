var img_ap =
  "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRINomLSaFLHVYYfShk5a8DZ8SkubojQhUeLQ&usqp=CAU";
AP = [
  { title: "Action Plan 1", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 2", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 3", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 4", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 5", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 6", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 7", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 8", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 9", due: "DD/MM/YYY", image: img_ap },
  { title: "Action Plan 10", due: "DD/MM/YYY", image: img_ap },
];

// document.write(
//   "<div class='row'><div class='col-2'></div><h2>Goal X Action Plans</h2></div><div class='row'><div class='col-12 offset-12'><button style='border: none; background: none;'><i class='bi-plus-circle' style='font-size:30px;'></i></button></div></div>"
// );

document.write("<ul>");
document.write("<div class='row continueAdd'>");
for (i = 0; i < 4; i++) {
  document.write("<li class='card col-3 m-3 shadow'>");
  document.write("<div class='row'>");
  document.write("<div class='col-9'></div>");
  document.write(
    "<div class='col-1'><button onclick='myFunction(event)' class='changing' style='border: none; background: none;'><i class='bi-pencil'></i></button></div>"
  );
  document.write(
    "<div class='col-1'><button class='close' style='border: none; background: none;'><i class='bi-trash-fill'></i></button></div>"
  );
  document.write("</div>");
  if (AP[i].image.length > 0) {
    document.write(
      "<img class='card-img-top' src='" +
        AP[i].image +
        "' alt='Card image cap'></img>"
    );
  }
  document.write("<div class='card-body'>");
  document.write(
    "<a href='activity.html' style='text-decoration: none;' class='card-text titleText'>" +
      AP[i].title +
      "</a>"
  );
  document.write("<p class='card-text dueText'>Due " + AP[i].due + "</p>");
  document.write("</div>");
  document.write("</li>");
}
document.write("</div>");
document.write("</ul>");

function addHTML(newTitle, newDue, img = img_ap) {
  return (
    `
  <li class="card col-3 m-3 shadow">
    <div class="row">
      <div class="col-9"></div>
      <div class="col-1"><button onclick="myFunction(event)" class="changing" style="border: none; background: none;"><i class="bi-pencil"></i></button></div>
      <div class="col-1"><button class="close" style="border: none; background: none;"><i class="bi-trash-fill"></i></button></div>
    </div>
    <img class="card-img-top" src="` +
    img +
    `"alt="Card image cap"></img>
    <div class="card-body">
      <a href='activity.html' style='text-decoration: none;' class="card-text titleText">` +
    newTitle +
    `</a>
      <p class="card-text dueText">Due ` +
    newDue +
    `</p>
    </div>
`
  );
}

// add function
$(".add").on("click", function () {
  $(".continueAdd").append(addHTML("new Action Plan", "new DD/MM/YYYY"));
});

// edit function (under construction -- will change all text for the same tag)
/*
var change = document.querySelectorAll(".changing");
var titleTexts = document.querySelectorAll(".titleText");
var dueTexts = document.querySelectorAll(".dueText");
console.log(change);
function myFunction(event) {
  alert(event.target.nodeValue);
}
*/

$(".changing").click(function () {
  $(".titleText").text("Hello world!");
});

// delete function (cannot delete newly added cards)
$(".close").on("click", function () {
  $(this).closest("li").remove();
});
