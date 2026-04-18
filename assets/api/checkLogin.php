<?php
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	
	// array for JSON response
$response = array();
 
// check for required fields
if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
 
    
    $Username = $_REQUEST['username'];
	$Password = $_REQUEST['password'];
	//$fcm_id = $_REQUEST['fcm_id'];
	//$login_device = $_REQUEST['login_device'];

	$count = 0;
	
	$qry="select count(*) as Cnt from pp_otp where mobileno='".$Username."' and otp='".$Password."' ORDER BY id DESC LIMIT 1";
	//echo $qry;
	$run=mysqli_query($con,$qry);
	$row=mysqli_fetch_array($run);
	$rCnt = $row["Cnt"];
	if($rCnt==1){
		$userqry="select * from pp_profileinfo where mobileno='".$Username."'";
		$userrun=mysqli_query($con,$userqry);
		$userrow=mysqli_fetch_array($userrun);
		//$qry2="UPDATE pp_profileinfo SET otpcount='0',fcm_id='".$fcm_id."',login_device='".$login_device."' where mobileno='".$Username."'";
		$qry2="UPDATE pp_profileinfo SET otpcount=otpcount+1 where mobileno='".$Username."'";
		$run2=mysqli_query($con,$qry2);

		$qry_o="select status,familyid,firstname,lastname,id from pp_profileinfo where mobileno='".$Username."'";
		//echo $qry;
		$result_o = mysqli_query($con,$qry_o);
		$row_o = mysqli_fetch_array($result_o);
		$status = $row_o["status"];
		$family_id = $row_o["familyid"];
		$name = ucfirst($row_o["firstname"]) . " " .ucfirst($row_o["lastname"]);
		$user_id = $row_o["id"];
		//echo $count;
		if ($status=="on"){	
			$qry2="delete from pp_otp where mobileno='".$Username."'";
			$run2=mysqli_query($con,$qry2);
			
			$response["success"] = 1;
        	$response["message"] = "Login Successful. Welcome ".$name;
        	$response["name"] = $name;
        	$response["user_id"] = "".$user_id;
        	$response["family_id"] = "".$family_id;
			echo json_encode($response);
		}
		else if($status=="off"){	
			$response["success"] = 0;
        	$response["message"] = "Account blocked. Please contact Admin.";
			$response["name"] = "";
			$response["user_id"] = "";
			$response["family_id"] = "";
			echo json_encode($response);
        	// failed to insert row
    		}
			
		else {
			// required field is missing
			$response["success"] = 0;
			$response["message"] = "Invalid user details, please contact Admin";
			$response["name"] = "";
			$response["user_id"] = "";
			$response["family_id"] = "";
			// echoing JSON response
			echo json_encode($response);
		}
	}
	else{
		// required field is missing
			$response["success"] = 0;
			$response["message"] = "Invalid OTP, try again";
			$response["name"] = "";
			$response["user_id"] = "";
			$response["family_id"] = "";
			// echoing JSON response
			echo json_encode($response);
	}
	
	
	
		
	}
	else {
		// required field is missing
		$response["success"] = 0;
		$response["message"] = "Required field(s) is missing.";
		$response["name"] = "";
		$response["user_id"] = "";
		$response["family_id"] = "";
		// echoing JSON response
		echo json_encode($response);
	} 
		

 
?>