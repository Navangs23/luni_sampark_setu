<?php
    include("db_connect.php");
    $db = new DB_Connect();
    $con = $db->connect();

    $response = array();

    if (isset($_REQUEST['user_id'])) {
        $user_id = $_REQUEST['user_id'];
        
        $stmt = $con->prepare("SELECT photo FROM pp_profileinfo WHERE id=?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $profile_pic_filename = $row['photo'];
            
            $response['status'] = 'success';
            // Prepend the base URL to the filename stored in the DB
            $base_url = "https://panjoluni.com/mobile-app/img/profilephoto/";
            $response['profile_pic'] = (!empty($profile_pic_filename)) ? $base_url . $profile_pic_filename : "";
        } else {
            $response['status'] = 'error';
            $response['message'] = 'User not found';
        }
        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'User ID is required';
    }

    echo json_encode($response);
?>
