<?php
require @realpath(dirname(__FILE__) . "/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");
//include './src/message.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit profile</title>
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="./styles/profile.css" />
    <link
      href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <!--social media icons-->
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
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./js/navbar.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <nav-bar></nav-bar>
      <div class="content-wrapper">
        <div class="container">

          <!--Retrieve current user data from session-->
          <?php
            session_start();
            $userstr = $_SESSION['auth']; //[] for arrays, () for functions
            $user = json_decode($userstr);
            if (!$user) {
              header("Location: ./login.php");
            }

            //fetch latest user info from db
            $userInfo = "SELECT name, email, mobile_phone, address, bio, photo
            FROM user
            WHERE user_id = $user->user_id";
            $resInfo = mysqli_query($conn, $userInfo);
            $rowInfo = mysqli_fetch_array($resInfo); 
          ?>

          <div class="row d-flex flex-row justify-content-center mt-5">
            <!--First column contains user's avatar-->
            <div class="leftSection col-md"><!--col-md-11-->
              <div class="left mt-3 mb-4 col-sm-4">
                <img src=<?php echo $rowInfo['photo'] ?? "images/default-user.png"; ?>
                    alt="Circle Image" 
                    class="rounded-circle"
                    style="width: 200px;">
              </div>
              <div class="mt-3">
                <div class="name mt-2">
                  <h3 class="title"><?php echo $rowInfo['name'] ?></h3>
                  <h5><?php echo $rowInfo['bio'] ?? "Write something about yourself." ?></h5>
                </div>

                <div class="recognition">
                <!--retrieve user's recognition from mysql-->
                <?php
                  $expertise = "SELECT * FROM expertise WHERE user_id = $user->user_id";
                  $achievement = "SELECT * FROM achievement WHERE user_id = $user->user_id";
                  $cert = "SELECT * FROM certificate WHERE user_id = $user->user_id";

                  $res1 = mysqli_query($conn, $expertise);
                  $res2 = mysqli_query($conn, $achievement);
                  $res3 = mysqli_query($conn, $cert);
                ?>
                  <div class="recogRow">
                    <form action="./src/deleteRecognition.php" method="post">
                      <span class="material-icons-sharp">badge</span>
                      <div class="title">Area of expertise</div>
                      <?php
                        while ($row1 = mysqli_fetch_array($res1))
                        {
                      ?>
                          <div class="content">
                            <?php echo $row1['e_title']; ?>
                            <button
                              class="delete-btn"
                              name="delete_exp"
                              type="submit"
                              value="<?php echo $row1['e_id']?>" 
                              data-bs-toggle="modal"
                              data-bs-target="#deleteModal"
                            >
                              <i class="bi bi-x-circle-fill"></i>
                            </button>
                          </div>
                      <?php
                        }
                      ?>
                    <div class="recogRow">
                      <span class="material-icons-sharp">stars</span>
                      <div class="title">Achievements</div>
                      <?php
                        while ($row2 = mysqli_fetch_array($res2))
                        {
                      ?>
                          <div class="content">
                            <?php echo $row2['ach_title']?>
                            <button
                              class="delete-btn"
                              name="delete_ach"
                              type="submit"
                              value="<?php echo $row2['ach_id']?>"
                              data-bs-toggle="modal"
                              data-bs-target="#deleteModal"
                            >
                              <i class="bi bi-x-circle-fill"></i>
                            </button>
                          </div>
                      <?php
                        }
                      ?>
                    </div>
                    <div class="recogRow">
                      <span class="material-icons-sharp">card_membership</span>
                      <div class="title">Certificates</div>
                      <?php
                        while ($row3 = mysqli_fetch_array($res3)) 
                        {
                      ?>
                        <div class="content">
                          <?php echo $row3['c_title']?>
                          <button
                            class="delete-btn"
                            name="delete_cert"
                            type="submit"
                            value="<?php echo $row3['c_id']?>"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                          >
                            <i class="bi bi-x-circle-fill"></i>
                          </button>
                        </div>
                      <?php
                        }
                      ?>
                    </div>
                  </form>
                </div>
                <!--<div class="social-media mt-4 mb-3">
                      <a href="#pablo" class="btn btn-just-icon btn-link btn-instagram"><i
                              class="fa fa-instagram"></i></a>
                      <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i
                              class="fa fa-twitter"></i></a>
                      <a href="#pablo" class="btn btn-just-icon btn-link btn-facebook"><i
                              class="fa fa-facebook"></i></a>
                      <a href="#pablo" class="btn btn-just-icon btn-link btn-linkedin"><i
                              class="fa fa-linkedin"></i></a>
                  </div>-->
              </div>
            </div>
            <!--Second column contains user's basic info-->
            <div class="col-md-10"> <!--col-md-4-->
              <div class="card mb-5">
                <div class="card-body">
                  <form action="./src/updateProfile.php" method="post" enctype="multipart/form-data">
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          type="name"
                          name="name"
                          class="form-control"
                          value="<?php echo $rowInfo['name'] ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          type="email"
                          name="email"
                          class="form-control"
                          value="<?php echo $rowInfo['email'] ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          id="phone"
                          name="phone"
                          type="mobile"
                          class="form-control"
                          value="<?php echo $rowInfo['mobile_phone'] ?? "+xxxxxxxxxxxx" ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Reset Password</h6>
                      </div>
                      <div class="passwordRow col-sm-9 text-secondary">
                        <input
                          name="password"
                          id="password"
                          type="password"
                          class="form-control"
                          value="************"
                          required
                          pattern="(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                          data-pattern-desc="contains at least 1 digit, 1 special character and 1 uppercase letter."
                          minlength="8"
                        />
                        <a
                          class="input-group-text"
                          id="showPassword"
                          type="button"
                        >
                          <i class="fa fa-eye"></i>
                        </a>
                        <div
                          class="invalid-feedback"
                          id="password-feedback"
                        ></div>
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          type="address"
                          name="address"
                          class="form-control"
                          value="<?php echo $rowInfo['address'] ?? "Update your address." ?>"
                          required
                        />
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Bio</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <textarea
                          name="query"
                          id="query"
                          style="height: 80px"
                          class="form-control"
                          placeholder="<?php echo $rowInfo['bio'] ?? "Write something about yourself." ?>"
                          required
                        ></textarea>
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Area of Expertise</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input
                          type="name"
                          name="expertise"
                          class="form-control"
                          placeholder="State your area of expertise."
                          required
                        />
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Achievements</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <textarea
                          name="achievements"
                          id="achievements"
                          style="height: 80px"
                          class="form-control"
                          placeholder="State your achievements."
                          required
                        ></textarea>
                      </div>
                    </div>
                    <div class="row my-2">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Certificates</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <textarea
                          name="cert"
                          id="cert"
                          style="height: 80px"
                          class="form-control"
                          placeholder="State the name of certificates."
                          required
                        ></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <form action="./src/uploadPhoto.php" method="post" enctype="multipart/form-data">
                        <div class="col-sm-4">
                            <label for="photo">Change profile photo:</label>
                            <input type="file" id="file" name="profile" class="form-control" /><!--type="submit"-->
                        </div>
                        <div class="col-sm-8 mt-4">
                            <button
                              type="submit"
                              name="save_changes"
                              value="<?=$user->user_id ?>"
                              class="btn btn-primary"
                              style="float: right";
                            >
                              Save changes
                            </button>
                        </div>
                      </form>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./js/authListener.js"></script>
    <script>
      function myFunction() {
        window.location.href = "profile.php";
      }
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
      src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
      integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
      integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
      crossorigin="anonymous"
    ></script>
    <script src="./js/password.js"></script>
    <script src="./js/deleteRecognition.js"></script>
    <script>
      function getIp(callback) {
        fetch("https://ipinfo.io/json?token=294e64ee223f60", {
          headers: { Accept: "application/json" },
        })
          .then((resp) => resp.json())
          .catch(() => {
            return {
              country: "us",
            };
          })
          .then((resp) => callback(resp.country));
      }
      const phoneInputField = document.querySelector("#phone");
      const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "auto",
        geoIpLookup: getIp,
        preferredCountries: ["my", "sg", "cn", "us"],
        utilsScript:
          "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      });
    </script>
  </body>
</html>
