AP = [
  { title: "Action Plan 1", due: "DD/MM/YYY" },
  { title: "Action Plan 2", due: "DD/MM/YYY" },
  { title: "Action Plan 3", due: "DD/MM/YYY" },
  { title: "Action Plan 4", due: "DD/MM/YYY" },
  { title: "Action Plan 5", due: "DD/MM/YYY" },
  { title: "Action Plan 6", due: "DD/MM/YYY" },
  { title: "Action Plan 7", due: "DD/MM/YYY" },
  { title: "Action Plan 8", due: "DD/MM/YYY" },
  { title: "Action Plan 9", due: "DD/MM/YYY" },
];

for (i = 0; i < AP.length; i++) {
  if (i % 2 == 0) {
    document.write("<div class='row justify-content-center'>");
    document.write("<div class='col-1'></div>");
  }

  document.write("<div class='card col-4'>");
  document.write("<div class='row'>");
  document.write("<div class='col-8'></div>");
  document.write(
    "<div class='col-1'><a href=''><i class='bi-pencil-square'></i></a></div>"
  );
  document.write(
    "<div class='col-1'><a href=''><i class='bi-trash-fill'></i></a></div>"
  );
  document.write("</div>");
  document.write(
    "<img class='card-img-top' src='https://miro.medium.com/max/1000/1*MLcFQWtsuE52LQ9FRbZxow.jpeg' alt='Card image cap'>"
  );
  document.write("<div class='card-body'>");
  document.write("<p class='card-text'>" + AP[i].title + "</p>");
  document.write("<p class='card-text'>Due " + AP[i].due + "</p>");
  document.write("</div>");
  document.write("</div>");
  document.write("<div class='col-1'></div>");
  if ((i + 1) % 2 == 0) {
    document.write("</div><br>");
  }
}
