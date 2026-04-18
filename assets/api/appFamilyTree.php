<?php
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	
	$member_id=$_REQUEST["member_id"];
	$userid=$_REQUEST["userid"];
	
	$Qwv="";
	$qws="Select familyid,firstname,middlename,lastname,createdby from pp_profileinfo where id='".$member_id."'";	
	$runii=mysqli_query($con,$qws);
	$rowt=mysqli_fetch_array($runii);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
<style>
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  .adsimg {
		width:100%;
		height:100px;	
  }
}
/* Medium devices (landscape tablets, 768px and up) */

@media only screen and (min-width: 768px) {
  .adsimg {
		 display: block;
		margin: 0 auto;
		width:500px;
		height:auto;	
  }
} 
</style>
</head>

<body style="background: #FAFAFAFF;">
  <!-- container section start -->
  <section id="container" class="">
    <section id="main-content">
      <section class="wrapper" style="margin-top:0px !important;">

		
		<div class="row">
          <div class="col-lg-12">
            <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden;">
              <!-- Accent Bar -->
              <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>
              <div class="panel-body" id="disp_search_result" style="border:none; background:transparent;">
				<h3>Family Members of <?php echo ucfirst($rowt["firstname"]); ?> <?php echo ucfirst($rowt["middlename"]); ?> <?php echo ucfirst($rowt["lastname"]); ?> </h3>
				<hr>
				
				<?php
					$Qwv="Select id,firstname, middlename, grandfathername, lastname, emailid, mobileno,photo,relationshipwithmainperson,gender from pp_profileinfo where  deceased!='true' and status='on' and familyid='".$rowt["familyid"]."' order by FIELD(relationshipwithmainperson,'Self','Wife','Husband','Father','Mother','Father-in-law','Mother-in-law','Son','Daughter','Brother','Sister','Daughter in Law','Son in Law','Grand son','Grand daughter','Niyani') asc";

					$runi=mysqli_query($con,$Qwv); //run qry 
					
					$table="";
					$i=0;
					
					while($row=mysqli_fetch_array($runi))
					{
						$gradient = "";
						$accent = "";
						$userfa = "";

						if ($row["gender"] == "Female") {
							$gradient = "linear-gradient(180deg,#fff7fa 0%,#fdecef 100%)";
							$accent   = "#f48fb1";
							$userfa   = "<i class='fa fa-female' style='color:#F06292;'></i>";
						} else {
							// Default to Male/Blue if not female
							$gradient = "linear-gradient(180deg,#f4f9ff 0%,#e8f2fb 100%)";
							$accent   = "#90caf9";
							$userfa   = "<i class='fa fa-male' style='color:#269CD8;'></i>"; 
							if($row["gender"] != "Male") {
                                $userfa   = "<i class='fa fa-user' style='color:#78909c;'></i>";
                            }
						}

					$table.="<div class='col-lg-12'>
					<div style='background:".$gradient.";border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden;'>
                        <!-- Accent Bar -->
                        <div style='position:absolute;left:0;top:0;bottom:0;width:4px;background:".$accent.";'></div>
					
					<div style='display:flex;align-items:flex-start;'>
					
					<div style='margin-right:12px;'>
					<img src='img/profilephoto/".$row["photo"]."' style='height: 80px; width: 80px; border-radius:50%; object-fit:cover;'>
					</div>
					
					<div style='flex:1;'>
					<div style='font-size:15px;font-weight:600;color:#263238;margin-bottom:3px;'>
                        ".$userfa." ".ucfirst($row["firstname"])." ".ucfirst($row["middlename"])." ".ucfirst($row["grandfathername"])." ".ucfirst($row["lastname"])."
                    </div>";
					
					if($row["emailid"]!="")
					{
						$table.="<div style='font-size:12px;margin-bottom:2px;'><i class='fa fa-envelope' style='color:#455a64;'></i> <a href='mailto:".$row["emailid"]."' style='color:#455a64;text-decoration:none;'>".$row["emailid"]."</a></div>";
					}
					if($row["mobileno"]!="")
					{
						$table.="<div style='font-size:12px;margin-bottom:2px;'><i class='fa fa-mobile' style='color:#455a64;'></i> <a href='tel:".$row["mobileno"]."' style='color:#455a64;text-decoration:none;'>".$row["mobileno"]."</a></div>";
					}
					$table.="<div style='font-size:12px;color:#546e7a;font-weight:bold;margin-top:4px;'>Relation: ".$row["relationshipwithmainperson"]."</div>
					</div>
					
					<div>
					    <a href='appViewProfile.php?id=".$row["id"]."&userid=".$userid."' style='color:#455a64;text-decoration:none;font-size:12px;font-weight:600;'>
                            <i class='fa fa-eye fa-lg'></i> View
                        </a>
					</div>
					</div>
					</div>
					</div>";
					$i++;
					}
					
					
					$Qwv="Select id,firstname, middlename, grandfathername, lastname, emailid, mobileno,photo,relationshipwithmainperson,gender from pp_profileinfo where  deceased='true' and status='on' and familyid='".$rowt["familyid"]."' order by FIELD(relationshipwithmainperson,'Self','Wife','Husband','Father','Mother','Father-in-law','Mother-in-law','Son','Daughter','Brother','Sister','Daughter in Law','Son in Law','Grand son','Grand daughter','Niyani') asc";
					
					$runi=mysqli_query($con,$Qwv); //run qry 
					while($row=mysqli_fetch_array($runi))
					{
						$userfa="";
						if ($row["gender"]=="Male")
						{
							$userfa="<i class='fa fa-male' style='color:#9e9e9e;'></i>";
						}
						else if($row["gender"]=="Female")
						{
							$userfa="<i class='fa fa-female' style='color:#9e9e9e;'></i>";
						}
						else
						{
							$userfa="<i class='fa fa-user' style='color:#9e9e9e;'></i>";
						}
					$table.="<div class='col-lg-12'>
					<div style='background:#f5f5f5;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:none;border:1px solid #e0e0e0;position:relative;overflow:hidden;'>
                         <!-- Accent Bar -->
                        <div style='position:absolute;left:0;top:0;bottom:0;width:4px;background:#bdbdbd;'></div>
					
					<div style='display:flex;align-items:flex-start;'>
					
					<div style='margin-right:12px;'>
					<img src='img/profilephoto/".$row["photo"]."' style='height: 80px; width: 80px; border-radius:50%; object-fit:cover; filter:grayscale(100%);'>
					</div>
					
					<div style='flex:1;'>
					<div style='font-size:15px;font-weight:600;color:#616161;margin-bottom:3px;'>
                        ".$userfa." ".ucfirst($row["firstname"])." ".ucfirst($row["middlename"])." ".ucfirst($row["grandfathername"])." ".ucfirst($row["lastname"])." (Deceased)
                    </div>";
					if($row["emailid"]!="")
					{
						$table.="<div style='font-size:12px;margin-bottom:2px;'><i class='fa fa-envelope' style='color:#757575;'></i> <a href='mailto:".$row["emailid"]."' style='color:#757575;text-decoration:none;'>".$row["emailid"]."</a></div>";
					}
					if($row["mobileno"]!="")
					{
						$table.="<div style='font-size:12px;margin-bottom:2px;'><i class='fa fa-mobile' style='color:#757575;'></i> <a href='tel:".$row["mobileno"]."' style='color:#757575;text-decoration:none;'>".$row["mobileno"]."</a></div>";
					}
					$table.="<div style='font-size:12px;color:#757575;font-weight:bold;margin-top:4px;'>Relation: ".$row["relationshipwithmainperson"]."</div>
					</div>
					
					<div>
					    <a href='appViewProfile.php?id=".$row["id"]."&userid=".$userid."' style='color:#757575;text-decoration:none;font-size:12px;font-weight:600;'>
                            <i class='fa fa-eye fa-lg'></i> View
                        </a>
					</div>
					</div>
					</div>
					</div>";
					$i++;
					}
					if ($i==0)
					{
						$table.="No record found";
					}
					echo $table;
				?>
			  </div>
			</section>
		  </div>
		</div>
		</section>
		</section>
		
		
	</section>
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>

</body>

</html>
