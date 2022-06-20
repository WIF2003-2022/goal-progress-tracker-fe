// get variable(array) from another js file
var goalR = JSON.parse(sessionStorage.getItem("goalR"));
console.log(goalR);

if (goalR["mentor_id"] != null) {
  var getNameRes = JSON.parse(sessionStorage.getItem("getNameRes"));
  console.log(getNameRes);
}

var detail = document.getElementById("detail");
var goalDetail = document.querySelector(".goalDetails");
var stat = goalR["goal_status"];
var icon = detail.querySelector("#icon");
if (stat == "Active") {
  goalDetail.classList.add("active");
  icon.textContent = "outlined_flag";
} else if (stat == "Accomplished") {
  goalDetail.classList.add("accomplished");
  icon.textContent = "done_all";
} else if (stat == "Failed") {
  goalDetail.classList.add("failed");
  icon.textContent = "cancel";
}

var cate = goalR["goal_category"];
var goalCategory = detail.querySelector(".goalCategory");
goalCategory.textContent += cate;
var img = document.querySelector("img");
if (cate == "Personal") {
  img.src = "./images/personalPhoto.jpg";
} else if (cate == "Health") {
  img.src = "./images/healthPhoto.jpg";
} else if (cate == "School") {
  img.src = "./images/schoolPhoto.jpg";
} else if (cate == "Family") {
  img.src = "./images/familyPhoto.jpg";
} else if (cate == "Skill") {
  img.src = "./images/skillPhoto.jpg";
}

// getElementsByTagName(), getElementsByClassName(), getElementsByName()  --  give an array, so need to add [0] to inidcate which element
// getElementById  --  get only 1 specfic element (since id is unique), so no need to add [0]
var title = document.getElementsByClassName("goalTitle");
title[0].textContent = goalR["goal_title"];

var description = document.getElementsByClassName("goalDescription");
description[0].textContent += goalR["goal_description"];

var tracking = document.getElementsByClassName("goalTracking");
tracking[0].textContent += goalR["tracking_method"];

var mentor = document.getElementsByClassName("goalMentor");
if (goalR["mentor_id"] == null) {
  mentor[0].textContent += "no mentor";
} else {
  // mentor[0].textContent += goalR["mentor_id"];
  mentor[0].textContent +=
    getNameRes["name"] + " (" + getNameRes["email"] + ")";
}

var percentSymbol = "%";
var percent = goalR["goal_progress"].concat(percentSymbol);
var percentage = goalR["goal_progress"];
var progress = document.getElementsByTagName("p");
progress[0].textContent = percent;

var offset = 226 * (1 - parseInt(percentage) / 100);
var offsetStr = offset.toString();
var circle = detail.getElementsByTagName("circle");
circle[0].style.strokeDasharray = "226";
circle[0].style.strokeDashoffset = offsetStr;

var startDate = document.getElementById("startDate");
startDate.textContent += goalR["goal_start_date"];

var endDate = document.getElementById("endDate");
endDate.textContent += goalR["goal_due_date"];

var urlAp =
  "action-main.html?goal_name=" +
  goalR["goal_title"] +
  "&goal_id=" +
  goalR["goal_id"];
console.log(urlAp);
var linkAp = document.querySelector("#apLink");
linkAp.href = url;
console.log(linkAp.href);
