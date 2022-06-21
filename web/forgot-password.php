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
    <title>Reset Password</title>
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
    <div class="container text-center mb-3 mt-3">
      <div class="row">
        <div class="col" id="title">Reset Password</div>
      </div>
      <div class="row">
        <div class="col">
          <img
            src="./images/forgot-password-animate.svg"
            alt=""
            id="forgotPassword"
          />
        </div>
      </div>
      <div class="row">
        <div class="col pb-3" id="subtitle">Goal Progress Tracker System</div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-5 col-sm-10">
          <form
            action="./src/handleForgotPassword.php?token=<?=$_GET['token']?>"
            method="post"
            id="forgot-password-form"
            novalidate
          >
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
            <div class="row align-items-center mb-3">
              <div class="col-11">
                <input
                  name="password"
                  id="password"
                  type="password"
                  placeholder="Password"
                  class="form-control pt-4 pb-4"
                  required
                  pattern="(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                  data-pattern-desc="contains at least 1 digit, 1 special character and 1 uppercase letter"
                  minlength="8"
                />
                <div class="invalid-feedback" id="password-feedback"></div>
              </div>
              <div class="col-1">
                <a class="input-group-text" id="showPassword" type="button">
                  <i class="bi bi-eye"></i>
                </a>
              </div>
            </div>
            <div class="form-group mb-3">
              <button
                type="submit"
                class="btn btn-primary w-100 p-4 mt-3"
                id="submit-btn"
              >
                Reset Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script type="module" src="./js/forgotPasswordValidate.js"></script>
    <script src="./js/password.js"></script>
  </body>
</html>
