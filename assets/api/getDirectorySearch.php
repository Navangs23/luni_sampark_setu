<?php
include("db_connect.php");
$db = new DB_Connect();
$con = $db->connect();

$query = "";
if (isset($_REQUEST['query'])) {
    $query = mysqli_real_escape_string($con, $_REQUEST['query']);
}

if (strlen($query) < 2) {
    echo json_encode(array("status" => "success", "results" => []));
    exit;
}

$cleanQuery = preg_replace('/[^0-9]/', '', $query);

$sql = "SELECT id, firstname, middlename, grandfathername, lastname, gender, mobileno, photo 
        FROM pp_profileinfo 
        WHERE status='on' 
        AND (firstname LIKE '%$query%' 
             OR middlename LIKE '%$query%' 
             OR grandfathername LIKE '%$query%' 
             OR lastname LIKE '%$query%'";

if (!empty($cleanQuery)) {
    $sql .= " OR REPLACE(REPLACE(REPLACE(REPLACE(mobileno, ' ', ''), '-', ''), '(', ''), ')', '') LIKE '%$cleanQuery%'";
}

$sql .= ") LIMIT 50";

$result = mysqli_query($con, $sql);
$results = [];

while ($row = mysqli_fetch_array($result)) {
    $results[] = [
        "id" => $row["id"],
        "firstname" => $row["firstname"],
        "middlename" => $row["middlename"],
        "grandfathername" => $row["grandfathername"],
        "lastname" => $row["lastname"],
        "gender" => $row["gender"],
        "mobileno" => $row["mobileno"],
        "photo" => "https://www.panjoluni.com/mobile-app/img/profilephoto/" . ($row["photo"] ?: "placeholder.png")
    ];
}

echo json_encode(array("status" => "success", "results" => $results));
?>
