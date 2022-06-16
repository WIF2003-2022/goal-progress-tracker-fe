<?php
  include_once @realpath(dirname(__FILE__) . "/../web/config/databaseConn.php");
  $primary = $_POST["ap_id"];
  $title = $_POST["ap_title"];
  $start = $_POST["ap_start_date"];
  $due = $_POST["ap_due_date"];
  $image = $_FILES["ap_image"];
  $img_size = $_FILES["ap_image"]["size"];
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
      $sql = "UPDATE `action plan` SET ap_start_date=?, ap_due_date=?, ap_title=?, ap_image=? WHERE ap_id = ?";
      $stmt = $conn -> prepare($sql);
      $stmt -> bind_param ("ssssi", $start, $due, $title, $en_image, $primary);
    }
    else {
      $em = "You can't upload files of this type";
      header("Location: action-main-add.html?error=$em");
    }
  }
  else {
    $sql = "UPDATE `action plan` SET ap_start_date=?, ap_due_date=?, ap_title=? WHERE ap_id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param ("sssi", $start, $due, $title, $primary);
  }

  $stmt -> execute();
  $stmt -> close();
  $conn -> close();
  header("Location: action-main.html");
?>