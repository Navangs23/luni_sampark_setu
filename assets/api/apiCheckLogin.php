<?php
    include("db_connect.php");
    $db = new DB_connect();
    $con = $db->connect();

    $response = array();

    if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $password = md5($password);

        $qry = "SELECT status,familyid,firstname,lastname,id FROM pp_profileinfo WHERE mobileno='$username' and password='$password'";
        $result = mysqli_query($con, $qry);
        $row = mysqli_fetch_array($result);
        $status = $row['status'];
        $family_id = $row['familyid'];
        $name = ucfirst($row['firstname']) . " " . ucfirst($row['lastname']);
        $user_id = $row['id'];


        if ($status == "on") {
            $response["success"] = 1;
            $response["message"] = "Login Successful";
            $response["name"] = $name;
            $response["user_id"] = "" . $user_id;
            $response["family_id"] = "" . $family_id;
        } else {
            $response["success"] = 0;
            $response["message"] = "Credentials Mismatch";
            $response["name"] = "";
            $response["user_id"] = "";
            $response["family_id"] = "";
        }

    } else {
        $response["success"] = 0;
        $response["message"] = "Required Fields are missing";
        $response["name"] = "";
        $response["user_id"] = "";
        $response["family_id"] = "";
    }
    echo json_encode($response);
    exit();
