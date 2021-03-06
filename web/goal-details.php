<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Goal Details</title>

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
    <link rel="stylesheet" href="./styles/goal-details.css" />
  </head>

  <body>
  <?php 
    //require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");  
    require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
    require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
    ?>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container-float">
          <div class="row m-4 justify-content-center">
            <div id="detail" class="col-md-10">
              <div class="goalDetails">
                <?php
                  $id = $_GET["id"];
                  $goalDetails = "SELECT * FROM goal WHERE goal_id = $id";
                  $goalRes = mysqli_query($conn, $goalDetails);
                  $goalR = mysqli_fetch_assoc($goalRes);
                    
                  mysqli_free_result($goalRes);
                  $apIDRes;

                  $mentorID = $goalR['mentor_id'];
                  $getNameRes = null;
                  if (isset($mentorID)) {
                    $getNameSql = "SELECT * FROM user WHERE user_id = $mentorID";
                    $getNameQuery = mysqli_query($conn, $getNameSql);
                    $getNameRes = mysqli_fetch_assoc($getNameQuery);

                    mysqli_free_result($getNameQuery);
                  }
                ?>
                <div id="firstRow" class="row">
                  <div class="col-12 col-lg-6">
                    <div id="title" class="card">
                      <span id="icon" class="material-icons-sharp goalIcon"></span>
                      <div class="goalTitle"></div>
                      <hr>
                      <div class="goalContent">
                        <div class="goalDescription">Description : </div>
                        <div class="goalCategory">Category : </div>
                        <div class="goalTracking">Method Used to Track Goals : </div>
                        <div class="goalMentor">Mentor : </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-lg-4">
                    <div id="photo" class="card align-items-center">
                      <div class="photoFrame">
                        <img></img>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="secondRow" class="row">
                  <div class="col-12 col-lg-4">
                    <div id="date" class="card">
                      <div class="startDate">
                        <span class="material-icons-sharp">event</span>
                        <div id="startDate" class="text-muted">Start Date : </div>
                        <hr>
                      </div>
                      <div class="endDate">
                        <span class="material-icons-sharp">event</span>
                        <div id="endDate" class="text-muted">End Date : </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-lg-3">
                    <div id="percentage" class="card align-items-center">
                      <div class="percentage">
                        <svg>
                          <circle cx="38" cy="38" r="36"></circle>
                        </svg>
                        <div class="number">
                          <p></p>
                        </div>
                      </div>
                      <div class="updateGoalProgressBtn">
                        <br>
                        <a href="javascript:void(0);" data-id=<?php echo "$id" ?> class="btn btn-primary updateProgressBtn">Update Progress</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-lg-3">
                    <div id="button" class="card align-items-center">
                      <div class="actionPlanBtn">
                        <a id="apLink" href="" class="btn btn-primary">View Action Plans</a>
                        <hr>
                      </div>
                      <a href="javascript:void(0);" data-id=<?php echo "$id" ?> class="btn btn-sm editBtn">Edit</a>
                      <a href="javascript:void(0);" data-id=<?php echo "$id" ?> class="btn btn-danger btn-sm deleteBtn">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      // access variable from php in js
      var goalR = <?php echo json_encode($goalR); ?>;
      // pass the variable(array) from one js file to another
      sessionStorage.setItem("goalR", JSON.stringify(goalR)); 
      console.log(goalR);
      
      if (<?php echo json_encode(isset($mentorID)); ?>) {
        var getNameRes = <?php echo json_encode($getNameRes); ?>;
        // pass the variable(array) from one js file to another 
        sessionStorage.setItem("getNameRes", JSON.stringify(getNameRes)); 
      }
      console.log(goalR["mentor_id"]);
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script type="text/javascript">
      // function to update goal info into the table and database, '#editGoal' is the id of the form
      $(document).on('submit', '#editGoal', function(e) {
        e.preventDefault();
        //var tr = $(this).closest('tr');
        var mentor = $('#mentorField').val();
        var title = $('#titleField').val();
        var description = $('#descriptionField').val();
        var category = $('#categoryField').val();
        var tracking = $('#trackingField').val();
        var startDate = $('#startDateField').val();
        var endDate = $('#endDateField').val();
        var trid = $('#trid').val();
        var id = $('#id').val();
        if (title != '' && category != '' && tracking != '' && startDate != '' && endDate != '') {
          $.ajax({
            url: "goal-edit.php",
            type: "post",
            data: {
              mentor: mentor,
              title: title,
              description: description,
              category: category,
              tracking: tracking,
              startDate: startDate,
              endDate: endDate,
              id: id
            },
            success: function(data) {
              console.log("Submit Button is clicked");
              console.log(data);
              var json = JSON.parse(data);
              var status = json.status;
              if (status == 'true') {
                var detail = document.getElementById("detail");

                var mentorId = document.getElementsByClassName("goalMentor");
                mentorId[0].textContent = mentor;

                var goalTitle = detail.getElementsByClassName("goalTitle");
                goalTitle[0].textContent = title;

                var goalDescription = document.getElementsByClassName("goalDescription");
                goalDescription[0].textContent = description;

                var goalCategory = detail.querySelector(".goalCategory");
                goalCategory.textContent = category;

                var trackingMethod = document.getElementsByClassName("goalTracking");
                trackingMethod[0].textContent = tracking;

                var start = document.getElementById("startDate");
                start.textContent = startDate;

                var end = document.getElementById("endDate");
                end.textContent = endDate;

                $('#editModal').modal('hide');
                window.location.reload();
              } else {
                alert('failed');
              }
            }
          });
        } else {
          alert('Fill all the required fields');
        }
      });

      // function of edit button, show the modal form to key in the car info
      $('#detail').on('click', '.editBtn ', function(event) {
        // console.log(selectedRow);
        var id = $(this).data('id');
        $('#editModal').modal('show');   // show the modal (by default the modal is set as hidden)

        $.ajax({
          url: "goal-get-single-row-data.php",   // retrieve the data of that specific row using car_id
          data: {
            id: id
          },
          type: 'post',
          success: function(data) {
            console.log("Edit Button is clicked");
            console.log(data);
            var json = JSON.parse(data);        // parse PHP object to javascript object
            $('#mentorField').val(json.mentor_id);
            $('#titleField').val(json.goal_title);
            $('#descriptionField').val(json.goal_description);
            $('#categoryField').val(json.goal_category);
            $('#trackingField').val(json.tracking_method);
            $('#startDateField').val(json.goal_start_date);
            $('#endDateField').val(json.goal_due_date);
            $('#id').val(id);
            // $('#trid').val(trid);
          }
        })
      });

      // function of delete button, 
    $(document).on('click', '.deleteBtn', function(event) {
      event.preventDefault();
      $('#deleteModal').modal('show');
      var id = <?php echo json_encode($id); ?>;
      var confirmDlt = false;
      document.querySelector(".confirmDeleteBtn").addEventListener('click', 
        function(){
          // Use a varaible to track if the confirm delete button is clicked or not
          confirmDlt = true;
        
          if (confirmDlt) {
            $.ajax({
              url: "goal-delete.php",
              data: {
                id: id
              },
              type: "post",
              success: function(data) {
                var json = JSON.parse(data);
                status = json.status;
                if (status == 'success') {
                  // go back to goal page
                  window.location.href = "goal.php";
                } else {
                  alert('Failed');
                  return;
                }
              }
            });
          } else {
            return null;
          }

        });
    });

      
      // function to update goal progress (by outcome) into the table and database, '#updateOutcome' is the id of the form
      $(document).on('submit', '#updateOutcome', function(e) {
        e.preventDefault();
        console.log("Submit btn clicked");
        var target = $('#targetField').val();
        var outcome = $('#outcomeField').val();
        var id = <?php echo json_encode($id); ?>;
        var progress = (outcome/target) * 100;

        if (outcome != '') {
          $.ajax({
            url: "goal-update-progress.php",
            type: "post",
            data: {
              progress: progress,
              id: id
            },
            success: function(data) {
              console.log("Submit Button is clicked");
              console.log(data);
              var json = JSON.parse(data);
              var status = json.status;
              if (status == 'true') {
                $('#updateOutcomeModal').modal('hide');
                window.location.reload();
              } else {
                alert('failed');
              }
            }
          });
        } else {
          alert('Fill all the required fields');
        }

      });

      // function to sync goal progress with activity progress  
      $(document).on('click', '#syncActivity', function(event) {
      event.preventDefault();
        console.log("Sync Activity Progress btn clicked");
        var id = <?php echo json_encode($id); ?>;
        <?php
          $activityRow = array();
          $rowTableCount = array();
          $apIDSql = 
          "SELECT * FROM `action plan`
          INNER JOIN goal
          ON `action plan`.goal_id = goal.goal_id
          WHERE `action plan`.goal_id = $id";
          $apIDQuery = mysqli_query($conn, $apIDSql);
          $apIDRes = mysqli_fetch_assoc($apIDQuery);
          mysqli_free_result($apIDQuery);
          if (isset($apIDRes)) {
            $actionPlanID = $apIDRes['ap_id'];
            $getActivitySql = "SELECT * FROM activity WHERE ap_id = $actionPlanID";

            if($getActivityQuery = mysqli_query($conn, $getActivitySql)){
              $rowTableCount = mysqli_num_rows($getActivityQuery);
              $activityRow = array();
              for ($i=0; $i < $rowTableCount ; $i++) { 
                $activityRow[$i] = mysqli_fetch_assoc($getActivityQuery);
              } 
              mysqli_free_result($getActivityQuery);
            }
          }
 
        ?>
        console.log(<?php echo json_encode(isset($rowTableCount)); ?>);
        console.log(<?php echo json_encode(isset($activityRow)); ?>);
        if(<?php echo json_encode(isset($rowTableCount)); ?> && <?php echo json_encode(isset($activityRow)); ?>){
          const noOfRow = <?php echo json_encode($rowTableCount); ?>;
          var activityRow = <?php echo json_encode($activityRow); ?>;
          console.log(noOfRow);
          console.log(activityRow);
          
          var activityProgress = 0.0;
          for (let i = 0; i < noOfRow; i++) {
            activityProgress += parseFloat(activityRow[i]['a_complete']);
          }
          console.log(activityProgress);
          var progress = activityProgress/noOfRow;
          console.log(progress);

          if (progress != '') {
            $.ajax({
              url: "goal-update-progress.php",
              type: "post",
              data: {
                progress: progress,
                id: id
              },
              success: function(data) {
                console.log("Submit Button is clicked");
                console.log(data);
                var json = JSON.parse(data);
                var status = json.status;
                if (status == 'true') {
                  window.location.reload();
                } else {
                  alert('failed');
                }
              }
            });
          } else {
            alert('No Progress In Activity Yet. Go Complete the Activities');
          }

        }

      });

      
    // function of view activity button, 
    $(document).on('click', '#viewActivity', function(event) {
      event.preventDefault();
      console.log("View activity button is clicked");
      var id = <?php echo json_encode($id); ?>;
      if(<?php echo json_encode(isset($apIDRes)); ?>){
        var apIDRes = <?php echo json_encode($apIDRes); ?>;
        var urlActivity = "activity.php?ap_name=" + apIDRes["ap_title"] + "&ap_id=" + apIDRes["ap_id"];
        console.log(urlActivity);
        var linkActivity = document.querySelector("#viewActivity");
        location.href = urlActivity;
        console.log(location.href);
      }
      else{
        alert("No Activity Found. Please add activity to the respective action plans");
      }
       
      });

      // function of Update Goal Progress button, show the modal form
      $('#detail').on('click', '.updateProgressBtn ', function(event) {
        // console.log(selectedRow);
        var id = $(this).data('id');
        
        $.ajax({
          url: "goal-get-single-row-data.php",   // retrieve the data of that specific row using car_id
          data: {
            id: id
          },
          type: 'post',
          success: function(data) {
            // console.log(data);
            // console.log("Update Progress Button is clicked");
            var json = JSON.parse(data);        // parse PHP object to javascript object
            var finalOutcome = "Final outcome";
            var compltAct = "Total number of completed activities";
            // To perform insensitive string comparison (ignore string case)
            if (json.tracking_method.toUpperCase() == finalOutcome.toUpperCase()) {
              $('#updateOutcomeModal').modal('show');
              $('#targetField').val(json.goal_target);
              console.log("What is target"); 
            }
            else if(json.tracking_method.toUpperCase() == compltAct.toUpperCase()){
              $('#completedActModal').modal('show'); 
            }
            $('#id').val(id);
          }
        })
      });


    </script>
    <!-- Edit Goal Modal  -->
    <!--  
      modal is a Bootstrap plugin
      modal fade      - effect of fade when the modal is opened and closed
      tabindex        - specifies the tab order of an element (when the "tab" button is used for navigating) [-1 means initially no element is selected until user press tab or click with mouse]
      aria-labelledby - to reference another element to define its accessible name
      aria-hidden     - to hide the modal by default
      modal-dialog    - sets the proper width and margin of the modal
    -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Update/Edit Goal Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editGoal">
              <input type="hidden" name="id" id="id" value="">
              <input type="hidden" name="trid" id="trid" value="">
              <div class="mb-3 row">
                <label for="mentorField" class="col-md-3 form-label">Mentor</label>
                <div class="col-md-9">
                  <input type="number" class="form-control" id="mentorField" name="mentor">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="titleField" class="col-md-3 form-label">Goal Title</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="titleField" name="title">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="descriptionField" class="col-md-3 form-label">Goal Description</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="descriptionField" name="description">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="categoryField" class="col-md-3 form-label">Goal Category</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="categoryField" name="category">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="trackingField" class="col-md-3 form-label">Tracking Method</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="trackingField" name="tracking">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="startDateField" class="col-md-3 form-label">Start Date</label>
                <div class="col-md-9">
                  <input type="date" class="form-control" id="startDateField" name="startDate">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="endDateField" class="col-md-3 form-label">End Date</label>
                <div class="col-md-9">
                  <input type="date" class="form-control" id="endDateField" name="endDate">
                </div>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Goal Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete Goal Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure that you want to delete this goal?</p>
            <div class="text-end">
                <button type="button" class="btn btn-danger confirmDeleteBtn">Delete</button>
                <button type="button" class="btn btn-primary cancelBtn" data-bs-dismiss="modal">Cancel</button>
              </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Update Goal Progress Modal (Final Outcome) -->
    <div class="modal fade" id="updateOutcomeModal" tabindex="-1" aria-labelledby="updateOutcomeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateOutcomeModalLabel">Update Goal Progress</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="updateOutcome">
              <input type="hidden" name="id" id="id" value="">
              <div class="mb-3 row">
                <label for="targetField" class="col-md-3 form-label">Target</label>
                <div class="col-md-9">
                  <input type="text" readonly class="form-control-plaintext" id="targetField" name="target">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="outcomeField" class="col-md-3 form-label">Update Outcome</label>
                <div class="col-md-9">
                  <input type="number" class="form-control" id="outcomeField" name="outcome" step=".01">
                </div>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>  
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Update Goal Progress Modal (Total number of completed activities) -->
    <div class="modal fade" id="completedActModal" tabindex="-1" aria-labelledby="completedActModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="completedActModalLabel">Update Goal Progress</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="">
            <p> 
              This goal will be tracked by the activity progress.
              <br>
              Go complete the activities scheduled and update the activities as completed to update your goal progress.
            </p>
            <div class="text-end">
              <button type="button" id="syncActivity" class="btn btn-warning">Sync Activity Progress</button>
              <a id="viewActivity" href="" class="btn btn-primary">View Activity</a>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/authListener.js"></script>
    
    <script src="./js/goal-details.js"></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>
