// Filter Function
filterFolder("all"); // defaultly set it as displaying all goals
function filterFolder(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") {
    c = "";
  }

  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    removeClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) {
      addClass(x[i], "show");
    }
  }
}

// Show filtered elements
function addClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function removeClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add current class to the current control button (highlight it)
var btns = document.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("btn current");
    current[0].className = current[0].className.replace(" current", "");
    this.className += " current";
  });
}

///////////////////////////////////////////

// Create the Card to display Goals

var middle = document.getElementById("middle");
for (let i = 0; i < noOfRow; i++) {
  var filterDiv = document.createElement("div");
  filterDiv.classList.add("filterDiv");

  filterDiv.innerHTML = `
                      <div class="card">
                        <a id="redirect" href="" class="remove-hyperlink">
                          <span id="icon" class="material-icons-sharp goalIcon"></span>
                          <div class="middle">
                            <div class="left">
                              <h3></h3>
                            </div>
                            <div class="percentage">
                              <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                              </svg>
                              <div class="number">
                                <p></p>
                              </div>
                            </div>
                          </div>
                          <div class="deadline">
                            <span class="material-icons-sharp">event</span>
                            <div class="text-muted"></div>
                          </div>
                        </a>
                      </div>
                  `;

  middle.appendChild(filterDiv);

  var goal = goalRow[i]["goal_id"];
  var url = "goal-details.php?id=" + goal;
  // console.log(url);
  var link = document.querySelectorAll("#redirect");
  link[i].href = url;
  // console.log(link[i].href);

  var status = goalRow[i]["goal_status"];
  var category = goalRow[i]["goal_category"];
  var icon = middle.querySelectorAll(".goalIcon");
  if (status == "Active") {
    filterDiv.classList.add("active");
    icon[i].textContent = "outlined_flag";
  } else if (status == "Accomplished") {
    filterDiv.classList.add("accomplished");
    icon[i].textContent = "done_all";
  } else if (status == "Failed") {
    filterDiv.classList.add("failed");
    icon[i].textContent = "cancel";
  }

  if (category == "Personal") {
    filterDiv.classList.add("personal");
  } else if (category == "Health") {
    filterDiv.classList.add("health");
  } else if (category == "School") {
    filterDiv.classList.add("school");
  } else if (category == "Family") {
    filterDiv.classList.add("family");
  } else if (category == "Skill") {
    filterDiv.classList.add("skill");
  }

  var goalStr = "goal";
  var goalNo = goalStr.concat(goal);
  filterDiv.classList.add(goalNo);

  var title = middle.getElementsByTagName("h3");
  title[i].textContent = goalRow[i]["goal_title"];

  var percentSymbol = "%";
  var percent = goalRow[i]["goal_progress"].concat(percentSymbol);
  var progress = middle.getElementsByTagName("p");
  progress[i].textContent = percent;

  var dueDate = middle.getElementsByClassName("text-muted");
  dueDate[i].textContent = goalRow[i]["goal_due_date"];

  middle.appendChild(filterDiv);
}

//delete funtion
/*
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

*/

//JQuery
/*
$(".close").on("click", function () {
  if (confirm("Are you sure you want to delete this action plan?")) {
    $(this).closest("li").remove();
  }
});
*/
