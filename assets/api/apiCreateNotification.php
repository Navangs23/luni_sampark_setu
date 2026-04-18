<?php

include("db_connect.php");
$db = new DB_connect();
$con = $db->connect();

$response = array();

if(isset($_REQUEST['title']) && isset($_REQUEST['message'])){

    $title = mysqli_real_escape_string($con,$_REQUEST['title']);
    $message = mysqli_real_escape_string($con,$_REQUEST['message']);
    $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : "";
    $reference_id = isset($_REQUEST['reference_id']) ? $_REQUEST['reference_id'] : "";

    $qry = "INSERT INTO notifications(title,message,type,reference_id)
        VALUES('$title','$message','$type','$reference_id')";

    $result = mysqli_query($con,$qry);

    if($result){

        $response["success"] = 1;
        $response["message"] = "Notification Created";

    }else{

        $response["success"] = 0;
        $response["message"] = "Error creating notification";

    }

}else{

    $response["success"] = 0;
    $response["message"] = "Required fields missing";

}

echo json_encode($response);

?>