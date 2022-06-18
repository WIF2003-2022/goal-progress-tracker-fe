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
          <?php
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");

            session_start();

            $count = 0;
            $userID = json_decode($_SESSION['auth'],true)['user_id'];   

            //select top 10 recent activities
            $stmt = $conn->prepare(
            'SELECT *
            FROM recent
            WHERE user_id IN (
                SELECT DISTINCT mentee_id AS user_id
                FROM goal
                WHERE mentor_id = ?
                UNION
                SELECT DISTINCT mentor_id AS user_id
                FROM goal
                WHERE mentee_id = ?
                ORDER BY user_id)
            ORDER BY timestamp DESC
            LIMIT 10'
                );
            $stmt->bind_param("ii",$userID,$userID);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($recent = $result->fetch_assoc()){
              $count++; 
              if ($recent['r_type'] == "comment") {
                $field = 'Comment';
                $select = 'activity.a_id, activity.a_title';
                $where = 'activity.a_id'; 
                $title = 'a_title';
              }else if($recent['r_type'] == "activity"){
                $field = 'Activity';
                $select = '`action plan`.ap_id, `action plan`.ap_title';
                $where = '`action plan`.ap_id'; 
                $title = 'ap_title';
              }else if($recent['r_type'] == "action_plan"){
                $field = 'Action Plan';
                $select = 'goal.goal_id, goal.goal_title';
                $where = 'goal.goal_id'; 
                $title = 'goal_title';
              }else if($recent['r_type'] == "goal"){
                $field = 'Goal';
                $select = 'goal.goal_id, goal.goal_title';
                $where = 'goal.goal_id'; 
                $title = 'goal_title';
              }
              
              //join all tables coantaining goals related to user
              $stmt1 = $conn->prepare(
              'SELECT DISTINCT '.$select.'
              FROM goal 
              LEFT OUTER JOIN `action plan` ON goal.goal_id = `action plan`.goal_id
              LEFT OUTER JOIN activity ON `action plan`.ap_id = `activity`.ap_id
              LEFT OUTER JOIN comment ON activity.a_id = comment.a_id
              WHERE goal.goal_id IN(
                  SELECT goal_id
                  FROM goal
                  WHERE mentor_id = ? OR mentee_id = ?) AND '.$where.'='.$recent['updated_id']
              );
              $stmt1->bind_param("ii",$userID,$userID);
              $stmt1->execute();
              $result1 = $stmt1->get_result();
              $updateField = $result1->fetch_assoc();

              //join all tables coantaining goals related to user
              $stmt2 = $conn->prepare(
                'SELECT name, photo FROM user WHERE user_id = ?');
              $stmt2->bind_param("i",$recent['user_id']);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
              $otherData = $result2->fetch_assoc();

              $rUser = $otherData['name'];
              $rTime = $recent['timestamp'];
              $rTitle = $updateField[$title];

              //determine what action to display in recent
              if ($recent['r_type'] == "comment") {
                $rContent = 'commented on<span class="theme-color">'.$field.'</span><span class="fst-italic">'.$rTitle.'</span>';
              }else if($recent['r_type'] == "activity" || $recent['r_type'] == "action_plan" || $recent['action'] == "add" || $recent['r_type'] == "goal"){
                if($recent['action'] == "add"){
                  $rContent = 'added new<span class="theme-color">'.$field.'</span><span class="fst-italic">'.$rTitle.'</span>';
                }else{
                  $rContent = 'edited<span class="theme-color">'.$field.'</span><span class="fst-italic">'.$rTitle.'</span>';
                }
              }
              
              //display recent activities period
              date_default_timezone_set('Asia/Kuala_Lumpur');
              $currentDate = date_create(strval(date('y-m-d h:i:s'))); 
              $modifyDate = date_create($rTime);
              $difference = date_diff($currentDate, $modifyDate); 
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
              // echo json_encode($updateField);

              ((!empty($otherData['photo'])) ? $rProPic = $otherData['photo'] : $rProPic = './images/sampleProfilePic.jpg');

              //display right tab content
              echo '<div class="row mb-2 pe-1 py-2 activity">
              <div class="col-3">
                <img src="'.$rProPic.'" class="img-fluid img-thumbnail" id="i-size" />
              </div>
              <div class="col-9">
                <div class="row text-secondary right-duration">'.$period.'</div>
                <div class="row right-description">'.$rUser.' has '.$rContent.'</div>
              </div>
            </div>';
            }
          ?>
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
              $htmlLine = '';
              $count = 0;
              $preID = 0;
              $goalCount = 1;
              $trigger = false;
              $userID = json_decode($_SESSION['auth'],true)['user_id']; 
              
              if (!isset($_GET['mentors'])) {
                $role = "Mentor"; 
                generateSocialList($role);                           
              } else {
                $role = "Mentee";
                generateSocialList($role);
              }
               //function to generate content
              function generateSocialList($role){
                require @realpath(dirname(__FILE__) . "/config/databaseConn.php");
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
                $sql = 'SELECT * from goal WHERE '.$field.' = '.$userID.' AND '.$field1.' IS NOT NULL'; // only this line use field(own role)
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                
                while ($row = $result->fetch_assoc()) {

                  $looped = true;
                  $count += 1;
                  $open = false;

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
                      "SELECT name, photo from user WHERE user_id = ?"
                    );
                    $stmt1->bind_param("i", $row[$field1]);
                    $stmt1->execute();
                    $result1 = $stmt1->get_result(); 
                    $row1 = $result1->fetch_assoc();  
                    array_push($goalArr,$row['goal_id']); 
                    $_SESSION['mentor_id'] = $row['mentor_id'];
                    $_SESSION['mentee_id'] = $row['mentee_id'];

                    ((!empty($row1['photo'])) ? $proPic = $row1['photo'] : $proPic = './images/sampleProfilePic.jpg');

                    $htmlLine .= 
                    '<div class="col">
                    <a href="./social-goal.php?userID='.$row[$field1].'&role='.$role.'" class="text-decoration-none">
                    <div class="card h-100" id="singleCard" >
                    <img src="'.$proPic.'" class="card-img-top"/>
                    <div class="card-body">
                    <h5 class="card-title text-uppercase text-dark">'.$row1['name'].'</h5>
                    <p class="card-text text-secondary fst-italic">'.$row['goal_title'].'</p>';                 
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