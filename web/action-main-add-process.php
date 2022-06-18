<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $goal_name = $_GET["goal_name"];
  $goal_id = $_GET["goal_id"];
  $ap_id = $_GET["ap_id"];
  $title = $_POST["ap_title"];
  $start = $_POST["ap_start_date"];
  $due = $_POST["ap_due_date"];
  $image = $_FILES["ap_image"];
  $img_size = $_FILES["ap_image"]["size"];
  $condtion = $due < $start;
  if($due < $start) {
    header("Location: action-main-add.html?goal_name=$goal_name&goal_id=$goal_id&ap_id=$ap_id&error2");
    exit();
  }
  if($img_size > 0){
    $img_name = $_FILES["ap_image"]["name"];
    $tmp_name = $_FILES["ap_image"]["tmp_name"];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");  
    if(in_array($img_ex_lc, $allowed_exs)) {
      $new_img_name = uniqid("IMG-", true).".".$img_ex_lc;
      $img_upload_path = "uploads/".$new_img_name;
      move_uploaded_file($tmp_name, $img_upload_path);
      $image_base64 = base64_encode(file_get_contents($img_upload_path));
      $en_image = "data:image/".$img_ex_lc.";base64,".$image_base64;
      if(file_exists($img_upload_path)) {
        unlink ($img_upload_path);
      }
    }
    else {
      header("Location: action-main-add.html?goal_name=$goal_name&goal_id=$goal_id&ap_id=$ap_id&error1");
      exit();
    }
  }
  else {
    $image_base64 = base64_encode(file_get_contents(@realpath(dirname(__FILE__) . "/../web/images/ActionPlanDefaultImage.jpg")));
    $en_image = "data:image/jpg;base64,".$image_base64;
  }
  date_default_timezone_set('Asia/Kuala_Lumpur');
  $timestamp = date("Y-m-d H:i:s",time());
  
  $sql = "INSERT INTO `action plan` (goal_id, ap_timestamp, ap_start_date, ap_due_date, ap_title, ap_image) VALUES (?,?,?,?,?,?)";
  $stmt = $conn -> prepare($sql);
  $stmt -> bind_param ("isssss", $goal_id, $timestamp, $start, $due, $title, $en_image);
  $stmt -> execute();
  $stmt -> close();
  $conn -> close();
  header("Location: action-main.html?goal_name=$goal_name&goal_id=$goal_id");
?>