<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");

$ap_name = $_GET["ap_name"];
$ap_id = $_GET["ap_id"];
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
    <title>Add Activity</title>
  </head>
  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container"></div>
        <form class="m-5" action="activity-add-process.php" method="post">
          <div class="mb-3">
            <label for="activity-title" class="form-label">
              Activity Title
            </label>
            <input
              type="text"
              class="form-control"
              id="activity-title"
              name="a_title"
              placeholder="Activity 1"
              required
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
              placeholder="Description XXX"
              rows="3"
              required
            ></textarea>
          </div>
          <div class="mb-3">
            <label for="activity-start-date" class="form-label"
              >Start Date
            </label>
            <input
              type="date"
              class="form-control"
              name="a_start_date"
              id="activity-start-date"
              <?php echo "min=$startConstraint" ?>
              required
            />
          </div>
          <div class="mb-5">
            <label for="activity-due-date" class="form-label"> Due Date </label>
            <input
              type="date"
              class="form-control"
              name="a_due_date"
              id="activity-due-date"
              <?php echo "max=$dueConstraint" ?>
              required
            />
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
                  placeholder="1"
                  required
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
                  placeholder="7"
                  required
                />
              </div>
              <div class="col-1 m-1">day(s)</div>
            </div>
          </div>
          <div>
            <div class="form-check">
              <label class="form-check-label" for="flexCheckDefault">
                Do you want to add reminder(s) ?
              </label>
              <input
                class="form-check-input"
                type="checkbox"
                id="flexCheckDefault"
                name="a_reminder"
              />
            </div>
          </div>
          <!-- https://codepen.io/neilpomerleau/pen/wzxzQM -->
          <div class="mt-5">Priority level</div>
          <div class="mb-5 rating">
            <label>
              <input type="radio" name="stars" value="1" required />
              <span class="icon">???</span>
            </label>
            <label>
              <input type="radio" name="stars" value="2" required />
              <span class="icon">???</span>
              <span class="icon">???</span>
            </label>
            <label>
              <input type="radio" name="stars" value="3" required />
              <span class="icon">???</span>
              <span class="icon">???</span>
              <span class="icon">???</span>
            </label>
            <label>
              <input type="radio" name="stars" value="4" required />
              <span class="icon">???</span>
              <span class="icon">???</span>
              <span class="icon">???</span>
              <span class="icon">???</span>
            </label>
            <label>
              <input type="radio" name="stars" value="5" required />
              <span class="icon">???</span>
              <span class="icon">???</span>
              <span class="icon">???</span>
              <span class="icon">???</span>
              <span class="icon">???</span>
            </label>
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-3">
              Add New Activity
            </button>
          </div>
        </form>
      </div>
    </div>
    <script>
      var urlString = window.location.search;
      var param = new URLSearchParams(urlString);
      var queryID = parseInt(param.get("ap_id"));
      var queryName = param.get("ap_name");
      var targetURL = document.querySelector("form");
      targetURL.action =
        "activity-add-process.php?ap_name=" + queryName + "&ap_id=" + queryID;
      if (param.has("error2")) {
        alert("Your due date cannot be placed earlier than your start date.");
      }
    </script>
    <script src="./js/authListener.js"></script>
  </body>
</html>
