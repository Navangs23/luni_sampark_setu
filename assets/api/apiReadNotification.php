<?php

include("db_connect.php");
$db = new DB_connect();
$con = $db->connect();

$response = array();

if(isset($_REQUEST['user_id']) && isset($_REQUEST['notification_id'])){

    $user_id = $_REQUEST['user_id'];
    $notification_id = $_REQUEST['notification_id'];

    $qry = "INSERT INTO notification_reads(notification_id,user_id,read_at)
VALUES('$notification_id','$user_id',NOW())";

    $result = mysqli_query($con,$qry);

    if($result){

        $response["success"] = 1;
        $response["message"] = "Notification marked as read";

    }else{

        $response["success"] = 0;
        $response["message"] = "Error";

    }

}else{

    $response["success"] = 0;
    $response["message"] = "Parameters missing";

}

echo json_encode($response);

?>