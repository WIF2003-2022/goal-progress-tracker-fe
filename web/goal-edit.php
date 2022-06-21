<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");

session_start();

$mentor = $_POST['mentor'];
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$tracking = $_POST['tracking'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$id = $_POST['id'];
$userID = json_decode($_SESSION['auth'],true)['user_id'];

if ($mentor == "") {
    $editsql = "UPDATE `goal` SET  `mentor_id`= null , `goal_title`= '$title', `goal_description`='$description',  `goal_category`='$category', `tracking_method` = '$tracking', `goal_start_date` = '$startDate', `goal_due_date` = '$endDate' WHERE goal_id='$id' ";
}
else{
    $editsql = "UPDATE `goal` SET  `mentor_id`='$mentor' , `goal_title`= '$title', `goal_description`='$description',  `goal_category`='$category', `tracking_method` = '$tracking', `goal_start_date` = '$startDate', `goal_due_date` = '$endDate' WHERE goal_id='$id' ";
}
$editQuery= mysqli_query($conn,$editsql);
$lastId = mysqli_insert_id($conn);

$recentsql = "INSERT INTO `recent` (`r_type`, `user_id`, `updated_id`, `action`) 
                    values('goal', '$userID', '$id', 'edit')";
mysqli_query($conn,$recentsql);

if($editQuery == true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>