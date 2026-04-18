<?php
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	$userid=$_POST["userid"];
	$qry2="Select count(*) as cnt from pp_mylist where userid='".$userid."' and listid='".$_POST["id"]."'";
	//echo $qry2;
	$result2=mysqli_query($con,$qry2);
	$row2=mysqli_fetch_array($result2);
	if($row2["cnt"]>0){
		echo "Exist";
	}else if($_POST["id"]==""){
		echo "Id";
	}
	else{
		$qry="insert into pp_mylist(userid,listid) values('".$userid."','".$_POST["id"]."')";
		//echo $qry; 
		if(mysqli_query($con,$qry)){
			echo "Success";
		}
		else{
			echo "Error";
		}
	}
?>