<?php

include("db_connect.php");

$db = new DB_connect();
$con = $db->connect();

// Array for JSON response
$response = array();

$Family_ID = $_REQUEST['family_id'];

if ($Family_ID == "") {
    $Family_ID = -1;
}

// Query
$query = "
SELECT
    id,
    firstname,
    middlename,
    grandfathername,
    lastname,
    photo,
    relationshipwithmainperson,
    gender,
    deceased
FROM pp_profileinfo
WHERE familyid = '".$Family_ID."'
AND (status='on' OR status='On')
ORDER BY FIELD(
    relationshipwithmainperson,
    'Self',
    'Wife',
    'Husband',
    'Father',
    'Mother',
    'Father-in-law',
    'Mother-in-law',
    'Son',
    'Daughter',
    'Brother',
    'Sister',
    'Daughter in Law',
    'Son in Law',
    'Grand son',
    'Grand daughter',
    'Niyani'
) ASC
";

$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {

    $name = $row["firstname"] . " " .
            $row["middlename"] . " " .
            $row["grandfathername"] . " " .
            $row["lastname"];

    $relation = $row["relationshipwithmainperson"];

    if ($row["deceased"] == "true") {
        $backcolor = "#eeeeee";
    } else {

        if ($row["gender"] == "Male") {
            $backcolor = "#bbdefb";
        }
        else if ($row["gender"] == "Female") {
            $backcolor = "#f8bbd0";
        }
        else {
            $backcolor = "#f0f4c3";
        }
    }

    $photo = "https://www.panjoluni.com/mobile-app/img/profilephoto/" .;

    array_push($response, array(
        'id' => $row["id"],
        'name' => $name,
        'relation' => $relation,
        'backcolor' => $backcolor,
        'image' => $photo
    ));
}

echo json_encode(array('response' => $response));

?>