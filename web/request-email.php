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
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Reset password request failed!</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="errorText">
              You might not have an account with this email address.
            </p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary close"
              data-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="container text-center mb-3 mt-3">
      <div class="row">
        <div class="col" id="title">We need your email!</div>
      </div>
      <div class="row">
        <div class="col">
          <img src="./images/emails-animate.svg" alt="" id="forgotPassword" />
        </div>
      </div>
      <div class="row">
        <div class="col pb-3" id="subtitle">Goal Progress Tracker System</div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-5 col-sm-10">
          <form
            method="post"
            id="request-email-form"
            class="needs-validation"
            novalidate
          >
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
            <div class="form-group">
              <input
                name="email"
                id="email"
                type="email"
                placeholder="Email"
                class="form-control pt-4 pb-4"
                required
              />
              <div class="invalid-feedback" id="email-feedback"></div>
            </div>
            <div class="form-group mb-3">
              <button
                type="submit"
                class="btn btn-primary w-100 p-4 mt-3"
                id="submit-btn"
              >
                Send Verification Email
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
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <script type="module" src="./js/requestEmailAction.js"></script>
  </body>
</html>
