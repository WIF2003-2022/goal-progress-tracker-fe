<?php
require @realpath(dirname(__FILE__) . "/config/databaseConn.php");
//include './src/message.php';
?>

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

                <!--Retrieve current user data from session-->
                <?php
                    // current user data already saved in session
                    // so you can just retrieve them from the session
                    session_start();
                    $userStr = $_SESSION['auth'];
                    // getting from session would be a string
                    // need to decode to get the class/object
                    $user = json_decode($userStr);
                    // $userid = json_decode($userstr, true)["user_id"];
                    if (!$user) {
                        header("Location: ./login.php"); //change location of http header to login.php
                    }

                    //fetch latest user info from db
                    $userInfo = "SELECT name, email, mobile_phone, address, bio, photo
                                 FROM user
                                 WHERE user_id = $user->user_id";
                    $resInfo = mysqli_query($conn, $userInfo);
                    $rowInfo = mysqli_fetch_array($resInfo); 
                ?>

                <div class="row d-flex flex-row justify-content-center mt-5">
                    <!--<h3>Welcome back, <?php echo $rowInfo['name'] ?>!</h3>-->
                    <!--First column contains user's avatar-->
                    <div class="leftSection col-md-4">
                        <div class="mt-3 mb-4">
                            <img src=<?php echo $rowInfo['photo'] ?? "images/default-user.png"; ?>
                                 alt="Circle Image" 
                                 class="rounded-circle"
                                 style="width: 200px;">
                        </div>
                        <div class="mt-3">
                            <div class="name mt-2">
                                <h3 class="title"><?php echo $rowInfo['name'] ?></h3>
                                <h5><?php echo $rowInfo['bio'] ?? "Write something about yourself." ?></h5> <!--double check ??-->
                            </div>
                            <div class="recognition">
                            <?php
                                $expertise = "SELECT e_title FROM expertise WHERE user_id = $user->user_id";
                                $achievement = "SELECT ach_title FROM achievement WHERE user_id = $user->user_id";
                                $cert = "SELECT c_title FROM certificate WHERE user_id = $user->user_id";

                                $res1 = mysqli_query($conn, $expertise);
                                $res2 = mysqli_query($conn, $achievement);
                                $res3 = mysqli_query($conn, $cert);
                            ?>
                                <div class="recogRow">
                                    <span class="material-icons-sharp">badge</span>
                                    <div class="title">Area of expertise</div> 
                                    <?php
                                        while ($row1 = mysqli_fetch_array($res1))
                                        {
                                    ?>
                                            <div class="content btn-instagram"><?php echo $row1['e_title']; ?></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="recogRow">
                                    <span class="material-icons-sharp">stars</span>
                                    <div class="title">Achievements</div> 
                                    <?php
                                        while ($row2 = mysqli_fetch_array($res2))
                                        {
                                    ?>
                                            <div class="content btn-instagram"><?php echo $row2['ach_title']?></div>
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
                                            <div class="content btn-instagram"><?php echo $row3['c_title']?></div>
                                    <?php
                                        }
                                    ?>
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
                                        <?php echo $rowInfo['name'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $rowInfo['email'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $rowInfo['mobile_phone'] ?? "Update your phone number with +country code." ?>
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
                                        <?php echo $rowInfo['address'] ?? "Update your address." ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bio</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php echo $rowInfo['bio'] ?? "Write something about yourself."?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-outline-primary" target="__blank" href="edit-profile.php">
                                            Edit Profile
                                        </a>
                                        <!-- Trigger the delete account modal with a button -->
                                        <button id="deleteAccount" 
                                                type="button" 
                                                class="btn btn-outline-danger" 
                                                data-toggle="modal" 
                                                data-target="#deleteModal">
                                            Delete Account
                                        </button>
                             
                                        <!--Delete Modal -->
                                        <div id="deleteModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Account</h4>
                                                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete your account?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="./src/deleteAccount.php" method="post">
                                                        <button id="delete" 
                                                                type="submit" 
                                                                name="user_delete" 
                                                                value="<?=$user->user_id ?>" 
                                                                class="btn btn-danger" 
                                                                data-toggle="modal" 
                                                                data-target="#message">
                                                            Delete
                                                        </button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <!--Message Modal-->
                                        <div id="message" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Successful</h4>
                                                    <button id=close type="button" class="btn-close" data-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mt-4">Please register a new account or login to another account.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="exit" name="exit" type="button" class="btn btn-primary">Exit</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">

                                <!--Retrieve user info : mentor, mentee, goal accomplished-->
                                <?php
                                    $userMentor = "SELECT COUNT(mentor_id) 
                                    AS MentorNo 
                                    FROM goal 
                                    WHERE mentee_id=$user->user_id";

                                    $userMentee = "SELECT COUNT(mentee_id) 
                                    AS MenteeNo
                                    FROM goal 
                                    WHERE mentor_id=$user->user_id";

                                    $goalAccomplished = "SELECT COUNT(goal_id) AS noOfGoalsAccomplished
                                    FROM goal
                                    WHERE goal_status = 'Accomplished'
                                    AND goal_progress = 100
                                    AND mentee_id = $user->user_id";

                                    $res4 = mysqli_query($conn, $userMentor); //return mysqli_result object
                                    $res5 = mysqli_query($conn, $userMentee);
                                    $res6 = mysqli_query($conn, $goalAccomplished);

                                    $row4 = mysqli_fetch_array($res4);
                                    $row5 = mysqli_fetch_array($res5);
                                    $row6 = mysqli_fetch_array($res6);

                                    // mysqli_free_result($res4);
                                    // mysqli_free_result($res5);
                                    // mysqli_free_result($res6);

                                    // mysqli_close($conn);
                                ?>
                                <!--output: 0 1 1-->
                                <div class="row text-center mb-4 mt-4">
                                    <div class="col-lg-4 col-md-4 m-t-20">
                                        <h3 class="m-b-0 font-light"><?php echo $row4['MentorNo'] ?></h3><small>Mentor</small> 
                                    </div>
                                    <div class="vl col-lg-4 col-md-4 m-t-20">
                                        <h3 class="m-b-0 font-light"><?php echo $row5['MenteeNo'] ?></h3><small>Mentee</small>
                                    </div>
                                    <div class="vl col-lg-4 col-md-4 m-t-20">
                                        <h3 class="m-b-0 font-light"><?php echo $row6['noOfGoalsAccomplished'] ?></h3><small>Goals Accomplished</small>
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