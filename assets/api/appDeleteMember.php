<?php
include("db_connect.php");
$db = new DB_Connect();
$con = $db->connect();

$id = "";
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}

if ($id == "") {
    echo json_encode(array("status" => "error", "message" => "ID is required"));
    exit;
}

// Perform actual deletion of the record
$sql = "DELETE FROM pp_profileinfo WHERE id = '$id'";

if (mysqli_query($con, $sql)) {
    echo json_encode(array("status" => "success", "message" => "Profile deleted successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Database error: " . mysqli_error($con)));
}
?>
