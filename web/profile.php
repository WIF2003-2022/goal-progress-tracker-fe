<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./styles/profile.css" />
    <link rel="stylesheet" href="./styles/index.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!--social media icons-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./js/navbar.js"></script>
</head>

<body>
    <div class="wrapper">
        <nav-bar></nav-bar>
        <div class="content-wrapper">
            <div class="container">
                <?php
                    // current user data already saved in session
                    // so you can just retrieve them from the session
                    session_start();
                    $userStr = $_SESSION['auth'];
                    // getting from session would be a string
                    // need to decode to get the class/object
                    $user = json_decode($userStr);
                    if (!$user) {
                        header("Location: ./login.php");
                    }
                ?>
                <div class="row d-flex flex-row justify-content-center mt-5">
                    <!--<h3>Welcome back, Christian!</h3>-->
                    <!--First column contains user's avatar-->
                    <div class="leftSection col-md-4">
                        <div class="mt-3 mb-4">
                            <img src="https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_auto:good%2Cw_300/MTU0NjQzOTk4OTQ4OTkyMzQy/ansel-elgort-poses-for-a-portrait-during-the-baby-driver-premiere-2017-sxsw-conference-and-festivals-on-march-11-2017-in-austin-texas-photo-by-matt-winkelmeyer_getty-imagesfor-sxsw-square.jpg"
                                alt="Circle Image" class="img-raised rounded-circle img-fluid shadow-sm"
                                style="width: 150px;">
                        </div>
                        <div class="mt-3">
                            <!--<span class="bg-secondary p-1 px-4 rounded text-white">Mentee</span>-->
                            <div class="name mt-2">
                                <h3 class="title"><?= $user->name ?></h3>
                                <h5>Fitness Enthusiast</h5>
                                <h6><?= $user->bio ? "$user->bio" : "Write something about yourself." ?></h6>
                            </div>
                            <div class="recognition">
                                <div class="recogRow">
                                    <span class="material-icons-sharp">badge</span>
                                    <div class="title">Area of expertise</div> 
                                    <div class="content btn-instagram">Physiology</div>
                                </div>
                                <div class="recogRow">
                                    <span class="material-icons-sharp">stars</span>
                                    <div class="title">Achievements</div> 
                                    <div class="content btn-instagram">Mr. Olympia 2021 Champion</div>
                                </div>
                                <div class="recogRow">
                                    <span class="material-icons-sharp">card_membership</span>
                                    <div class="title">Certificates</div> 
                                    <div class="content btn-instagram">NASM Certified Personal Trainer</div>
                                </div>
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
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->name ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->email ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        +(60)12-345 6789
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        ************
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        128, Jalan Junid 50603 Kuala Lumpur
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bio</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        Fitness Enthusiast "I became not just a gym rat, but a runner."
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-outline-primary" target="__blank"
                                            href="edit-profile.html">Edit Profile</a>
                                        <button type="button" class="btn btn-outline-danger" id="deletebutton">Delete
                                            Account</button>
                                        <div class="overlay" id="dialog-container">
                                            <div class="popup">
                                                <p>Are you sure you want to delete your account?</p>
                                                <div class="text-right">
                                                    <button class="dialog-btn btn-cancel" id="cancel">Cancel</button>
                                                    <button class="dialog-btn btn-primary" id="confirm">Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overlay" id="message">
                                            <div class="popup">
                                                <button class="close-button" id="close" aria-label="Close alert"
                                                    type="button" style="float: right;">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <p class="mt-3">Deleted successfully! Please register a new account or
                                                    login to another account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row text-center mb-4 mt-4">
                                    <div class="col-lg-4 col-md-4 m-t-20">
                                        <h3 class="m-b-0 font-light">1</h3><small>Mentor</small>
                                    </div>
                                    <div class="vl col-lg-4 col-md-4 m-t-20">
                                        <h3 class="m-b-0 font-light">2</h3><small>Mentee</small>
                                    </div>
                                    <div class="vl col-lg-4 col-md-4 m-t-20">
                                        <h3 class="m-b-0 font-light">1</h3><small>Goals Accomplished</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./js/authListener.js"></script>
        <script type="text/javascript" src="./js/deleteAccount.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
            integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
            crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
            integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9"
            crossorigin="anonymous"></script>
</body>

</html>