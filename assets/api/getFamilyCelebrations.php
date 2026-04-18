<?php

include("db_connect.php");

$db = new DB_connect();
$con = $db->connect();

$response = array();

$Family_ID = $_REQUEST['family_id'];

if ($Family_ID == "") {
    echo json_encode(array('success' => false, 'message' => 'family_id is required'));
    exit;
}

/*
|--------------------------------------------------------------------------
| FLEXIBLE DATE PARSER (same as your working API)
|--------------------------------------------------------------------------
*/
function parseFlexibleDate($dateStr) {
    if (empty($dateStr) || $dateStr == '0000-00-00' || strtolower($dateStr) == 'n.a.' || $dateStr == '-') return null;

    $val = trim($dateStr);

    $formats = ['d-m-Y', 'Y-m-d', 'd/m/Y', 'd-m'];
    foreach($formats as $f) {
        $d = DateTime::createFromFormat($f, $val);
        if ($d && (strpos($val, $d->format($f)) !== false || $d->format($f) == $val)) {
            return $d;
        }
    }

    if (preg_match('/(\d{1,2})[-\/](\d{1,2})[-\/](\d{2,4})/', $val, $matches)) {
        if (intval($matches[1]) <= 31) {
            $d = DateTime::createFromFormat('d-m-Y', sprintf('%02d-%02d-%d', $matches[1], $matches[2], $matches[3]));
            if ($d) return $d;
        } else {
            $d = DateTime::createFromFormat('Y-m-d', sprintf('%02d-%02d-%02d', $matches[1], $matches[2], $matches[3]));
            if ($d) return $d;
        }
    }

    return null;
}

/*
|--------------------------------------------------------------------------
| GET TODAY DAY + MONTH
|--------------------------------------------------------------------------
*/
$today = new DateTime();
$day = $today->format('d');
$month = $today->format('m');

/*
|--------------------------------------------------------------------------
| FETCH DATA (NO DATE FILTER HERE)
|--------------------------------------------------------------------------
*/
 $query = "
SELECT
    id,
    firstname,
    middlename,
    grandfathername,
    lastname,
    photo,
    relationshipwithmainperson,
    dateofbirth,
    anniversarydate,
    maritialstatus
FROM pp_profileinfo
WHERE familyid = '".$Family_ID."'
AND (status='on' OR status='On')
";

$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {

        $events = [];

        // Birthday
        $dBirth = parseFlexibleDate($row['dateofbirth']);
        if ($dBirth && $dBirth->format('d') == $day && $dBirth->format('m') == $month) {
            $events[] = "Birthday";
        }

        // Anniversary (only if married)
        $dAnni = parseFlexibleDate($row['anniversarydate']);
        if ($dAnni &&
            $dAnni->format('d') == $day &&
            $dAnni->format('m') == $month &&
            strtolower($row['maritialstatus']) == 'married'
        ) {
            $events[] = "Anniversary";
        }

        if (!empty($events)) {

            $name = trim(
                $row["firstname"] . " " .
                $row["middlename"] . " " .
                $row["grandfathername"] . " " .
                $row["lastname"]
            );

 $resPhoto='';
    if($row["photo"]!=""){
        $resPhoto=$row["photo"];
    }else{
        $resPhoto="placeholder.png";
    }

            $photo = "https://www.panjoluni.com/mobile-app/img/profilephoto/" . $resPhoto;

            foreach ($events as $event) {
                $response[] = array(
                    'id' => $row["id"],
                    'name' => $name,
                    'relation' => $row["relationshipwithmainperson"],
                    'type' => $event,
                    'image' => $photo
                );
            }
        }
    }
}

echo json_encode(array('success' => true, 'data' => $response));

?>