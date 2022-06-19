<?php
require_once @realpath(dirname(__FILE__)) . "/../config/databaseConn.php";
require_once @realpath(dirname(__FILE__) . "/../src/services/checkAuthenticated.php");
// var_dump($_POST);
// var_dump($_FILES);
$image = $_FILES["profile"];
$img_size = $_FILES["profile"]["size"];
if ($img_size > 0) {
  $img_name = $_FILES["profile"]["name"];
  $tmp_name = $_FILES["profile"]["tmp_name"];
  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
  $img_ex_lc = strtolower($img_ex);
  $allowed_exs = array("jpg", "jpeg", "png");
  if (in_array($img_ex_lc, $allowed_exs)) {
    $new_img_name = uniqid("IMG-", true) . "." . $img_ex_lc;
    $img_upload_path = "uploads/" . $new_img_name;
    if (!file_exists('uploads')) {
      mkdir("uploads");
    }
    move_uploaded_file($tmp_name, $img_upload_path);
    $image_base64 = base64_encode(file_get_contents($img_upload_path));
    $en_image = "data:image/" . $img_ex_lc . ";base64," . $image_base64;
    // error_log($en_image);
    if (file_exists($img_upload_path)) {
      unlink($img_upload_path);
    }
  }
  else {
    $em = "You can't upload files of this type";
    header("Location: edit-profile.php?error=$em");
  }
}
else {
  $image_base64 = base64_encode(file_get_contents(@realpath(dirname(__FILE__) . "/../images/default-user.png")));
  $en_image = "data:image/jpg;base64," . $image_base64;
}
date_default_timezone_set('Asia/Kuala_Lumpur');
$timestamp = date("Y-m-d H:i:s", time());

$curr_user_id = $_POST["save_changes"];
// error_log("user id" . $curr_user_id);
// error_log("image" . $en_image);

$sql = "UPDATE user SET photo = ? WHERE user_id = ?";
// error_log("sql: " . $sql);
// $result = mysqli_query($conn, $sql);
// mysqli_free_result($result);
// mysqli_close($conn);
// $sql = "INSERT INTO `action plan` (goal_id, ap_timestamp, ap_start_date, ap_due_date, ap_title, ap_image) VALUES (?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $en_image, $curr_user_id);
$stmt->execute();
header("Location: ../profile.php");

?>