<?php
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
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
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/visualisation.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <title>Report</title>
  </head>

  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="flex-container">
          <div class="goalBox">
            <div id="buttons">
              <button class="btn" onclick="filterObjects('all')">All</button>
              <button class="btn" onclick="filterObjects('active')">
                Active
              </button>
              <button class="btn" onclick="filterObjects('accomplished')">
                Accomplished
              </button>
              <button class="btn" onclick="filterObjects('failed')">
                Failed
              </button>
            </div>

            <div class="objects"></div>
          </div>
        </div>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script src="./js/visualisation.js"></script>
    <script src="./js/visualisationDetails.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>
