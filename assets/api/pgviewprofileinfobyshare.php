<?php 
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect();

$id=$_REQUEST["id"];
$qws="Select * from pp_profileinfo where id='".$id."'";	
$runii=mysqli_query($con,$qws);
$row=mysqli_fetch_array($runii);
if ($row["viewprofilecount"]!="")
{
	$viewprofilecount=$row["viewprofilecount"]+1;
}
else
{
	$viewprofilecount=1;
}

$qry2="update pp_profileinfo set viewprofilecount='".$viewprofilecount."' where id='".$id."'";
$run2=mysqli_query($con,$qry2); 
//echo $qws;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta property="og:image" content="https://www.fairlorry.com/luni/img/profilephoto/<?php echo $row['photo'];?>" />        
  <link rel="shortcut icon" href="img/favicon.png">
	<style>
		.mySlides {display:none;}
		@media screen and (max-width: 600px) {
			#login {
				visibility: hidden;
				display: none;
			}
			
			#mobile_menu {
				margin-left:80%;
				margin:15px;
			}
			
			#desktop_logo {
				visibility: hidden;
				display: none;
				width: 0px;
			}
			
			#mobile_logo {
				height:100%;
				margin-bottom: 15px;
			}
		}
		
		@media screen and (min-width: 600px) {
			
			#mobile_logo {
				visibility: hidden;
				display: none;
				height: 0px;
			}
		}
		#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  
  width: 100%;
}

#customers td, #customers th {
  
  padding: 8px;
}

#customers tr:hover {background-color: #ddd;}

#customers tr:hover {background-color: #ddd;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

#tbl_1 {
    width: 500px;
    float: left;
  
    margin-left: 20px;
}
 
#tbl_2 {
    width: 500px;
    float: right;
   
    margin-right: 20px;
}
 
	</style>
  <title>Profile of <?php echo ucfirst($row["firstname"])." ".ucfirst($row["middlename"])." ".ucfirst($row["lastname"]); ?> | Asanjo Dumra</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
<link rel="shortcut icon" href="../assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
<style>  
.footer-social {
  margin: 0 auto;
  text-align:center;
}

.footer-social a {
  width: 25px;
  height: 25px;
  margin: 0 6px;
  text-align: center;
  display: inline-block;
  color: #fff;
  border: 1px solid #111;
  border-radius: 2px;
  transform: rotate(45deg);
  line-height: 22px;
  box-shadow: 3px 3px #29adff;
  background-color:#111;		
}
.footer-social a i {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg);
}
/* hover */
.footer-social a:hover{
    color: #111;
}
.footer-social a:hover{
    background: #fff;
}
.flex-container{
	display: -webkit-flex; /* Safari */		
	display: flex; /* Standard syntax */
}
.flex-container .column{
	-webkit-flex: 1; /* Safari */
	-ms-flex: 1; /* IE 10 */
	flex: 1; /* Standard syntax */
}
.flex-container .column.bg-alt{
	
	
}
</style>  
<style>
	/* Extra small devices (phones, 600px and down) */
	@media only screen and (max-width: 600px) {
	  .sociallink {
			padding-left: 0px !important;
			padding-right: 0px!important;
			box-shadow: 3px 3px #29adff;
			background-color: #b7b4b4;	
	  }
	  .Pimg{
		  width:60px;
		  height:auto;
	  }
	  .head3{
		  margin-top:0px;
	  }
	}
	/* Medium devices (landscape tablets, 768px and up) */
	
	@media only screen and (min-width: 768px) {
	  .sociallink {
			padding-left: 0px !important;
			padding-right: 0px!important;
			box-shadow: 3px 3px #29adff;
			background-color: #b7b4b4;
	  }
	  .Pimg{
		  width:100px;
		  height:auto;
	  }
	  .head3{
		  margin-top:20px;
	  }
	} 
	h4,h5{font-weight: 500!important;}
	h1,h2,h3,h4,h5{color: #000!important;}
</style>
</head>

<body style="background-image: url('img/bg.jpg');">
  <!-- container section start -->
  <section id="container" class="">
	

    <section id="main-content" style="margin-left: 0px;">
      <section class="wrapper" style="margin-top: 10px;">
        <!--overview start-->
        
	<div class="container"  id="printableArea">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-12 col-xs-12" style="padding:20px;border-width: 10px;border-style: solid ;border-color: #003454;">
				<div class="row" style="box-shadow: 3px 3px #29adff;background-color: #b7b4b4;padding-top: 15px;padding-bottom: 15px;">
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3" style="padding-left:10px;padding-right:5px;">
						<?php 
							echo "<img class='Pimg' src='img/profilephoto/".$row['photo']."'>";
						?>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
						<div class="row" style="margin-left: 0px;margin-right: 0px;">
							
							<?php echo "<h3 class='head3' style='font-weight: 900;'>".ucfirst($row["firstname"])." ".ucfirst($row["middlename"])." ".ucfirst($row["lastname"])."</h3>" ;?>
							<?php if ($row["natureofwork"]!="") { echo $row["natureofwork"]; } ?>
							<?php if ($row["typeofbusiness"]!="") { echo " | ".$row["typeofbusiness"]; } ?>
						</div>
					</div>
				</div>
				<?php if ($row["displaycontactstatus"]=="yes") { ?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="padding-right: 0px;padding-left: 0px;">
						<div style="background-color: #d1e0ff;padding: 15px;">
						
						<?php if($row["mobileno"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="tel:<?php echo "+".$row["mobileno"];?>" title="Contact" target="_blank"><i class="fa fa-mobile"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<a href='tel:+".$row["mobileno"]."'><h4 style='margin-top: 0px;'>".$row["mobileno"]."</h4></a>"?>
							</div>
						</div>
						<?php }if($row["emailid"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="mailto:<?php echo $row["emailid"]?>" title="Email" target="_blank"><i class="fa fa-envelope-o"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<a href='mailto:".$row["emailid"]."' target='_blank'><h4 style='margin-top: 0px;'>".$row["emailid"]."</h4></a>"?>
							</div>
						</div>

						<?php } ?>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"style="padding-right: 0px;padding-left: 0px;">
						<div style="background-color: #d1e0ff;padding: 15px;">
						<?php if($row["nameofcompany"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a  title="Contact" target="_blank"><i class="fa fa-building"></i></a>
								</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<h4 style='margin-top: 0px;'>".$row["nameofcompany"]."</h4>";?>
							</div>
						</div>
						<?php }if($row["officephone"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="tel:<?php echo "+".$row["officephone"];?>" title="Contact" target="_blank"><i class="fa fa-mobile"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<a href='tel:+".$row["officephone"]."'><h4 style='margin-top: 0px;'>".$row["officephone"]."</h4></a>";?>
							</div>
						</div>
						<?php }if($row["officeemail"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="mailto:<?php echo $row["officeemail"]?>" title="Email" target="_blank"><i class="fa fa-envelope-o"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<a href='mailto:".$row["officeemail"]."' target='_blank'><h4 style='margin-top: 0px;'>".$row["officeemail"]."</h4></a>";?>
							</div>
						</div>
						<?php } if($row["officewebsite"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="http://<?php echo $row["officewebsite"];?>" title="Office website" target="_blank"><i class="fa fa-globe"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<a href='".$row["officewebsite"]."' target='_blank'><h4 style='margin-top: 0px;'>".$row["officewebsite"]."</h4></a>";?>
							</div>
						</div>
						<?php }if($row["officeaddress"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="#" title="Address"><i class="fa fa-map-marker"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<h4 style='margin-top: 0px;'>".$row["officeaddress"]."<br>".$row["officesuburb"].",".$row["officecity"]."<br>".$row["officestate"]."<br>Pincode - ".$row["officepincode"]."</h4>";?>
							</div>
						</div>
						<?php } if($row["businessdesp"]!=""){?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a  title="Info" target="_blank"><i class="fa fa-info"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<h4 style='margin-top: 0px;'>".$row["businessdesp"]."</h4>";?>
							</div>
						</div>
						<?php } ?>
						<?php if($row["displaycontactstatus"]=="yes") { ?>
						<br>
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
								<div class="footer-social">
									<a href="vcard.php?id=<?php echo $row["id"];?>" title="Contact" target="_blank"><i class="fa fa-floppy-o"></i></a>
									</div>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
								<?php echo "<a href='vcard.php?id=".$row["id"]."'><h4 style='margin-top: 0px;'>Add To Contact</h4></a>";?>
							</div>
						</div>
						<?php } ?>
						</div>
					</div>
				</div>
				<div class="row sociallink">
					
						<?php if($row["facebook"]!="" ||$row["twitter"]!="" ||$row["linkedin"]!="" ||$row["instagram"]!=""){?>
						<div class="footer-social" style="padding:15px;">
							<?php
							if($row["facebook"]!=""){
								if (strpos($row["facebook"],'http')>-1)
								{
									echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-bottom:20px;"><a href="'.$row["facebook"].'" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></div>';
								}
								else
								{
									echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-bottom:20px;"><a href="https://'.$row["facebook"].'" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></div>';
								}
							}if($row["twitter"]!=""){
								echo'<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-bottom:20px;"><a href="'.$row["twitter"].'" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></div>';
							}if($row["linkedin"]!=""){
								echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-bottom:20px;"><a href="'.$row["linkedin"].'" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></div>';
							}if($row["instagram"]!=""){
								echo'<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-bottom:20px;"><a href="'.$row["instagram"].'" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></div>';
							}
							?>
							
						</div>
						<?php } ?>
					
				</div>
				<br>
				
				
			</div>
			
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
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
} 
      
    </script>

</body>

</html>
