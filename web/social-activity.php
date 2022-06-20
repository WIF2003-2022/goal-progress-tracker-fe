<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="./styles/index.css" />
  <link rel="stylesheet" href="./styles/social-activity.css" />
  <title>
    <?php echo (($_GET['role']=="Mentor" ) ? "Mentee: Your Mentee's Activity" :"Mentor: My Activity"); ?>
  </title>
  <link rel="stylesheet" href="./styles/scroll-top.css" />
</head>

<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
  <div class="wrapper">
    <nav-bar></nav-bar>
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <?php
          
          require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");          
          require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
          
          //back button
           
          // $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

          // if($pageWasRefreshed ) {
          //   echo "refreshed";
          // } else {
          //   echo "no refresh";
          // }
        
          $stmt = $conn->prepare(
            "SELECT goal_id from `action plan` WHERE ap_id = ?"
          );
          $stmt->bind_param("i", $_GET['actionplanID']);
          $stmt->execute();
          $row = $stmt->get_result()->fetch_assoc();

          echo '
          <form action="./social-actionplan.php" method="GET">
          <button type="submit" class="col-2 ms-3 mb-3 btn theme-yellow shadow-sm rounded-3">
              <span class="text-secondary">
                <<< </span> Back to Action Plan
          </button>
          <input type="hidden" name="userID" value="'.$_GET['userID'].'"/>
          <input type="hidden" name="goalID" value="'.$row['goal_id'].'"/>
          <input type="hidden" name="role" value="'.$_GET['role'].'"/>
          <input type="hidden" name="orderD" value="ASC"/>
          <input type="hidden" name="valueD" value="Earliest_Due"/>
          </form>'
          ?>
          <?php
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");

            //display action plan title
            $stmt = $conn->prepare(
              "SELECT ap_title from `action plan` WHERE ap_id = ?"
            );
            $stmt->bind_param("i", $_GET['actionplanID']);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            echo '<h2>"'.$row['ap_title'].'" - Action Plan</h2>'
          ?>
        </div>

        <ul>
          <?php
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
            
            $userID = json_decode($_SESSION['auth'],true)['user_id'];

            if (isset($_POST['aID']) && isset($_POST['activity'.$_POST['aID']])){
              date_default_timezone_set('Asia/Kuala_Lumpur');
              $date = strval(date('y-m-d h:i:s'));

              // update database
              $aID = $_POST['aID'];
              $cText = $_POST['activity'.$aID];
              $cID = $userID;
              $time = $date;
              $stmt3 = $conn->prepare(
                "INSERT INTO comment (a_id, comment_text, commentor_id, timestamp)VALUES (?,?,?,?)"
              );
              $stmt3->bind_param("isis", $aID, $cText, $cID, $time);
              $stmt3->execute();

              $stmt4 = "INSERT INTO `recent` (`r_type`, `user_id`, `updated_id`) VALUES ('comment','$userID','$aID')";
              mysqli_query($conn,$stmt4);
              header('Location: '.$_SERVER['REQUEST_URI']);
              die();
            }     
            // unset($_POST['aID']);
            // echo var_dump($_POST);  

            $haveAct = false;
            $stmt = $conn->prepare(
              "SELECT * from activity WHERE ap_id = ?"
            );
            $stmt->bind_param("i", $_GET['actionplanID']);
            $stmt->execute();
            $result = $stmt->get_result();
            // echo json_encode($result);
            
            while ($row = $result->fetch_assoc()) {
              // echo 'ap_id: '.$row['ap_id'].'</br>';
              // echo 'a_id: '.$row['a_id'].'</br>';

              //change date format
              $startDate = date("d-m-Y", strtotime($row['a_start_date']));
              $dueDate = date("d-m-Y", strtotime($row['a_due_date']));

              //find due progress
              date_default_timezone_set('Asia/Kuala_Lumpur');
              $currentDate = date_create(strval(date('y-m-d H:i:s'))); 
              $sDate = date_create($row['a_start_date']); 
              $dDate = date_create($row['a_due_date']); 

              $difference1 = date_diff($sDate, $dDate); 
              $difference2 = date_diff($sDate, $currentDate); 

              $totalDay = $difference1->d;
              $passedDay = $difference2->d;

              $duePercentage = $passedDay * 100 / $totalDay;
              
              //prevent percentage over 100
              if($duePercentage > 100){
                $duePercentage = 100;
              }

              //display activity content
              $haveAct = true;
              $html = '';
              $html .= '<!-- activity -->
              <li class="card text-center">
              <div class="card-header text-start">Start Date: '.$startDate.'<span class="float-end text-danger">Due Date: '.$dueDate.'</span></div>
              <div class="card-body">
                <h5 class="card-title">'.$row['a_title'].'</h5>
                <p class="card-text">'.$row['a_description'].'</p>
                <p class="card-text">'.$row['a_times'].' time(s) per '.$row['a_days'].' day(s)</p>
                <div class="mb-3">';
              for ($i = 0; $i < $row['a_priority']; $i++) {
                $html .= '<i class="bi-star-fill" style="color: red; font-size: 1.2rem"></i>';
              }
                  
              $html .= '
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-6">
                    <div class="text-start">Due</div>
                  </div>
                  <div class="col-6">
                    <div class="text-start">Complete</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="progress">
                      <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="'.$duePercentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$duePercentage.'%">
                        '.$duePercentage.'%
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="progress">
                      <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                        75%
                      </div>
                    </div>
                  </div>
                </div>
              </div>';

              //comment title
              $html .= '
              <div class="row p-3 text-start">
                <div class="col parent-comment">
                  <div class="p-3">
                    <h2>Comments</h2>
                  </div>';

              $stmt1 = $conn->prepare(
                "SELECT * from comment WHERE a_id = ? ORDER BY timestamp"
              );
              $stmt1->bind_param("i", $row['a_id']);
              $stmt1->execute();
              $result1 = $stmt1->get_result();
              while ($row1 = $result1->fetch_assoc()) {
                // echo 'c_id:'.$row1['comment_id'].'</br>';              
                $stmt2 = $conn->prepare(
                  "SELECT name from user WHERE user_id = ?"
                );
                $stmt2->bind_param("i", $row1['commentor_id']);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $row2 = $result2->fetch_assoc();
                ($_GET['role'] == 'Mentor') ? $other = 'Mentee' : $other = 'Mentor';
                ($userID == $row1['commentor_id']) ? $roleLabel = "You" : $roleLabel = $other;
                // echo $row2['name'].'</br>';

                //display comment period
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $currentDate = date_create(strval(date('y-m-d h:i:s'))); 
                $commentDate = date_create($row1['timestamp']);
                $difference = date_diff($currentDate, $commentDate); 
                $year = strval($difference->y);
                $month = strval($difference->m);
                $day = strval($difference->d);
                $hour = strval($difference->h);
                $minute = strval($difference->i);
                $second = strval($difference->s);
                if ($year > 0) {
                  $unit = ($year == 1) ?  " year ago" : " years ago";
                  $period = $year.$unit;
                }else if($month > 0){
                  $unit = ($month == 1) ?  " month ago" : " months ago";
                  $period = $month.$unit;
                }else if($day > 0){
                  $unit = ($day == 1) ?  " day ago" : " days ago";
                  $period = $day.$unit;
                }else if($hour > 0){
                  $unit = ($hour == 1) ?  " hour ago" : " hours ago";
                  $period = $hour.$unit;
                }else if($minute > 0){
                  $unit = ($minute == 1) ?  " minute ago" : " minutes ago";
                  $period = $minute.$unit;
                }else{
                  $period = "Just Now";
                }
                //display comment
                $html .= '
                  <div class="mt-2">
                    <div class="d-flex flex-row p-3">
                      <img src="././images/sampleProfilePic.jpg" width="40" height="40" class="rounded-circle mr-3" />
                      <div class="w-100">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="d-flex flex-row align-items-center">
                            <!-- name -->
                            <span class="mr-2">'.$row2['name'].'</span>
                            <!-- role -->
                            <small class="'.(($roleLabel == "You")? 'y':'o').'-badge"><span class="px-3">'.$roleLabel.'</span></small>
                          </div>
                          <!-- time -->
                          <small class="text-secondary">'.$period.'</small>
                        </div>
                        <p class="text-justify comment-text mb-0 fs-6">'.$row1["comment_text"].'</p>
                        <div class="d-flex flex-row user-feed">
                          <!-- <span class="wish"><i class="bi bi-pin mr-2"></i></span> -->
                        </div>
                      </div>
                    </div>
                  </div>';
              }
                $html .= '<!-- comment box -->
                        <form action="social-activity.php?userID='.$_GET['userID'].'&actionplanID='.$_GET['actionplanID'].'&role='.$_GET['role'].'" method="POST" >
                          <div class="mt-3 d-flex flex-row align-items-center p-3 form-color before-comment">
                            <img src="././images/sampleProfilePic.jpg" width="50" height="50" class="rounded-circle mr-2" />
                            <input type="text" class="form-control comment-typed" placeholder="Leave your comment..." name="activity'.strval($row['a_id']).'"/>
                            <input type="hidden" name="aID" value="'.$row['a_id'].'"/>
                          </div>

                        <!-- button -->
                        <div class="text-end mt-3">
                          <button type="submit" class="btn btn-success">
                            Post Comment
                          </button>
                        </div>
                        </form>
                      </div>
                      <!-- end comment -->
                    </li>
                    <!-- end activity -->
                    <br />';
                echo ($haveAct) ? $html : null;
            }                  
          ?>
        </ul>
      </div>
    </div>
  </div>
  <script src="./js/authListener.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="./js/scrollTop.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  <script src="./js/navbar.js"></script>
</body>

</html>