<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");

$mentor = $_POST['mentor'];
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$tracking = $_POST['tracking'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$id = $_POST['id'];

$editsql = "UPDATE `goal` SET  `mentor_id`='$mentor' , `goal_title`= '$title', `goal_description`='$description',  `goal_category`='$category', `tracking_method` = '$tracking', `goal_start_date` = '$startDate', `goal_due_date` = '$endDate' WHERE goal_id='$id' ";
$editQuery= mysqli_query($conn,$editsql);
$lastId = mysqli_insert_id($conn);
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