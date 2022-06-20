const progressB = document.querySelector(".sort-progress");
const dateB = document.querySelector(".sort-date");
const userL = document.querySelector(".userID");
const roleL = document.querySelector(".role");
console.log(findGetParameter("sort"));
if (findGetParameter("sort") == "date") {
  dateB.classList.toggle("date-pressed");
} else {
  progressB.classList.toggle("progress-pressed");
}

progressB.addEventListener("click", (e) => {
  e.preventDefault();
  progress = document.querySelector(".progressSort");
  date = document.querySelector(".dateSort");
  if (progress.value == "DESC") {
    progress.value = "ASC";
    orderP = "ASC";
    valueP = "Least_Progress";
  } else {
    progress.value = "DESC";
    orderP = "DESC";
    valueP = "Highest_Progress";
  }
  orderD = date.value;
  valueD = dateB.value;
  sortMethod = "progress";
  console.log(progress.value);
  window.location =
    "./social-goal.php?userID=" +
    userL.value +
    "&role=" +
    roleL.value +
    "&sort=" +
    sortMethod +
    "&orderD=" +
    orderD +
    "&orderP=" +
    orderP +
    "&valueD=" +
    valueD +
    "&valueP=" +
    valueP;
});

dateB.addEventListener("click", (e) => {
  e.preventDefault();
  progress = document.querySelector(".progressSort");
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
  orderP = progress.value;
  valueP = progressB.value;
  sortMethod = "date";
  console.log(date.value);
  window.location =
    "./social-goal.php?userID=" +
    userL.value +
    "&role=" +
    roleL.value +
    "&sort=" +
    sortMethod +
    "&orderD=" +
    orderD +
    "&orderP=" +
    orderP +
    "&valueD=" +
    valueD +
    "&valueP=" +
    valueP;
});

function findGetParameter(parameterName) {
  var result = null,
    tmp = [];
  location.search
    .substr(1)
    .split("&")
    .forEach(function (item) {
      tmp = item.split("=");
      if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    });
  return result;
}
