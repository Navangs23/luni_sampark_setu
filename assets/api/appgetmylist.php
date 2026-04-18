<?php
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect(); 

$userid=$_POST["userid"];
$Qwvs="Select * from pp_mylist where userid='".$userid."'";
$runs=mysqli_query($con,$Qwvs); //run qry 

$table="";
$i=0;
while($rows=mysqli_fetch_array($runs))
{
	
	$Qwvc="Select * from pp_profileinfo where id='".$rows["listid"]."'";
	$runc=mysqli_query($con,$Qwvc); //run qry 
	$row=mysqli_fetch_array($runc);
	$bg="";
	if ($row["bloodgroup"]!="")
	{
		$bg="| <i class='fa fa-tint' style='color:#f44336;'></i> ".$row["bloodgroup"];
	}
	$work="";
	if ($row["nameofcompany"]!="")
	{
		$work="Works at ".$row["nameofcompany"]." (".$row["typeofbusiness"].")";
	}
	$dob="";
	if ($row["dateofbirth"]!="")
	{
		$dob = new DateTime($row["dateofbirth"]);
		$dob = "<i class='fa fa-birthday-cake'></i> ".$dob->format('d/m/Y');
	}
	$userfa="";
	if ($row["gender"]=="Male")
	{
		$userfa="<i class='fa fa-male' style='color:#b2ebf2;'></i>";
	}
	else if($row["gender"]=="Female")
	{
		$userfa="<i class='fa fa-female' style='color:#f8bbd0;'></i>";
	}
	else
	{
		$userfa="<i class='fa fa-user' style='color:#ffffff;'></i>";
	}
	$mob_email;
	if ($row["mobileno"]!="")
	{
		$mob_email="<i class='fa fa-phone-square' style='color:#fff59d;'></i> <strong><a href='tel:".$row["mobileno"]."' style='color:#ffffff;'>".$row["mobileno"]."</a></strong>";
	}
	if ($row["emailid"]!="")
	{
		if($mob_email!="")
		{
			$mob_email=$mob_email." | ";
		}
		$mob_email=$mob_email."<i class='fa fa-envelope' style='color:#fff59d;'></i> <strong><a href='mailto:".$row["emailid"]."' style='color:#ffffff;'>".$row["emailid"]."</a></strong>";
	}
	
	
$table.="<div class='col-xs-12' style='padding-left:0px;padding-right:0px;'>
<div class='profile-widget profile-widget-info'>
<div class='panel-body' style='padding:5px;'>
<div class='col-lg-12'>
	<p style='text-align: right;'><text style='cursor: pointer;font-size: 12px;'  onclick='deletemylist(".$row["id"].")'><i class='fa fa-minus' aria-hidden='true'></i> Remove from my list</text></p>
</div>
<div class='col-xs-3' style='padding-left:0px;padding-right:5px;'>
<div class='follow-ava'>
<img src='img/profilephoto/".$row["photo"]."' style='height: 65px; width: 65px;'>
</div>
</div>
<div class='col-xs-9 follow-info' style='padding-top:10px;padding-left:10px;padding-right:5px;'>
<p style='margin-bottom:0px;'>".$userfa." <strong style='font-weight:bold;font-size:16px;'>".ucfirst($row["firstname"])." ".ucfirst($row["middlename"])." ".ucfirst($row["lastname"])."</strong></p>
<p style='font-size:10px;'>".$dob." ".$bg."</p>
<p style='font-size:10px;'><i class='fa fa-map-marker'></i> ".$row["residentalsuburb"].", ".$row["residentalcity"].", ".$row["residentalstate"]."</p>
</div>
<div class='col-xs-12 follow-info' style='padding-top:0px;padding-left:10px;padding-right:5px;'>
<p style='font-size:11px;'>".$mob_email."</p>
<p style='font-size:10px;'>".$work."</p>
</div>
<a href='appFamilyTree.php?member_id=".$row["id"]."&userid=".$userid."'>
<div class='col-xs-6 follow-info weather-category' style='padding-top:0;'>
<ul style='padding-bottom:0px;'>
<li class='active'><i class='fa fa-users fa-1x'></i> <font style='font-size:11px;'>Family Members</font></li>
</ul>
</div>
</a>
<a href='appViewProfile.php?id=".$row["id"]."&userid=".$userid."'>
<div class='col-xs-6 follow-info weather-category' style='padding-top:0px;'>
<ul style='padding-bottom:0px;'>
<li class='active'><i class='fa fa-eye fa-1x'></i> <font style='font-size:11px;'>View Profile</font></li>
</ul>
</div></a>
</div>
</div>
</div>
<hr style='margin-bottom:5px;margin-top:5px;'>";
$i++;
}
if ($i==0)
{
	$table.="No data found";
}
echo $table;

?>
