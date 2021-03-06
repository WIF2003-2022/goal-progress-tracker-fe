<?php 
  session_start();
  if (isset($_SESSION['auth'])) {
    header("Location: ./index.php");
    die();
  }
  $_SESSION['_token'] = bin2hex(random_bytes(16));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>One click away</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Comforter+Brush&family=Outfit:wght@500&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./styles/auth.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
    />
  </head>
  <body>
    <div class="container text-center my-3">
      <div class="row">
        <div class="col" id="title">You are one click away!</div>
      </div>
      <div class="row my-2">
        <div class="col">
          <img
            src="./images/image_processing20210909-26096-1vixh4c.gif"
            alt=""
            id="forgotPassword"
          />
        </div>
      </div>
      <div class="row">
        <p class="col">
          We are delivering the verification link to your email. <br />Check
          your email later!
        </p>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script>
      setTimeout(() => {
        window.location.href = "login.php";
      }, 5000);
    </script>
  </body>
</html>
