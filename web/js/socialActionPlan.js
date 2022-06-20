const dateB = document.querySelector(".sort-date");
const userL = document.querySelector(".userID");
const roleL = document.querySelector(".role");
const goalL = document.querySelector(".goalID");

dateB.addEventListener("click", (e) => {
  e.preventDefault();
  date = document.querySelector(".dateSort");
  if (date.value == "ASC") {
    date.value = "DESC";
    orderD = "DESC";
    valueD = "Latest_Due";
  } else {
    date.value = "ASC";
    orderD = "ASC";
    valueD = "Earliest_Due";
  }
  sortMethod = "date";
  console.log(date.value);
  window.location =
    "./social-actionplan.php?userID=" +
    userL.value +
    "&goalID=" +
    goalL.value +
    "&role=" +
    roleL.value +
    "&orderD=" +
    orderD +
    "&valueD=" +
    valueD;
  exit();
});

// function findGetParameter(parameterName) {
//   var result = null,
//     tmp = [];
//   location.search
//     .substr(1)
//     .split("&")
//     .forEach(function (item) {
//       tmp = item.split("=");
//       if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
//     });
//   return result;
// }
