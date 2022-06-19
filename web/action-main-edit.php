<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
$goal_name = $_GET["goal_name"];
$goal_id = $_GET["goal_id"];
$ap_id = $_GET["ap_id"];
$sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
$result = $conn -> query($sql);
$row = $result -> fetch_array();
$primary = $row["ap_id"];
$title = $row["ap_title"];
$start = $row["ap_start_date"];
$due = $row["ap_due_date"];
$image = $row["ap_image"];
$sql = "SELECT * FROM goal WHERE goal_id = $goal_id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
$startConstraint = $row["goal_start_date"];
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
    <link rel="stylesheet" href="./styles/index.css" />
    <script src="./js/navbar.js"></script>
    <title>Edit Action Plan</title>
  </head>
  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container"></div>
        <form
          class="m-5"
          action="action-main-edit-process.php"
          method="post"
          enctype="multipart/form-data"
        >
        <input type="hidden" name="goal_name" value="<?php echo $goal_name;?>">
        <input type="hidden" name="goal_id" value="<?php echo $goal_id;?>">
        <input type="hidden" name="ap_id" value="<?php echo $ap_id;?>">
          <div class="mb-3">
            <label for="action-plan-title" class="form-label">
              Action Plan Title
            </label>
            <input
              type="text"
              class="form-control"
              id="action-plan-title"
              name="ap_title"
              <?php echo "value=$title" ?>
            />
          </div>
          <div class="mb-3">
            <label for="action-plan-start-date" class="form-label" name>
              Start Date
            </label>
            <input
              type="date"
              class="form-control"
              id="action-plan-start-date"
              name="ap_start_date"
              <?php echo "value=$start" ?>
              <?php echo "min=$startConstraint" ?>
            >
          </div>
          <div class="mb-3">
            <label for="action-plan-due-date" class="form-label">
              Due Date
            </label>
            <input
              type="date"
              class="form-control"
              id="action-plan-due-date"
              name="ap_due_date"
              <?php echo "value=$due" ?>
            />
          </div>
          <div class="mb-3">
            <label for="action-plan-image" class="form-label">
              Action Plan Image
            </label>
            <input
              type="file"
              class="form-control"
              id="action-plan-image"
              name="ap_image"
              <?php echo "value=$image" ?>
            />
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-3">Confirm</button>
          </div>
        </form>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script>
      var urlString = window.location.search;
      var param = new URLSearchParams(urlString);
      if (param.has("error1")) {
        alert("You cannot upload files of this type.");
      }
      if (param.has("error2")) {
        alert("Your due date cannot be placed earlier than your start date.");
      }
    </script>
  </body>
</html>
