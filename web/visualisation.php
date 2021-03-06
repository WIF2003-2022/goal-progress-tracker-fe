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
    <title>Report</title>
  </head>

  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container">
          <!-- main -->
          <div class="main">
            <div id="details">
              <a href="visualisation-details.php" class="button"
                >View details</a
              >
            </div>
            <!-- cards -->
            <div class="cardBox">
              <div class="card">
                <div>
                  <div class="numbers" id="goal-number">0</div>
                  <div class="cardName">Goals accomplished</div>
                </div>
                <div class="iconBx">
                  <i class="bi bi-bookmark-check"></i>
                </div>
              </div>
              <!-- 
              <div class="card">
                <div>
                  <div class="numbers">1</div>
                  <div class="cardName">Action plans completed</div>
                </div>
                <div class="iconBx">
                  <i class="bi bi-list-task"></i>
                </div>
              </div>
              <div class="card">
                <div>
                  <div class="numbers">2</div>
                  <div class="cardName">Activities completed</div>
                </div>
                <div class="iconBx">
                  <ion-icon name="receipt-outline"></ion-icon>
                </div>
              </div>
              -->
            </div>
            <!-- chart -->
            <div class="graphBox">
              <div class="box">
                <canvas id="polarChart" width="200" height="200"></canvas>
              </div>
              <div class="box">
                <canvas id="lineChart" width="200" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <script>
      $(document).ready(() => {
          $.ajax({
          url: "./src/userGoal.php?accomplished_only=true",
          type: "GET",
          dataType: "json",
        })
          .done((json) => {
            $("#goal-number").text(json.length);
          })
          .fail((xhr, status, errorThrown) => {
            alert("Sorry, there was a problem!");
            console.log("Error: " + errorThrown);
            console.log("Status: " + status);
            console.dir(xhr);
          })
          .always(function (xhr, status) {
            console.log("The request is complete!");
          });
      });
    </script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
    <script src="./js/lineChart.js"></script>
    <script src="./js/polarChart.js"></script>
    <script src="./js/navbar.js"></script>
  </body>
</html>
