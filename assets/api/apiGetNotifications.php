<?php

include("db_connect.php");
$db = new DB_connect();
$con = $db->connect();

$response = array();

if(isset($_REQUEST['user_id'])){

    $user_id = $_REQUEST['user_id'];

    $qry = "
SELECT n.*
FROM notifications n
WHERE NOT EXISTS (
SELECT 1 FROM notification_reads r
WHERE r.notification_id = n.id
AND r.user_id = '$user_id'
)
ORDER BY n.created_at DESC
";

    $result = mysqli_query($con,$qry);

    $notifications = array();

    while($row = mysqli_fetch_assoc($result)){
        $notifications[] = $row;
    }

    $response["success"] = 1;
    $response["notifications"] = $notifications;

}else{

    $response["success"] = 0;
    $response["message"] = "user_id required";

}

echo json_encode($response);

?>