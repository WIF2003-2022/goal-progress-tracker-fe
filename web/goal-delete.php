<?php 
require_once @realpath(dirname(__FILE__) . "/config/databaseConn.php");
require_once @realpath(dirname(__FILE__) . "/src/services/checkAuthenticated.php");

$userID = json_decode($_SESSION['auth'],true)['user_id'];
$goal = $_POST["id"];
$deletesql = "DELETE FROM goal WHERE `goal`. `goal_id` =$goal";
$deleteRecentsql = "DELETE FROM recent WHERE updated_id = $goal AND user_id = $userID AND r_type = "."'goal'";
$delQuery =mysqli_query($conn,$deletesql);
$delQuery =mysqli_query($conn,$deleteRecentsql);
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