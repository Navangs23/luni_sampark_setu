<?php

session_start();
//error_reporting(E_ALL);
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
//lightgrey=key comes from previous page;

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
$typeofbusiness1=$_POST["typeofbusiness"];
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
$status="on";
$famidqry="select familyid from pp_profileinfo where id='".$id."'";
$famidrun=mysqli_query($con,$famidqry);
$famidrow=mysqli_fetch_array($famidrun);
$familyid=$famidrow["familyid"];
$password="12345";

if($mobileno!="")
{
$mobqry="select count(*)as cnt from pp_profileinfo where mobileno='".$mobileno."'";
$mobrun=mysqli_query($con,$mobqry);
$mobrow=mysqli_fetch_array($mobrun);
}
	//light grey=database and blue=upper;
	
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
	
	if($firstname=="")
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
	else if($mobcheck==1)
	{
		echo "invalidmobile";
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
	else if($mobrow["cnt"]>0 && $mobileno!="")
	{
		echo "existmobile";
	}
	else if($_POST["photo"]==""){
			echo "photo";
	}
	else{
		/* $file = $_FILES['photo']['name'];
		$file = str_replace(' ', '', $file);
		$file=date("dmYhis").'_'.$file;
		move_uploaded_file($_FILES['photo']['tmp_name'],"img/profilephoto/".$file); */
		//----------------------
		/*$uploadedFile = $_FILES['photo']['tmp_name']; 
        $sourceProperties = getimagesize($uploadedFile);
        $newFileName = date("dmYhis").'_'.$uploadedFile;
        $dirPath = "img/profilephoto/";
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
		$ext = strtolower($ext);

        switch ($ext) {


            case "png":
                $imageSrc = imagecreatefrompng($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagepng($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;			

            case "jpg":
                $imageSrc = imagecreatefromjpeg($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;
			case "jpeg":
                $imageSrc = imagecreatefromjpeg($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;
            
            case "gif":
                $imageSrc = imagecreatefromgif($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagegif($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;

            default:
                echo $imageType."---imagetype";
                exit;
                break;
        }


        move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext);*/
		//------------------------
		
		//$file = str_replace(' ', '', $file);
		//$file=date("dmYhis").'_'.$file;
		//move_uploaded_file($_FILES['photo']['tmp_name'],"img/profilephoto/".$file);
		
		
		/* $filei = $_FILES['aadharphoto']['name'];
		$filei = str_replace(' ', '', $filei);
		$filei=date("dmYhis").'_'.$filei;
		move_uploaded_file($_FILES['aadharphoto']['tmp_name'],"img/profilephoto/".$filei); */
	$notificationstatus="true";
$QWE="insert into pp_profileinfo(firstname,middlename,grandfathername,lastname,dateofbirth,bloodgroup,gender,deceased,dateofdeathanniversary,educationqualification,otherachivements,residentaladdress,residentalsuburb,residentalcity,residentalpincode,residentalstate,residentalcountry,residentalphone,sampraday,subreligion,subsubreligion,ismember,displaycontactstatus,emailid,mobileno,maritialstatus,anniversarydate,eligibleformarriage,natureofwork,nameofcompany,typeofbusiness,businessdesp,officesuburb,officeaddress,officecity,officepincode,officestate,officecountry,officephone,officeemail,officewebsite,mediclaimpolicy,mediclaimtype,alternativemobileno,photo,relationshipwithmainperson,facebook,twitter,linkedin,instagram,status,createdby,createdon,createdip,familyid,notificationstatus) values('".$firstname."','".$middlename."','".$grandfathername."','".$lastname."','".$dateofbirth."','".$bloodgroup."','".$gender."','".$deceased."','".$dateofdeathanniversary."','".$educationqualification."','".$otherachivements."','".$residentaladdress."','".$residentalsuburb."','".$residentalcity."','".$residentalpincode."','".$residentalstate."','".$residentalcountry."','".$residentalphone."','".$sampraday."','".$subreligion."','".$subsubreligion."','".$ismember."','".$displaycontactdetails."','".$emailid."','".$mobileno."','".$maritialstatus."','".$anniversarydate."','".$eligibleformarriage."','".$natureofwork."','".$nameofcompany."','".$typeofbusiness1."','".$businessdesp."','".$officesuburb."','".$officeaddress."','".$officecity."','".$officepincode."','".$officestate."','".$officecountry."','".$officephone."','".$officeemail."','".$officewebsite."','".$mediclaimpolicy."','".$mediclaimtype."','".$alternativemobileno."','".$_POST["photo"]."','".$relationshipwithmainperson."','".$facebook."','".$twitter."','".$linkedin."','".$instagram."','".$status."','".$id."','".$date."','".$ip_address."','".$familyid."','".$notificationstatus."')";

 if($run=mysqli_query($con,$QWE)){
			
			echo "success";
}else{
		//echo "asd";
		
			echo "error - " . $QWE;
}	
}


function imageResize($imageSrc,$imageWidth,$imageHeight) {
	
	$ratio_orig = 0;
	$newImageWidth=1000;
	$newImageHeight=1000;
	if ($imageWidth>$imageHeight)
	{
		$ratio_orig = $imageWidth/$imageHeight;
		$newImageWidth =1000;
		$newImageHeight =$newImageWidth/$ratio_orig;
	}
	else
	{
		$ratio_orig = $imageHeight/$imageWidth;
		$newImageHeight =1000;
		$newImageWidth =$newImageHeight/$ratio_orig;
	}

    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
}

?>