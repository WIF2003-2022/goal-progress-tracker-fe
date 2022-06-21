<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
$ap_name = $_GET["ap_name"];
$a_id = $_GET["a_id"];
$ap_id = $_GET["ap_id"];
$sql = "SELECT * FROM activity WHERE a_id = $a_id";
$result = $conn -> query($sql);
$row = $result -> fetch_array();
$title = $row["a_title"];
$description = $row["a_description"];
$start = $row["a_start_date"];
$due = $row["a_due_date"];
$time = $row["a_times"];
$day = $row["a_days"];
$reminder = $row["a_reminder"];
$priority = $row["a_priority"];
$sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
$startConstraint = $row["ap_start_date"];
$dueConstraint = $row["ap_due_date"];
$conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./js/navbar.js"></script>
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/priority.css" />
    <title>Edit Activity</title>
  </head>
  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container"></div>
        <form class="m-5" action="activity-edit-process.php" method="post">
          <div class="mb-3">
            <input type="hidden" name="ap_id" <?php echo "value=$ap_id"; ?>>
            <input type="hidden" name="a_id" <?php echo "value=$a_id"; ?>>
            <input type="hidden" name="ap_name" value="<?php echo $ap_name;?>">
            <label for="activity-title" class="form-label">
              Activity Title
            </label>
            <input
              type="text"
              class="form-control"
              id="activity-title"
              name="a_title"
              value="<?php echo $title?>"
            />
          </div>
          <div class="mb-3">
            <label for="activity-description" class="form-label">
              Activity Description
            </label>
            <textarea
              class="form-control"
              id="activity-description"
              name="a_description"
              rows="3"
            ></textarea>
          </div>
          <div class="mb-3">
            <label for="activity-start-date" class="form-label"
              >Start Date
            </label>
            <input type="date" class="form-control" id="activity-start-date" name="a_start_date" <?php echo "value=$start"?> <?php echo "min=$startConstraint" ?>>
          </div>
          <div class="mb-5">
            <label for="activity-due-date" class="form-label"> Due Date </label>
            <input type="date" class="form-control" id="activity-due-date" name="a_due_date" <?php echo "value=$due" ?> <?php echo "max=$dueConstraint" ?>>
          </div>
          <div class="mb-5">
            <label for="activity-frequency" class="form-label">
              Frequency (e.g. 3 times in 1 day)
            </label>
            <div class="row">
              <div class="col-3">
                <input
                  type="number"
                  class="form-control activity-frequency"
                  id="activity-frequency-number"
                  name="a_times"
                  <?php echo "value=$time" ?>
                />
              </div>
              <div class="col-1 m-1">time(s)</div>
              <div class="col-2"></div>
              <div class="col-3">
                <input
                  type="number"
                  class="form-control activity-frequency"
                  id="activity-frequency-day"
                  name="a_days"
                  <?php echo "value=$day" ?>
                />
              </div>
              <div class="col-1 m-1">day(s)</div>
            </div>
          </div>
          <div class="form-check">
            <label class="form-check-label" for="flexCheckDefault">
              Do you want to add reminder(s) ?
            </label>
            <input
              class="form-check-input"
              type="checkbox"
              id="flexCheckDefault"
              name="a_reminder"
              <?php
              if ($reminder == 0) {
              }
              else {
                echo "checked";
              }
              ?>
            />
          </div>
          <!-- https://codepen.io/neilpomerleau/pen/wzxzQM -->
          <div class="mt-5">Priority level</div>
          <div class="mb-5 rating">
            <label>
              <input type="radio" name="stars" value="1" <?php if($priority==1){echo "checked";}?>/>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="2" <?php if($priority==2){echo "checked";}?>/>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="3" <?php if($priority==3){echo "checked";}?>/>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="4" <?php if($priority==4){echo "checked";}?>/>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="5" <?php if($priority==5){echo "checked";}?>/>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-3">Confirm</button>
          </div>
        </form>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script>
      var text = document.querySelector('textarea')
      text.innerHTML = "<?php echo $description ?>"
      var urlString = window.location.search;
      var param = new URLSearchParams(urlString);
      if (param.has("error2")) {
        alert("Your due date cannot be placed earlier than your start date.");
      }
    </script>
  </body>
</html>
