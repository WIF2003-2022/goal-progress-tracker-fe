<?php
include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
$ap_id = $_GET["id"];
$sql = "SELECT * FROM `action plan` WHERE ap_id = $ap_id";
$result = $conn -> query($sql);
$row = $result -> fetch_array();
$primary = $row["ap_id"];
$title = $row["ap_title"];
$start = $row["ap_start_date"];
$due = $row["ap_due_date"];
$image = $row["ap_image"];
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
        <input type="hidden" name="ap_id" <?php echo "value=$primary" ?>/>
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
              placeholder="Action Plan 1"
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
      var id = window.location.search;
      var param = new URLSearchParams(id);
      var query = parseInt(param.get("id"));
      urlString = "?id=" + query;
      document.querySelector("form").action += urlString;
    </script>
  </body>
</html>