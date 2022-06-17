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
            <form class="btn-group w-50" method="GET">
              <button type="submit"
                class="btn btn-outline-dark <?php echo (!isset($_GET['mentors'])) ? 'active': ''; ?>" name="mentees">
                Your Mentee
              </button>

              <button type="submit"
                class="btn btn-outline-dark <?php echo (isset($_GET['mentors'])) ?  'active': ''; ?>" name="mentors">
                Your Mentor
              </button>
            </form>
          </div>

          <!-- main content -->
          <div class="row row-cols-1 row-cols-xl-3 g-4 mt-3 mx-5 pb-4 card-container">
            <!-- single card -->
            <?php
              session_start();

              $htmlLine = '';
              $count = 0;
              $preID = 0;
              $goalCount = 1;
              $trigger = false;
              $userID = json_decode($_SESSION['auth'],true)['user_id']; 
              if (!isset($_GET['mentors'])) {
                $role = "Mentor"; 
                generateSocialList($role);           
                // $stmt = $conn->prepare(
                //   "SELECT * from goal WHERE mentor_id = ?"
                // );
                // $stmt->bind_param("i", $userID);
                // $stmt->execute();
                // $result = $stmt->get_result();
                // while ($row = $result->fetch_assoc()) {
                //   $count += 1;
                //   $open = false;
                //   $goalID = $row['goal_id'];
                //   // echo json_encode($row['mentee_id'])."</br>";
                //   if($row['mentee_id'] == $preID){
                //     // echo $count."a"."</br>";
                //     $trigger = true;
                //     $goalCount += 1;
                //     $preID = $row['goal_id'];
                //     $htmlLine .= '<p class="card-text text-secondary">'.$row['goal_description'].'</p>';
                //     continue;
                //   }   
                //   if(($goalCount > 1 && $row['goal_id'] != $preID) || ($count != 1 && !$trigger)){
                //     // echo $count."b"."</br>";
                //     // echo "Goal count: ".$goalCount."</br>";
                //     $open = true;                  
                //     $htmlLine .= 
                //     '</div><div class="card-footer"><small class="text-muted">Total goals: '.$goalCount.'</small></div></div></a></div>';
                //     $goalCount = 1;
                //   }                        
                //   if($count == 1 || $open){  
                //     // echo $count."c"."</br>";
                //     $stmt1 = $conn->prepare(
                //       "SELECT name from user WHERE user_id = ?"
                //     );
                //     $stmt1->bind_param("i", $row['mentee_id']);
                //     $stmt1->execute();
                //     $result1 = $stmt1->get_result(); 
                //     $row1 = $result1->fetch_assoc();               
                //     $htmlLine .= 
                //     '<div class="col"><a href="./social-goal.html?goalID='.$goalID.'" class="text-decoration-none"><div class="card h-100" id="singleCard"><img src="././images/sampleProfilePic.jpg" class="card-img-top" alt="profile_pic" /><div class="card-body"><h5 class="card-title text-uppercase text-dark">'.$row1['name'].'</h5><p class="card-text text-secondary">'.$row['goal_description'].'</p>';                 
                //   }
                //   $trigger = false;  
                //   $preID = $row['mentee_id'];
                //   // echo $preID."Count: ".$count."</br>"; 
                // }
                // $htmlLine .= '</div><div class="card-footer"><small class="text-muted">Total goal: 1</small></div></div></a></div>';         
                // echo $htmlLine; 
                
              } else {
                $role = "Mentee";
                generateSocialList($role);
                // $stmt = $conn->prepare(
                //   "SELECT * from goal WHERE mentee_id = ?"
                // );
                // $stmt->bind_param("i", $userID);
                // $stmt->execute();
                // $result = $stmt->get_result();
                // while ($row = $result->fetch_assoc()) {
                //   $count += 1;
                //   $open = false;
                //   $goalID = $row['goal_id'];
                //   // echo json_encode($row['mentee_id'])."</br>";
                //   if($row['mentor_id'] == $preID){
                //     // echo $count."a"."</br>";
                //     $trigger = true;
                //     $goalCount += 1;
                //     $preID = $row['goal_id'];
                //     $htmlLine .= '<p class="card-text text-secondary">'.$row['goal_description'].'</p>';
                //     continue;
                //   }   
                //   if(($goalCount > 1 && $row['goal_id'] != $preID) || ($count != 1 && !$trigger)){
                //     // echo $count."b"."</br>";
                //     // echo "Goal count: ".$goalCount."</br>";
                //     $open = true;                  
                //     $htmlLine .= 
                //     '</div><div class="card-footer"><small class="text-muted">Total goals: '.$goalCount.'</small></div></div></a></div>';
                //     $goalCount = 1;
                //   }                        
                //   if($count == 1 || $open){  
                //     // echo $count."c"."</br>";
                //     $stmt1 = $conn->prepare(
                //       "SELECT name from user WHERE user_id = ?"
                //     );
                //     $stmt1->bind_param("i", $row['mentor_id']);
                //     $stmt1->execute();
                //     $result1 = $stmt1->get_result(); 
                //     $row1 = $result1->fetch_assoc();               
                //     $htmlLine .= 
                //     '<div class="col"><a href="./social-goal.html?goalID='.$goalID.'" class="text-decoration-none"><div class="card h-100" id="singleCard"><img src="././images/sampleProfilePic.jpg" class="card-img-top" alt="profile_pic" /><div class="card-body"><h5 class="card-title text-uppercase text-dark">'.$row1['name'].'</h5><p class="card-text text-secondary">'.$row['goal_description'].'</p>';                 
                //   }
                //   $trigger = false;  
                //   $preID = $row['mentor_id'];
                //   // echo $preID."Count: ".$count."</br>"; 
                // }
                // $htmlLine .= '</div><div class="card-footer"><small class="text-muted">Total goal: 1</small></div></div></a></div>';         
                // echo $htmlLine; 
              }

              function generateSocialList($role){
                require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
                $htmlLine = '';
                $count = 0;
                $preID = 0;
                $looped = false;
                $goalCount = 1;
                $trigger = false;
                $userID = json_decode($_SESSION['auth'],true)['user_id'];
                $goalArr = array();
                $roleArr = ['mentor_id','mentee_id'];
                if($role == "Mentor"){
                  $field = $roleArr[0]; 
                  $field1 = $roleArr[1];
                }else{
                  $field = $roleArr[1];
                  $field1 = $roleArr[0];}
                $sql = 'SELECT * from goal WHERE '.$field.' = '.$userID; // only this line use field(own role)
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                  $looped = true;
                  $count += 1;
                  $open = false;
                  $goalID = $row['goal_id'];

                  if($row[$field1] == $preID){
                    $trigger = true;
                    $goalCount += 1;
                    $preID = $row['goal_id'];
                    array_push($goalArr,$row['goal_id']);
                    $htmlLine .= '<p class="card-text text-secondary fst-italic">'.$row['goal_title'].'</p>';
                    continue;
                  }   
                  if(($goalCount > 1 && $row['goal_id'] != $preID) || ($count != 1 && !$trigger)){
                    $open = true;   
                    $goalArr = array();               
                    $htmlLine .= 
                    '</div><div class="card-footer"><small class="text-muted">Total goals: '.$goalCount.'</small></div></div></a></div>';
                    $goalCount = 1;
                  }                        
                  if($count == 1 || $open){  
                    $stmt1 = $conn->prepare(
                      "SELECT name from user WHERE user_id = ?"
                    );
                    $stmt1->bind_param("i", $row[$field1]);
                    $stmt1->execute();
                    $result1 = $stmt1->get_result(); 
                    $row1 = $result1->fetch_assoc();  
                    array_push($goalArr,$row['goal_id']); 
                    $_SESSION['mentor_id'] = $row['mentor_id'];
                    $_SESSION['mentee_id'] = $row['mentee_id'];
                    $htmlLine .= 
                    '<div class="col"><a href="./social-goal.php?userID='.$row[$field1].'&role='.$role.'" class="text-decoration-none">
                    <div class="card h-100" id="singleCard">
                    <img src="././images/sampleProfilePic.jpg" class="card-img-top" alt="profile_pic" />
                    <div class="card-body"><h5 class="card-title text-uppercase text-dark">'.$row1['name'].'
                    </h5><p class="card-text text-secondary fst-italic">'.$row['goal_title'].'</p>';                 
                  }
                  $trigger = false;  
                  $preID = $row[$field1];
                }
                ($looped) ? $htmlLine .= '</div><div class="card-footer"><small class="text-muted">Total goal: 1</small></div></div></a></div>': null;         
                echo $htmlLine;
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