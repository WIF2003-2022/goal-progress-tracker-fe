<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Goals</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/goal.css" />
  </head>

  <body>
    <?php 
    //require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");  
    require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
    // current user data already saved in session
    // so you can just retrieve them from the session
    session_start();
    $userStr = $_SESSION['auth'];
    // getting from session would be a string
    // need to decode to get the class/object
    $user = json_decode($userStr);
    $userid = json_decode($userStr, true)["user_id"];
    if (!$user) {
        header("Location: ./login.php"); //change location of http header to login.php
    }
    ?>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container-float">
          <!-- Use 1 Row, with 3 columns(Left, Middle, Right)-->
          <div class="row m-2 justify-content-center">
            <!-- Left Column -->
            <div class="col-md-3">
              <div class="leftColumn">
                <div class="folder" id="btnFolder">
                  <?php 
                    $goalAllCount = "SELECT COUNT(goal_id) AS noOfAllGoals
                    FROM goal
                    WHERE mentee_id = $userid";

                    $goalActiveCount = "SELECT COUNT(goal_id) AS noOfActiveGoals
                    FROM goal
                    WHERE goal_status = 'Active'
                    AND mentee_id = $userid";

                    $goalAccomplishedCount = "SELECT COUNT(goal_id) AS noOfAccomplishedGoals
                    FROM goal
                    WHERE goal_status = 'Accomplished'
                    AND goal_progress = 100
                    AND mentee_id = $userid";

                    $goalFailedCount = "SELECT COUNT(goal_id) AS noOfFailedGoals
                    FROM goal
                    WHERE goal_status = 'Failed'
                    AND mentee_id = $userid";

                    $queryAll = mysqli_query($conn, $goalAllCount);
                    $queryActive = mysqli_query($conn, $goalActiveCount);
                    $queryAccomplished = mysqli_query($conn, $goalAccomplishedCount);
                    $queryFailed = mysqli_query($conn, $goalFailedCount);

                    $allGoalCount = mysqli_fetch_assoc($queryAll);
                    $activeGoalCount = mysqli_fetch_assoc($queryActive);
                    $accomplishedGoalCount = mysqli_fetch_assoc($queryAccomplished);
                    $failedGoalCount = mysqli_fetch_assoc($queryFailed);
                  ?>

                  <div
                    class="btn allGoal current"
                    onclick="filterFolder('all')"
                  >
                    <div class="naming">All</div>
                    <div class="goalCount"><?php echo $allGoalCount['noOfAllGoals'] ?></div>
                  </div>

                  <hr />

                  <h6>Status</h6>
                  <div class="btn activeGoal" onclick="filterFolder('active')">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="naming">Active</div>
                    <div class="goalCount"><?php echo $activeGoalCount['noOfActiveGoals'] ?></div>
                  </div>
                  <div
                    class="btn accomplishedGoal"
                    onclick="filterFolder('accomplished')"
                  >
                    <span class="material-icons-sharp">done_all</span>
                    <div class="naming">Accomplished</div>
                    <div class="goalCount"><?php echo $accomplishedGoalCount['noOfAccomplishedGoals'] ?></div>
                  </div>
                  <div class="btn failedGoal" onclick="filterFolder('failed')">
                    <span class="material-icons-sharp">cancel</span>
                    <div class="naming">Failed</div>
                    <div class="goalCount"><?php echo $failedGoalCount['noOfFailedGoals'] ?></div>
                  </div>
                </div>
                <!-- End of Folder-->

                <hr />

                <div class="category">
                  <h6>Categories</h6>
                  <?php
                    $goalPersonalCount = "SELECT COUNT(goal_id) AS noOfPersonalGoals
                    FROM goal
                    WHERE goal_category = 'Personal'
                    AND mentee_id = $userid";

                    $goalHealthCount = "SELECT COUNT(goal_id) AS noOfHealthGoals
                    FROM goal
                    WHERE goal_category = 'Health'
                    AND mentee_id = $userid";

                    $goalSchoolCount = "SELECT COUNT(goal_id) AS noOfSchoolGoals
                    FROM goal
                    WHERE goal_category = 'School'
                    AND mentee_id = $userid";

                    $goalFamilyCount = "SELECT COUNT(goal_id) AS noOfFamilyGoals
                    FROM goal
                    WHERE goal_category = 'Family'
                    AND mentee_id = $userid";

                    $goalSkillCount = "SELECT COUNT(goal_id) AS noOfSkillGoals
                    FROM goal
                    WHERE goal_category = 'Skill'
                    AND mentee_id = $userid";

                    $queryPersonal = mysqli_query($conn, $goalPersonalCount);
                    $queryHealth = mysqli_query($conn, $goalHealthCount);
                    $querySchool = mysqli_query($conn, $goalSchoolCount);
                    $queryFamily = mysqli_query($conn, $goalFamilyCount);
                    $querySkill = mysqli_query($conn, $goalSkillCount);

                    $personalGoalCount = mysqli_fetch_assoc($queryPersonal);
                    $healthGoalCount = mysqli_fetch_assoc($queryHealth);
                    $schoolGoalCount = mysqli_fetch_assoc($querySchool);
                    $familyGoalCount = mysqli_fetch_assoc($queryFamily);
                    $skillGoalCount = mysqli_fetch_assoc($querySkill);
                  ?>

                  <div
                    class="btn personalGoal"
                    onclick="filterFolder('personal')"
                  >
                    <div class="naming">Personal</div>
                    <div class="goalCount"><?php echo $personalGoalCount['noOfPersonalGoals'] ?></div>
                  </div>

                  <div class="btn healthGoal" onclick="filterFolder('health')">
                    <div class="naming">Health</div>
                    <div class="goalCount"><?php echo $healthGoalCount['noOfHealthGoals'] ?></div>
                  </div>

                  <div class="btn schoolGoal" onclick="filterFolder('school')">
                    <div class="naming">School</div>
                    <div class="goalCount"><?php echo $schoolGoalCount['noOfSchoolGoals'] ?></div>
                  </div>

                  <div class="btn familyGoal" onclick="filterFolder('family')">
                    <div class="naming">Family</div>
                    <div class="goalCount"><?php echo $familyGoalCount['noOfFamilyGoals'] ?></div>
                  </div>

                  <div class="btn skillGoal" onclick="filterFolder('skill')">
                    <div class="naming">Skill</div>
                    <div class="goalCount"><?php echo $skillGoalCount['noOfSkillGoals'] ?></div>
                  </div>
                </div>
                <!-- End of Category -->
                <hr />
              </div>
            </div>
            <!-- End of Left Column-->

            <!-- Middle Column -->
            <div id="middle" class="col-md-7">
              <?php
                $goalDetails = "SELECT * FROM goal WHERE mentee_id = $userid";
                if($goalResult = mysqli_query($conn, $goalDetails)){
                  $rowTableCount = mysqli_num_rows($goalResult);
                  $goalRow = array();
                  for ($i=0; $i < $rowTableCount ; $i++) { 
                    $goalRow[$i] = mysqli_fetch_assoc($goalResult);
                  } 
                  mysqli_free_result($goalResult);
                } 
              ?>
              
              <script>
                const noOfRow = <?php echo json_encode($rowTableCount); ?>;
                var goalRow = <?php echo json_encode($goalRow); ?>;
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
                var percentage = goalRow[i]["goal_progress"];
                var percent = percentage.concat(percentSymbol);
                var progress = middle.getElementsByTagName("p");
                progress[i].textContent = percent;
                
                /*  stroke-dasharray="{{circle.circumference}}" 
                    stroke-dashoffset="{{circle.circumference * (1 - circle.percentage/100)}} */
                var offset = 226 * (1 - parseInt(percentage)/100);
                var offsetStr = offset.toString();
                var circle = middle.getElementsByTagName("circle");
                circle[i].style.strokeDasharray = '226';
                circle[i].style.strokeDashoffset = offsetStr;
                
                var dueDate = middle.getElementsByClassName("text-muted");
                dueDate[i].textContent = goalRow[i]["goal_due_date"];

                middle.appendChild(filterDiv);
              }
              </script>

              <!-- <div class="filterDiv active health goal1">
                <a href="action-main.html?id=1" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="middle">
                      <div class="left">
                        <h3><?php //echo $goalRow[0]['goal_title'] ?></h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p><?php //echo $goalRow[0]['goal_progress'] . "%" ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted"><?php //echo $goalRow[0]['goal_due_date'] ?></div>
                    </div>
                  </div>
                </a>
              </div> -->
              <!--End of Goal No.1-->

              <!-- <div class="filterDiv active personal goal2">
                <a href="action-main.html?id=2" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="middle">
                      <div class="left">
                        <h3><?php //echo $goalRow[1]['goal_title'] ?></h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p><?php //echo $goalRow[1]['goal_progress'] . "%" ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted"><?php //echo $goalRow[1]['goal_due_date'] ?></div>
                    </div>
                  </div>
                </a>
              </div> -->
              <!--End of Goal No.2-->
              <!-- <div class="filterDiv accomplished health goal3">
                <a href="action-main.html?id=3" class="remove-hyperlink">
                  <div class="card">
                    <span
                      class="material-icons-sharp"
                      style="background-color: #41f1b6"
                      >done_all</span
                    >
                    <div class="middle">
                      <div class="left">
                        <h3><?php //echo $goalRow[2]['goal_title'] ?></h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p><?php //echo $goalRow[2]['goal_progress'] . "%" ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted"><?php //echo $goalRow[2]['goal_due_date'] ?></div>
                    </div>
                  </div>
                </a>
              </div> -->
              <!--End of Goal No.3-->
              <!-- <div class="filterDiv failed personal goal4">
                <a href="action-main.html?id=4" class="remove-hyperlink">
                  <div class="card">
                    <span
                      class="material-icons-sharp"
                      style="background-color: #ff7782"
                      >cancel</span
                    >
                    <div class="middle">
                      <div class="left">
                        <h3><?php //echo $goalRow[3]['goal_title'] ?></h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p><?php //echo $goalRow[3]['goal_progress'] . "%" ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted"><?php //echo $goalRow[3]['goal_due_date'] ?></div>
                    </div>
                  </div>
                </a>
              </div> -->

              <!--End of Goal No.4-->

              <!-- <div class="filterDiv active school goal5">
                <a href="action-main.html?id=5" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="middle">
                      <div class="left">
                        <h3><?php //echo $goalRow[4]['goal_title'] ?></h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p><?php //echo $goalRow[4]['goal_progress'] . "%" ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted"><?php //echo $goalRow[4]['goal_due_date'] ?></div>
                    </div>
                  </div>
                </a>
              </div> -->

              <!--End of Goal No.5-->

              <!-- <div class="filterDiv active skill goal6">
                <a href="#" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="middle">
                      <div class="left">
                        <h3><?php //echo $goalRow[5]['goal_title'] ?></h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p><?php //echo $goalRow[5]['goal_progress'] . "%" ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted"><?php //echo $goalRow[5]['goal_due_date'] ?></div>
                    </div>
                  </div>
                </a>
              </div> -->
              <!--End of Goal No.6-->

              <!-- Add New Goal Card -->
              <div class="addGoal mb-3 order-last">
                <a href="goal-add-main.php" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">add</span>
                    <div>
                      <h3>Add Goal</h3>
                    </div>
                  </div>
                </a>
              </div>
              <!--End of Add New Goal div-->
            </div>
            <!-- End of Middle Column -->


            <?php 

            
            ?>

            <!-- Right Column -->
            <!--  
            <div class="col-md-4">
              <div class="filterDiv failed personal goal4">
                <a href="action-main.html?id=4" class="remove-hyperlink">
                  <div class="card">
                    <span
                      class="material-icons-sharp"
                      style="background-color: #ff7782"
                      >cancel</span
                    >
                    <div class="middle">
                      <div class="left">
                        <h3>Manange expenses within RM 1000 in April</h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p>81%</p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted">30 April 2022</div>
                    </div>
                  </div>
                </a>
              </div> 
            -->
            <!--End of Goal No.4-->
            <!--
              <div class="filterDiv active school goal5">
                <a href="action-main.html?id=5" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="middle">
                      <div class="left">
                        <h3>Score 4.0 in this semester</h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p>20%</p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted">20 June 2022</div>
                    </div>
                  </div>
                </a>
              </div>
              -->
            <!--End of Goal No.5-->
            <!--
              <div class="filterDiv active skill goal6">
                <a href="#" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">outlined_flag</span>
                    <div class="middle">
                      <div class="left">
                        <h3>Learn video-editing skill in 2 months</h3>
                      </div>
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p>60%</p>
                        </div>
                      </div>
                    </div>
                    <div class="deadline">
                      <span class="material-icons-sharp">event</span>
                      <div class="text-muted">15 May 2022</div>
                    </div>
                  </div>
                </a>
              </div>
              -->
            <!--End of Goal No.6-->
            <!--</div>-->

            <!-- End of Right Column -->
          </div>
          <!-- End of Row -->
          <!-- Row for Add Goal div -->
          <!--
          <div class="row m-2 justify-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-4">
              <div class="addGoal mb-3 order-last">
                <a href="goal-add.html" class="remove-hyperlink">
                  <div class="card">
                    <span class="material-icons-sharp">add</span>
                    <div>
                      <h3>Add Goal</h3>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          -->
        </div>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script src="./js/goal.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>
