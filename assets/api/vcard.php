<?php
  include("db_connect.php");
  $db=new DB_Connect();
  $con=$db->connect();
  $id=$_GET["id"];
  $qws="Select * from pp_profileinfo where id='".$id."'";	
$runii=mysqli_query($con,$qws);
$row=mysqli_fetch_array($runii);
  // define here all the variable like $name,$image,$company_name & all other
  $image="img/profilephoto/".$row['photo']."";
  $company_name=$row["nameofcompany"];
  $email=$row["emailid"];
  $mobile_no=$row["mobileno"];
  $name=$row["firstname"]." ".$row["lastname"];
  $natureofwork=$row["natureofwork"];
  $officeemail=$row["officeemail"];
  $officephone=$row["officephone"];
  header('Content-Type: text/x-vcard');  
  header('Content-Disposition: inline; filename= "'.$name.'.vcf"');  

  if($image!=""){ 
    $getPhoto               = file_get_contents($image);
    $b64vcard               = base64_encode($getPhoto);
    $b64mline               = chunk_split($b64vcard,74,"\n");
    $b64final               = preg_replace('/(.+)/', ' $1', $b64mline);
    $photo                  = $b64final;
  }
  $vCard = "BEGIN:VCARD\r\n";
  $vCard .= "VERSION:3.0\r\n";
  $vCard .= "FN:" . $name . "\r\n";
  if($company_name!=""){
	$vCard .= "ORG:" . $company_name . "\r\n";  
  }
  if($natureofwork!=""){
	$vCard .= "TITLE:" . $natureofwork . "\r\n";  
  }
  
  
  

  if($email!=""){
    $vCard .= "EMAIL;TYPE=home:" . $email . "\r\n";
  }
  if($officeemail!=""){
    $vCard .= "EMAIL;TYPE=WORK:" . $officeemail . "\r\n";
  }
  if($getPhoto!=""){
    $vCard .= "PHOTO;ENCODING=b;TYPE=JPEG:";
    $vCard .= $photo . "\r\n";
  }

  if($mobile_no!=""){
    $vCard .= "TEL;TYPE=home,voice:" . $mobile_no . "\r\n"; 
  }
  if($officephone!=""){
    $vCard .= "TEL;TYPE=work:" . $officephone . "\r\n"; 
  }

  $vCard .= "END:VCARD\r\n";
  echo $vCard;

?>
