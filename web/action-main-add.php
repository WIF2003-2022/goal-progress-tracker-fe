<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
$goal_name = $_GET["goal_name"];
$goal_id = $_GET["goal_id"];
$sql = "SELECT * FROM goal WHERE goal_id = $goal_id";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
$startConstraint = $row["goal_start_date"];
$dueConstraint = $row["goal_due_date"];
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
    <title>Add Action Plan</title>
  </head>
  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container"></div>
        <form
          class="m-5"
          action="action-main-add-process.php"
          method="post"
          enctype="multipart/form-data"
        >
          <div class="mb-3">
            <label for="action-plan-title" class="form-label">
              Action Plan Title
            </label>
            <input
              type="text"
              class="form-control"
              id="action-plan-title"
              name="ap_title"
              placeholder="Action Plan 1"
              required
            />
          </div>
          <div class="mb-3">
            <label for="action-plan-start-date" class="form-label">
              Start Date
            </label>
            <input
              type="date"
              class="form-control"
              id="action-plan-start-date"
              name="ap_start_date"
              <?php echo "min=$startConstraint" ?>
              required
            />
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
              <?php echo "max=$dueConstraint" ?>
              required
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
            />
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-3">
              Add New Action Plan
            </button>
          </div>
        </form>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script>
      var urlString = window.location.search;
      var param = new URLSearchParams(urlString);
      var queryID = parseInt(param.get("goal_id"));
      var queryName = param.get("goal_name");
      var targetURL = document.querySelector("form");
      targetURL.action =
        "action-main-add-process.php?goal_name=" +
        queryName +
        "&goal_id=" +
        queryID;
      if (param.has("error1")) {
        alert("You cannot upload files of this type.");
      }
      if (param.has("error2")) {
        alert("Your due date cannot be placed earlier than your start date.");
      }
    </script>
  </body>
</html>
