<?php
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect();
//whether ip is from share internet
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	}
	//whether ip is from proxy
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  {
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	//whether ip is from remote address
	else{
		$ip_address = $_SERVER['REMOTE_ADDR'];
	}
	date_default_timezone_set("Asia/Kolkata");
	$date=date("Y-m-d h:i:sa");
$id=$_POST["id"];
$firstname=$_POST["firstname"];
$middlename=$_POST["middlename"];
$grandfathername=$_POST["grandfathername"];
$lastname=$_POST["lastname"];
$gender=$_POST["gender"];
$dateofbirth=$_POST["dateofbirth"];
$maritialstatus=$_POST["maritialstatus"];
$anniversarydate=$_POST["anniversarydate"];
$eligibleformarriage=$_POST["eligibleformarriage"];
$photo=$_POST["photo"];
$bloodgroup=$_POST["bloodgroup"];
$relationshipwithmainperson=$_POST["relationshipwithmainperson"];
$deceased=$_POST["deceased"];
if($deceased=="true"){
	$dateofdeathanniversary=$_POST["dateofdeathanniversary"];	
}else{
	$dateofdeathanniversary="";
}
$mobileno=$_POST["mobileno"];
$emailid=$_POST["emailid"];
$alternativemobileno=$_POST["alternativemobileno"];
$displaycontactdetails=$_POST["displaycontactdetails"];
$educationqualification=$_POST["educationqualification"];
$otherachivements=$_POST["otherachivements"];
$residentaladdress=$_POST["residentaladdress"];
$residentalsuburb=$_POST["residentalsuburb"];
$residentalpincode=$_POST["residentalpincode"];
$residentalcity=$_POST["residentalcity"];
$residentalstate=$_POST["residentalstate"];
$residentalcountry=$_POST["residentalcountry"];
$residentalphone=$_POST["residentalphone"];
$sampraday=$_POST["sampraday"];
$subreligion=$_POST["subreligion"];
$subsubreligion=$_POST["subsubreligion"];
$ismember=$_POST["ismember"];
$natureofwork=$_POST["natureofwork"];
$nameofcompany=$_POST["nameofcompany"];
$typeofbusiness=$_POST["typeofbusiness"];
$businessdesp=$_POST["businessdesp"];
$officeaddress=$_POST["officeaddress"];
$officesuburb=$_POST["officesuburb"];
$officepincode=$_POST["officepincode"];
$officecity=$_POST["officecity"];
$officestate=$_POST["officestate"];
$officecountry=$_POST["officecountry"];
$officephone=$_POST["officephone"];
$officeemail=$_POST["officeemail"];
$officewebsite=$_POST["officewebsite"];	
$mediclaimpolicy=$_POST["mediclaimpolicy"]; 
$mediclaimtype=$_POST["mediclaimtype"];
$facebook=$_POST["facebook"];
$twitter=$_POST["twitter"];
$linkedin=$_POST["linkedin"];
$instagram=$_POST["instagram"];
$sqcnt=0;
	$mobcheck=0;
	if ($relationshipwithmainperson!="Self" && strlen($mobileno)>0)
	{
		if (strtolower($residentalcountry)=="india")
		{
			if (strlen($mobileno)!=10)
			{
				$mobcheck=1;
			}
			else
			{
				$mobcheck=0;
			}
		}
		else
		{
			$mobcheck=0;
		}
	}
	else
	{
		$mobcheck=0;
	}
if ($relationshipwithmainperson=="Self")
{
$selfcheckqry="select count(*) as cnt from pp_profileinfo where relationshipwithmainperson='Self' and id!='".$id."' and familyid=(select familyid from pp_profileinfo where id='".$id."')";
$sqrun=mysqli_query($con,$selfcheckqry);
$sqrow=mysqli_fetch_array($sqrun);
$sqcnt=$sqrow["cnt"];
}

$mobqry1="select * from pp_profileinfo where id='".$id."'";
$mobrun1=mysqli_query($con,$mobqry1);
$mobrow1=mysqli_fetch_array($mobrun1);
$mobrow1["photo"];
 
	if ($sqcnt>0)
	{
		echo "self";
	}
	else if($firstname=="")
	{
		echo "firstname";
	}
	else if($middlename=="")
	{
		echo "middlename";
	}
	else if($grandfathername=="")
	{
		echo "grandfathername";
	}
	else if($lastname=="")
	{
		echo "lastname";
	}
	else if($dateofbirth=="")
	{
		echo "dateofbirth";
	}
	else if($gender=="")
	{
		echo "gender";
	}
	else if($maritialstatus=="")
	{
		echo "maritialstatus";
	}
	else if($bloodgroup=="")
	{
		echo "bloodgroup";
	}
	else if($relationshipwithmainperson=="")
	{
		echo "relationshipwithmainperson";
	}
	else if($mobileno=="" && $relationshipwithmainperson=="Self")
	{
		echo "mobileno";
	}
	else if($mobcheck==1)
	{
		echo "invalidmobile";
	}
	else if($residentaladdress=="")
	{
		echo "residentaladdress";
	}
	else if($residentalsuburb=="")
	{
		echo "residentalsuburb";
	}
	else if($residentalpincode=="")
	{
		echo "residentalpincode";
	}
	else if($residentalcity=="")
	{
		echo "residentalcity";
	}
	else if($residentalstate=="")
	{
		echo "residentalstate";
	}
	else if($residentalcountry=="")
	{
		echo "residentalcountry";
	}
	else if($sampraday=="")
	{
		echo "sampraday";
	}
	else if($subreligion=="")
	{
		echo "subreligion";
	}
	else if($subsubreligion=="")
	{
		echo "subsubreligion";
	}
	else if($ismember=="")
	{
		echo "ismember";
	}
	else if($natureofwork=="")
	{
		echo "natureofwork";
	}
	else if($mediclaimpolicy=="")
	{
		echo "mediclaimpolicy";
	}
else if($photo=="")
{
	if($mobrow1["photo"]=="no_user.png"){
			echo "photo";
	}
	else{
		
	
	
	
	$rCountN=0;
	if($mobileno!="")
	{
		$Qwf="Select count(*) as Cnt from pp_profileinfo where mobileno='".$mobileno."' and id!='".$id."'";
		$runi=mysqli_query($con,$Qwf); //run qry 
		$row=mysqli_fetch_array($runi);
		//echo $Qwf; //fetch data  
		$rCountN=$row["Cnt"];
	}
	if($rCountN>0){
		echo "mobileexist";
	}else{
		$QWE="update pp_profileinfo set firstname='".$firstname."',middlename='".$middlename."',grandfathername='".$grandfathername."',lastname='".$lastname."',dateofbirth='".$dateofbirth."',bloodgroup='".$bloodgroup."',gender='".$gender."',deceased='".$deceased."',dateofdeathanniversary='".$dateofdeathanniversary."',educationqualification='".$educationqualification."',otherachivements='".$otherachivements."',residentaladdress='".$residentaladdress."',residentalsuburb='".$residentalsuburb."',residentalcity='".$residentalcity."',residentalpincode='".$residentalpincode."',residentalstate='".$residentalstate."',residentalcountry='".$residentalcountry."',residentalphone='".$residentalphone."',sampraday='".$sampraday."',subreligion='".$subreligion."',subsubreligion='".$subsubreligion."',ismember='".$ismember."',emailid='".$emailid."',mobileno='".$mobileno."',maritialstatus='".$maritialstatus."',anniversarydate='".$anniversarydate."',eligibleformarriage='".$eligibleformarriage."',natureofwork='".$natureofwork."',nameofcompany='".$nameofcompany."',typeofbusiness='".$typeofbusiness."',officesuburb='".$officesuburb."',officeaddress='".$officeaddress."',officecity='".$officecity."',officepincode='".$officepincode."',officestate='".$officestate."',officecountry='".$officecountry."',officephone='".$officephone."',officeemail='".$officeemail."',officewebsite='".$officewebsite."',alternativemobileno='".$alternativemobileno."',displaycontactstatus='".$displaycontactdetails."',relationshipwithmainperson='".$relationshipwithmainperson."',mediclaimpolicy='".$mediclaimpolicy."',mediclaimtype='".$mediclaimtype."',facebook='".$facebook."',twitter='".$twitter."',linkedin='".$linkedin."',instagram='".$instagram."',modifiedby='".$id."',modifiedon='".$date."',modifiedip='".$ip_address."',businessdesp='".$businessdesp."' where id='".$id."'";
		if($run=mysqli_query($con,$QWE)){
			//echo $QWE;
			echo "Success";
		}else{
		//echo "asd";
			echo "error-".$QWE;
		}
	
	}
		
	}
		
		
}
/*else if($adharno=="")
{
	echo "adharno";
}*/

/* else if($relationshipwithmainperson=="")
{
	echo "relationshipwithmainperson";
} */

else{
	if($photo!="")
	{
		/* $file = $_FILES['photo']['name'];
		$file = str_replace(' ', '', $file);
		$file=date("dmYhis").'_'.$file;
		move_uploaded_file($_FILES['photo']['tmp_name'],"img/profilephoto/".$file); */
		$QWF="update pp_profileinfo set photo='".$_POST["photo"]."' where id='".$id."'";
		if($runi=mysqli_query($con,$QWF)){
		}else{
		}
	}
	
	
	
	$rCountN=0;
	if($mobileno!="")
	{
		$Qwf="Select count(*) as Cnt from pp_profileinfo where mobileno='".$mobileno."' and id!='".$id."'";
		$runi=mysqli_query($con,$Qwf); //run qry 
		$row=mysqli_fetch_array($runi);
		//echo $Qwf; //fetch data  
		$rCountN=$row["Cnt"];
	}
	if($rCountN>0){
		echo "mobileexist";
	}else{
		$QWE="update pp_profileinfo set firstname='".$firstname."',middlename='".$middlename."',grandfathername='".$grandfathername."',lastname='".$lastname."',dateofbirth='".$dateofbirth."',bloodgroup='".$bloodgroup."',gender='".$gender."',deceased='".$deceased."',dateofdeathanniversary='".$dateofdeathanniversary."',educationqualification='".$educationqualification."',otherachivements='".$otherachivements."',residentaladdress='".$residentaladdress."',residentalsuburb='".$residentalsuburb."',residentalcity='".$residentalcity."',residentalpincode='".$residentalpincode."',residentalstate='".$residentalstate."',residentalcountry='".$residentalcountry."',residentalphone='".$residentalphone."',sampraday='".$sampraday."',subreligion='".$subreligion."',subsubreligion='".$subsubreligion."',ismember='".$ismember."',emailid='".$emailid."',mobileno='".$mobileno."',maritialstatus='".$maritialstatus."',anniversarydate='".$anniversarydate."',eligibleformarriage='".$eligibleformarriage."',natureofwork='".$natureofwork."',nameofcompany='".$nameofcompany."',typeofbusiness='".$typeofbusiness."',officesuburb='".$officesuburb."',officeaddress='".$officeaddress."',officecity='".$officecity."',officepincode='".$officepincode."',officestate='".$officestate."',officecountry='".$officecountry."',officephone='".$officephone."',officeemail='".$officeemail."',officewebsite='".$officewebsite."',alternativemobileno='".$alternativemobileno."',displaycontactstatus='".$displaycontactdetails."',relationshipwithmainperson='".$relationshipwithmainperson."',mediclaimpolicy='".$mediclaimpolicy."',mediclaimtype='".$mediclaimtype."',facebook='".$facebook."',twitter='".$twitter."',linkedin='".$linkedin."',instagram='".$instagram."',modifiedby='".$id."',modifiedon='".$date."',modifiedip='".$ip_address."',businessdesp='".$businessdesp."' where id='".$id."'";
		if($run=mysqli_query($con,$QWE)){
			//echo $QWE;
			echo "Success";
		}else{
		//echo "asd";
			echo "error-".$QWE;
		}
	
	}
}
	
?>