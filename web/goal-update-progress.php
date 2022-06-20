<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");

$progress = $_POST['progress'];
$id = $_POST['id'];

$progresSql = "UPDATE `goal` SET `goal_progress`= '$progress' WHERE goal_id='$id' ";

$progressQuery= mysqli_query($conn,$progresSql);
$lastId = mysqli_insert_id($conn);
if($progressQuery == true)
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