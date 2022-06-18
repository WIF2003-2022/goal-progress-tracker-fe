// get variable(array) from another js file
var goalR = JSON.parse(sessionStorage.getItem("goalR"));
console.log(goalR);

var detail = document.getElementById("detail");
var goalDetail = detail.querySelector(".goalDetails");
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
var title = detail.getElementsByTagName("h3");
title[0].textContent = title[0].textContent + goalR["goal_title"];

var description = document.getElementsByClassName("goalDescription");
// description[0].textContent =
//   description[0].textContent + goalR["goal_description"];
description[0].append(goalR["goal_description"]);

var tracking = document.getElementsByClassName("goalTracking");
tracking[0].textContent = goalR["tracking_method"];

var mentor = document.getElementsByClassName("goalMentor");
mentor[0].textContent = goalR["mentor_id"];

var percentSymbol = "%";
var percent = goalR["goal_progress"].concat(percentSymbol);
var progress = document.getElementsByTagName("p");
progress[0].textContent = percent;

var startDate = document.getElementById("startDate");
startDate.textContent += goalR["goal_start_date"];

var endDate = document.getElementById("endDate");
endDate.textContent += goalR["goal_due_date"];
