<?php
require_once @realpath(dirname(__FILE__)) . "../../config/databaseConn.php";

if (isset($_POST['save_changes'])) 
{
  $id = mysqli_real_escape_string($conn, $_POST['save_changes']); //get user id from value 
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $mobile = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $bio = mysqli_real_escape_string($conn, $_POST['query']);
  $expertise = mysqli_real_escape_string($conn, $_POST['expertise']);
  $achievement = mysqli_real_escape_string($conn, $_POST['achievements']);
  $certificate = mysqli_real_escape_string($conn, $_POST['cert']);

  //not sure cuz bootstrap mcm alr check for us
  if (empty($name) || empty($email) || empty($mobile) || empty($address) || empty($bio)
  || empty($expertise) || empty($achievement) || empty($certificate)) {
    if (empty($name)) {
      echo "<font colour='red'>Name field is empty.</font>";
    }
    if (empty($email)) {
      echo "<font colour='red'>Email field is empty.</font>";
    }
    if (empty($mobile)) {
      echo "<font colour='red'>Mobile field is empty.</font>";
    }
    if (empty($address)) {
      echo "<font colour='red'>Address field is empty.</font>";
    }
    if (empty($bio)) {
      echo "<font colour='red'>Bio field is empty.</font>";
    }
    if (empty($expertise)) {
      echo "<font colour='red'>Expertise field is empty.</font>";
    }
    if (empty($achievement)) {
      echo "<font colour='red'>Achievements field is empty.</font>";
    }
    if (empty($certificate)) {
      echo "<font colour='red'>Certificates field is empty.</font>";
    }
  }
  else {
    $boo = FALSE;

    //update user's name and email
    $updateNameEmail = "UPDATE user 
                        SET name='$name', email='$email' 
                        WHERE user_id='$id'";
    $res1 = mysqli_query($conn, $updateNameEmail); //return true
    if ($res1 == TRUE) {
      $boo = TRUE;
    }

    //query to select all user's extra records
    $check = "SELECT mobile_phone, address, bio, 
    FROM user
    WHERE user_id = $id";

    //then check if the extra records (user's mobile, address, bio) are empty
    //perform insert into
    if (empty($check)) {
      $updateUser = "UPDATE user 
                     SET mobile_phone='$mobile', address='$address', bio='$bio' 
                     WHERE user_id=$id";
      $res2 = mysqli_query($conn, $updateUser);

      if ($res2 == TRUE) {
        $boo = TRUE;
      }
    }
    else //update user's extra data & insert new record in recognition section
    {
      $updateUser = "UPDATE user 
                     SET mobile_phone='$mobile', address='$address', bio='$bio' 
                     WHERE user_id = $id";
      $addExpertise = "INSERT INTO expertise (e_title, user_id)
                       VALUES ('$expertise', $id)";
      $addAchievement = "INSERT INTO achievement (ach_title, user_id)
                         VALUES ('$achievement', $id)";
      $addCert = "INSERT INTO certificate (c_title, user_id)
                  VALUES ('$certificate', $id)";

      $res3 = mysqli_query($conn, $updateUser);
      $res4 = mysqli_query($conn, $addExpertise);
      $res5 = mysqli_query($conn, $addAchievement);
      $res6 = mysqli_query($conn, $addCert);

      if ($res3 && $res4 && $res5 && $res6 == TRUE) {
        $boo = TRUE;
      }
    }

    mysqli_close($conn);

    if ($boo == TRUE) {
      $_SESSION['message'] = "Update Successfully";
      header("Location: ../profile.php");
      exit;
    }
    else {
      $_SESSION['message'] = "Something went wrong";
      header("Location: ../edit-profile.php");
      exit;
    }
  }
}
?>