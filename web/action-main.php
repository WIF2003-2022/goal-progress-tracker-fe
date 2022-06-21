<?php 
  require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Action Plan</title>
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
    <style>
      a:hover {
        color: red;
      }

      .card {
        border-color: lightgray;
        border-radius: 1em;
        border-style: solid;
      }
      .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        animation: spin 2s linear infinite;
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
    </style>
    <title>Action Plan</title>
  </head>

  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container">
          <div class="row align-items-center mb-5">
            <div class="col">
              <h2 class="title"></h2>
            </div>
            <div class="col" style="text-align: end">
              <a href="action-main-add.html" style="text-decoration: none">
                <button class="add" style="border: none; background: none">
                  <i class="bi-plus-circle" style="font-size: 30px"></i>
                </button>
              </a>
            </div>
          </div>
          <div class="loader align-items-center"></div>
          <div class="row" id="starting"></div>
          <script src="./js/actionPlan.js"></script>
        </div>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
  </body>
</html>
