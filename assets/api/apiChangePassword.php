<?php
    include("db_connect.php");

    $db = new DB_connect();
    $con = $db->connect();

    $response = array();

    if (
        isset($_REQUEST['user_id']) &&
        isset($_REQUEST['current_password']) &&
        isset($_REQUEST['new_password'])
    ) {

        $user_id = $_REQUEST['user_id'];
        $current_password = md5($_REQUEST['current_password']);
        $new_password = md5($_REQUEST['new_password']);

        // 🔹 Check if new password is same as current password
        if ($current_password == $new_password) {

            $response["success"] = 0;
            $response["message"] = "New password cannot be same as current password";

        } else {

            // 🔹 Verify current password
            $qry = "SELECT id FROM pp_profileinfo 
                WHERE id='$user_id' AND password='$current_password'";

            $result = mysqli_query($con, $qry);

            if (mysqli_num_rows($result) > 0) {

                // 🔹 Update password
                $updateQry = "UPDATE pp_profileinfo 
                          SET password='$new_password' 
                          WHERE id='$user_id'";

                if (mysqli_query($con, $updateQry)) {

                    $response["success"] = 1;
                    $response["message"] = "Password updated successfully, Please Login Again.";

                } else {

                    $response["success"] = 0;
                    $response["message"] = "Failed to update password";

                }

            } else {

                $response["success"] = 0;
                $response["message"] = "Current password is incorrect";

            }

        }

    } else {

        $response["success"] = 0;
        $response["message"] = "Required fields are missing";

    }

    echo json_encode($response);
    exit();
?>