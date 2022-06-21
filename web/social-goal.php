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
      <div class="container">
        <div class="row">
          <?php
          require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
          
          echo '
          <!-- back button -->
          <div class="col-6">
            <form action="./social.php" method="GET">
              <button type="submit" class="ms-3 mb-3 btn theme-yellow shadow-sm rounded-3">
                <span class="text-secondary">
                  <<< </span> Back to Social
              </button>
            </form>
          </div>
          <div class="col-6 pe-4">
            <form class="float-end">
              <span class="fs-5">Sort by:</span>
              <input type="button" class="ms-3 mb-3 btn no-pressed shadow-sm rounded-3 sort-progress" value="'.str_replace('_', ' ', $_GET['valueP']).'">
              </input>
              <input type="button" class="ms-3 mb-3 btn no-pressed shadow-sm rounded-3 sort-date" value="'.str_replace('_', ' ', $_GET['valueD']).'">
              </input>
              <input type="hidden" class="progressSort" name="progress" value='.$_GET['orderP'].'>
              <input type="hidden" class="dateSort" name="date" value='.$_GET['orderD'].'>
              <input type="hidden" class="userID" name="userID" value='.$_GET['userID'].'>
              <input type="hidden" class="role" name="role" value='.$_GET['role'].'>
            </form>
          </div>';
          ?>

        </div>
        <div class="row m-2">
          <?php
            $otherID = $_GET['userID'];
            $role = $_GET['role'];
            $userID = json_decode($_SESSION['auth'],true)['user_id'];
            if($role == "Mentor"){
              generateGoalList($role,$otherID,$userID);
            }else{
              generateGoalList($role,$userID,$otherID);
            }
            
            //function to generate goal list related to user 
            function generateGoalList($role, $menteeID, $mentorID){
              require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");   

              if($_GET['sort'] == "date"){
                $sortMethod = "goal_due_date";
                $order = $_GET['orderD'];
              } 
              else{
                $sortMethod = "goal_progress";
                $order = $_GET['orderP'];
              }
              
              $sql = "SELECT * from goal WHERE mentee_id = ? AND mentor_id = ? ORDER BY ".$sortMethod." ".$order;
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ii", $menteeID, $mentorID);
              $stmt->execute();
              $result = $stmt->get_result();
              while ($row = $result->fetch_assoc()) {
                // echo 'Goal: '.$row['goal_id'].'</br>';
                $dueDate = date("d-m-Y", strtotime($row['goal_due_date']));
                echo '<div class="col-md-4">
                          <div class="goal1">
                            <a href="social-actionplan.php?userID='.$_GET['userID'].'&goalID='.$row['goal_id'].'&role='.$role.'&orderD=ASC&valueD=Earliest_Due" class="remove-hyperlink">
                              <div class="card">
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
                                  <div class="text-muted">'.$dueDate.'</div>
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
  <script src="./js/socialGoal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="./js/navbar.js"></script>
</body>

</html>