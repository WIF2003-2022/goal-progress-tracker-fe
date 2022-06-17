<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php echo (($_GET['role']=="Mentor" ) ? "Mentee: Your Mentee's Goal" :"Mentor: My Goal"); ?>
  </title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/index.css" />
  <link rel="stylesheet" href="./styles/goal.css" />
</head>

<body>
  <div class="wrapper">
    <nav-bar></nav-bar>
    <div class="content-wrapper">
      <div class="container-float">
        <div class="row m-2">
          <?php
          //back button
          echo '
          <form action="./social.php" method="GET">
          <button type="submit" class="col-2 ms-3 mb-3 btn btn-warning shadow-sm rounded-3 text-start">
              <span class="text-secondary">
                <<< </span> Back to Social
          </button>
          </form>'
          ?>
        </div>
        <div class="row m-2">
          <?php
            session_start();
            
            $otherID = $_GET['userID'];
            $role = $_GET['role'];
            $userID = json_decode($_SESSION['auth'],true)['user_id'];
            if($role == "Mentor"){
              generateGoalList($role,$otherID,$userID);
            }else{
              generateGoalList($role,$userID,$otherID);
            }
                      
            function generateGoalList($role, $menteeID, $mentorID){
              require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");   

              $roleArr = ['mentor_id','mentee_id'];
              if($role == "Mentor"){
                $field = $roleArr[0]; 
                $field1 = $roleArr[1];
              }else{
                $field = $roleArr[1];
                $field1 = $roleArr[0];
              }
              $stmt = $conn->prepare(
                "SELECT * from goal WHERE mentee_id = ? AND mentor_id = ?"
              );
              $stmt->bind_param("ii", $menteeID, $mentorID);
              $stmt->execute();
              $result = $stmt->get_result();
              while ($row = $result->fetch_assoc()) {
                // echo 'Goal: '.$row['goal_id'].'</br>';
                echo '<div class="col-md-4">
                          <div class="goal1">
                            <a href="social-actionplan.php?userID='.$_GET['userID'].'&goalID='.$row['goal_id'].'&role='.$role.'" class="remove-hyperlink">
                              <div class="card">
                                <span class="material-icons-sharp">outlined_flag</span>
                                <div class="middle">
                                  <div class="left">
                                    <h3>'.$row['goal_title'].'</h3>
                                  </div>
                                  <div class="percentage">
                                    <svg>
                                      <circle cx="38" cy="38" r="36"></circle>
                                    </svg>
                                    <div class="number">
                                      <p>'.$row['goal_progress'].'%</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="deadline">
                                  <span class="material-icons-sharp">event</span>
                                  <div class="text-muted">'.$row['goal_due_date'].'</div>
                                </div>
                              </div>
                            </a>
                          </div>
                          <!--End of Goal No.1-->
                        </div>';
              }             
            }
        ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="./js/authListener.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="./js/navbar.js"></script>
</body>

</html>