<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome!</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@500&family=Roboto+Mono&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./styles/auth.css" />
    <script
      src="https://kit.fontawesome.com/7bbaff4086.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
    />
  </head>
  <body>
    <?php
      session_start();
      if (isset($_SESSION['auth'])) {
        header("Location: ./index.php");
      }
    ?>
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Login failed</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p id="errorText">You are not registered.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex align-items-center min-vh-100">
      <div class="container text-center mb-3">
        <div class="row">
          <div class="col">
            <img
              src="./images/undraw_shared_goals_re_jvqd 1.svg"
              alt="shared goals"
              class="img-fluid"
              id="shared-goal"
            />
          </div>
        </div>
        <div class="row">
          <div class="col my-5">
            <h1 id="title">Goal Progress Tracker System</h1>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-5 col-sm-10 col-md-10">
            <form
              method="post"
              id="login-form"
              novalidate
            >
              <div class="form-group mb-3">
                <input
                  name="id"
                  id="id"
                  placeholder="Username / Email"
                  class="form-control mb-3 py-4"
                  required
                />
                <div class="invalid-feedback" id="id-feedback"></div>
              </div>
              <div class="row align-items-center mb-3">
                <div class="col-11">
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control py-4"
                    placeholder="Password"
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
              <div class="text-end mt-2 mb-2">
                <a href="request-email.html">Forgot password?</a>
              </div>
              <button
                type="submit"
                name="submit"
                class="btn btn-primary w-100 p-4"
                id="submit-btn"
              >
                Sign In
              </button>
            </form>
          </div>
        </div>
        <!-- below is the section for third party oauth -->
        <!-- <div class="row">
        <div class="col">
          <div class="text-center m-3">
            <p>Or Sign Up With</p>
            <button class="btn p-4" onclick="window.location.href='index.html'">
              <i class="fa-brands fa-google fa-2x"></i>
            </button>
            <button class="btn p-4" onclick="window.location.href='index.html'">
              <i class="fa-brands fa-facebook fa-2x"></i>
            </button>
            <button class="btn p-4" onclick="window.location.href='index.html'">
              <i class="fa-brands fa-apple fa-2x"></i>
            </button>
          </div>
        </div>
      </div> -->
        <div class="row mt-5">
          <div class="col">
            Don't have an account?
            <strong><a href="register.html">Register Now</a></strong>
          </div>
        </div>
      </div>
    </div>
    <img src="./images/Vector.svg" alt="wavy" id="wavy-img" class="img-fluid" />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="module" src="./js/loginAction.js"></script>
    <script src="./js/password.js"></script>
  </body>
</html>
