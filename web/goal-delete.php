<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");

$goal = $_POST["id"];
$deletesql = "DELETE FROM goal WHERE `goal`. `goal_id` =$goal";
$delQuery =mysqli_query($conn,$deletesql);
if($delQuery==true)
{
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>