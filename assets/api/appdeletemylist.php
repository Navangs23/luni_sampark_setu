<?php
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	$qry="delete from pp_mylist where userid='".$_POST["userid"]."' and listid='".$_POST["id"]."'";	
	if(mysqli_query($con,$qry)){
			echo "Success";
		}
		else{
			echo "Error";
		}
?>