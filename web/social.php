<?php
  session_start();
  require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/index.css" />
  <link rel="stylesheet" href="./styles/social.css" />
  <title>Social</title>
</head>

<body>
  <div>
    <nav-bar></nav-bar>
    <div class="content-wrapper">
      <div id="recent-activity">
        <!-- tab title -->
        <div class="row position-fixed shadow rounded right-tab-header">
          <div class="col-9 mt-3 text-secondary">
            <h5>Recent Activities</h5>
          </div>
          <div class="col-3 align-self-center">
            <i class="bi-chevron-right" id="right-tab-arrow"></i>
          </div>
        </div>
        <!-- right tab -->
        <div class="col position-fixed shadow rounded right-tab-open">
          <!-- tab content -->
          <div class="row mb-2 pe-1 py-2 activity">
            <div class="col-3">
              <img src="././images/sampleProfilePic.jpg" alt="profile_pic" class="img-fluid img-thumbnail"
                id="i-size" />
            </div>
            <div class="col-9 text">
              <div class="row text-secondary right-duration">4 hours ago</div>
              <div class="row right-description">
                username has achieved the goal: Lose weight in 2 months.
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content -->
      <div class="container" id="content">
        <div class="col-8 ms-5" id="content">
          <!-- switch tab -->
          <div class="row my-2 justify-content-center">
            <form class="btn-group w-50" method="POST">
              <button type="submit"
                class="btn btn-outline-dark <?php echo (!isset($_POST['btnradio2'])) ? 'active': ''; ?>"
                name="btnradio1" id="btnradio1">
                Your Mentee
              </button>

              <button type="submit"
                class="btn btn-outline-dark <?php echo (isset($_POST['btnradio2'])) ?  'active': ''; ?>"
                name="btnradio2" id="btnradio2">
                Your Mentor
              </button>
            </form>
          </div>

          <!-- main content -->
          <div class="row row-cols-1 row-cols-xl-3 g-4 mt-3 mx-5 pb-4 card-container">
            <!-- single card -->
            <?php
            $htmlLine = '';
            $trigger = false;
            $preID = 0;
            $goalCount = 0;
            $userID = json_decode($_SESSION['auth'],true)['user_id']; 
            if (!isset($_POST['btnradio2'])) {
              $role = "Mentor";            
              $stmt = $conn->prepare(
                "SELECT goal_id from goal WHERE mentor_id = ?"
              );
              $stmt->bind_param("i", $userID);
              $stmt->execute();
              $result = $stmt->get_result();
              while ($row = $result->fetch_assoc()) {
                if($row['goal_id'] == $preID){
                  $trigger = true;
                  $goalCount += 1;
                  $preID = $row['goal_id'];
                  $htmlLine += '<p class="card-text text-secondary">Learn Korean language in 6 months</p>';
                }            
                else{
                  if($trigger || $goalCount == 0){
                    $htmlLine += '<p class="card-text text-secondary">Lose 10kg in a year</p>
                                    </div>
                                    <div class="card-footer">
                                      <small class="text-muted">Total goals: 2</small>
                                    </div>
                                  </div>
                                </a>
                              </div>';
                  }
                  else{
                    echo `<div class="col">
                        <a href="./social-goal.html" class="text-decoration-none">
                          <div class="card h-100" id="singleCard">
                            <img
                              src="././images/sampleProfilePic.jpg"
                              class="card-img-top"
                              alt="profile_pic"
                            />
                            <div class="card-body">
                              <h5 class="card-title text-uppercase text-dark">Joshua</h5>   
                              <p class="card-text text-secondary">
                                Learn Korean language in 6 months
                              </p>`;
                  }
                }
                echo json_encode($row);
                
                
              }              
              
            } else {
              $role = "Mentee";
              echo '<div class="col">
                        <a href="./social-goal.html" class="text-decoration-none">
                            <div class="card h-100" id="singleCard">
                                <img src="././images/sampleProfilePic.jpg" class="card-img-top" alt="profile_pic">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase text-dark">Mentor name 1
                                    </h5>
                                    <p class="card-text text-secondary">List of goals</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Total goals: </small>
                                </div>
                            </div>
                        </a>
                    </div>';
            }

            function generateList($role){
              if($role == "Mentor"){

              }else{

              }
            }
            ?>
          </div>
        </div>
      </div>
      <script src="./js/authListener.js"></script>
      <script src="./js/socialTest.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
      </script>
      <script src="./js/navbar.js"></script>
      <script>
      const arrow = document.querySelector("#right-tab-arrow");
      const tab = document.querySelector(".right-tab-open");
      const content = document.querySelector(".text");
      arrow.addEventListener("click", () => {
        tab.classList.toggle("right-tab-close");
        content.classList.toggle("visually-hidden");
        if (arrow.classList.contains("bi-chevron-right")) {
          arrow.classList.replace("bi-chevron-right", "bi-chevron-left");
        } else {
          arrow.classList.replace("bi-chevron-left", "bi-chevron-right");
        }
      });
      </script>
    </div>
</body>

</html>