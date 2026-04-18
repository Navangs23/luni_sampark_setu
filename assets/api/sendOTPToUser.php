<?php
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();

	// array for JSON response
$response = array();

// check for required fields
if (isset($_REQUEST['username'])) {


    $mobileno = $_REQUEST['username'];

	$qry="select count(*) as Cnt,status from pp_profileinfo where mobileno='".$mobileno."' and status='on'";
	//echo $qry;
	$run=mysqli_query($con,$qry);
	$row=mysqli_fetch_array($run);
	$userqry="select otpcount from pp_profileinfo where mobileno='".$mobileno."'";
	$userrun=mysqli_query($con,$userqry);
	$userrow=mysqli_fetch_array($userrun);

	if($row["Cnt"]==1 && $row["status"]=="on"){
		$qryi="select count(*) as Cnti from pp_otp where mobileno='".$mobileno."'";
		$runi=mysqli_query($con,$qryi);
		$rowi=mysqli_fetch_array($runi);
		if($rowi["Cnti"]!=0){
			$qryii="delete from pp_otp where mobileno='".$mobileno."'";
			//echo $qry;
			$runii=mysqli_query($con,$qryii);
		}
		$otp=rand(100000,999999);
		$otp="123456";
		//$message="Your OTP To Login On avjsm.in is ".$otp.". NEVER SHARE YOUR OTP WITH ANYONE.";
		//$message="OTP to login into your KJM App account is:".$otp;
		//$message="Your OTP To Login on AVJSM App is ".$otp.". Never share your OTP with anyone.%0aTeam SAVJSM";
		//$sms_content=$message;
		//$sms_content=str_replace(" ","%20",$sms_content);
		//
		////$url = "http://mobicomm.dove-sms.com//submitsms.jsp?user=ChhotaB&key=c98597d7c4XX&mobile=+91".$mobileno."&message=".$sms_content."&senderid=CLNEXT&accusage=1";
		//$url="http://optin.bmscomputers.com/api/web2sms.php?workingkey=A233ed8fa617c11fbf4c75c37a54b9bbc&sender=SAVJSM&to=91".$mobileno."&message=".$sms_content."";
		////echo $url;
		//$curl = curl_init();
		//curl_setopt($curl, CURLOPT_URL, $url);
		//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($curl, CURLOPT_HEADER, false);
		//$data = curl_exec($curl);
		//curl_close($curl);

		$qryiii="insert into pp_otp (mobileno,otp)values('".$mobileno."','".$otp."')";
		//echo $qry;
		if($runiii=mysqli_query($con,$qryiii)){


			$count=$userrow["otpcount"]+1;
			$qry2="UPDATE pp_profileinfo SET otpcount='".$count."' where mobileno='".$mobileno."'";
			$run2=mysqli_query($con,$qry2);
			//echo $otp;
			$response["success"] = 1;
        	$response["message"] = "OTP sent successfully on ".$mobileno;
			echo json_encode($response);

		}else{
			$response["success"] = 0;
        	$response["message"] = "Sorry, query error raised";
			echo json_encode($response);
		}
	}
	else if($row["Cnt"]==1 && $row["status"]!="on"){
			$response["success"] = 0;
        	$response["message"] = "Status disabled, please contact Admin";
			echo json_encode($response);
	}
	else{
			$response["success"] = 0;
        	$response["message"] = "Sorry, invalid mobile number. Please contact admin";
			echo json_encode($response);
	}

	}
		else {
			$response["success"] = 0;
			$response["message"] = "Mobile number is missing.";
			echo json_encode($response);
		}



?>