<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php echo (($_GET['role']=="Mentor" ) ? "Mentee: Your Mentee's Action Plan" :"Mentor: My Action Plan"); ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="./styles/index.css" />
  <style>
  a:hover {
    color: red;
  }

  .card {
    border-color: lightgray;
    border-radius: 1em;
    border-style: solid;
  }

  .theme-yellow {
    background-color: #f9e90f;
  }
  </style>
</head>

<body>
  <div class="wrapper">
    <nav-bar></nav-bar>
    <div class="content-wrapper">
      <div class="container">
        <div class="row">
          <?php
          require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
          
          //back button
          echo '
          <div class="col-6">
          <form action="./social-goal.php" method="GET">
          <button type="submit" class="col-3 ms-3 mb-3 btn theme-yellow shadow-sm rounded-3">
              <span class="text-secondary">
                <<< </span> Back to Goal
          </button>
          <input type="hidden" name="userID" value="'.$_GET['userID'].'"/>
          <input type="hidden" name="role" value="'.$_GET['role'].'"/>
          <input type="hidden" name="sort" value="date"/>
          <input type="hidden" name="orderD" value="ASC"/>
          <input type="hidden" name="orderP" value="ASC"/>
          <input type="hidden" name="valueD" value="Earliest_Due"/>
          <input type="hidden" name="valueP" value="Least_Progress"/>
          </form>
          </div>
          <div class="col-6 pe-4">
            <form class="float-end">
              <span class="fs-5">Sort by:</span>
              <input type="button" class="ms-3 mb-3 btn theme-yellow shadow-sm rounded-3 sort-date" value="'.str_replace('_', ' ', $_GET['valueD']).'">
              </input>
              <input type="hidden" class="dateSort" name="date" value='.$_GET['orderD'].'>
              <input type="hidden" class="goalID" name="goalID" value='.$_GET['goalID'].'>
              <input type="hidden" class="userID" name="userID" value='.$_GET['userID'].'>
              <input type="hidden" class="role" name="role" value='.$_GET['role'].'>
            </form>
          </div>
          '
          
          ?>
          <?php
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
            
            //display goal title
            $stmt = $conn->prepare(
              "SELECT goal_title from goal WHERE goal_id = ?"
            );
            $stmt->bind_param("i", $_GET['goalID']);
            $stmt->execute();
            $row = $stmt->get_result()->fetch_assoc();
            echo '<h2>"'.$row['goal_title'].'" - Goal</h2>'
          ?>
        </div>
        <ul>
          <div class="row">
            <?php
            require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
            
            //display content
            $sql = 'SELECT * from `action plan` WHERE goal_id = ? ORDER BY ap_due_date '.$_GET['orderD'];
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_GET['goalID']);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
              
                //set due date
                $dueDate = date("d-m-Y", strtotime($row['ap_due_date']));

                ((!empty($row['ap_image'])) ? $apPic = $row['ap_image'] : $apPic = './images/ActionPlanDefaultImage.jpg');

                echo '<li class="card col-3 m-3 shadow" style="width: 25vw">
                <img class="card-img-top mt-3" style="height: 15vw;"
                  src="'.$apPic.'" />
                <div class="card-body">
                  <a href="social-activity.php?userID='.$_GET['userID'].'&actionplanID='.$row['ap_id'].'&role='.$_GET['role'].'" style="text-decoration: none" class="card-text">'.$row['ap_title'].'</a>
                  <p class="card-text">Due: '.$dueDate.'</p>
                </div>
              </li>';
            }
          ?>
          </div>
        </ul>
      </div>
    </div>
  </div>
  <script src="./js/navbar.js"></script>
  <script src="./js/authListener.js"></script>
  <script src="./js/socialActionPlan.js"></script>
</body>

</html>