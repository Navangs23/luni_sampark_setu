<?php 
include("db_connect.php");
$db=new DB_Connect();
$con=$db->connect();
$userid=$_REQUEST["userid"];
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

<body>
  <!-- container section start -->
  <section id="container" class="">
	
    <section id="main-content">
      <section class="wrapper" style="margin-top:0px !important;margin-bottom: 10px;">
        <input type="hidden" id="hdnID" value="<?php echo $userid; ?>">
		
		<div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body" id="disp_search_result">
			  

			  </div>
			</section>
		  </div>
		</div>
		
		</section>
		</section>
		
		
	</section>
 <!-- javascripts -->
  <!--<script src="js/jquery.js"></script>-->
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery.form.js"></script>
  
  <script src="js/jquery-ui-1.10.4.min.js"></script>
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
    <script src="js/gdp-data.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <!-- jquery validate js -->
  <!--<script type="text/javascript" src="js/jquery.validate.min.js"></script>

  <script src="js/form-validation-script.js"></script>-->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		showData();
	});
	
    function showData()
	{
		$.ajax({
			type:"POST",
			url:"appgetmylist.php",
			data:{userid:$("#hdnID").val()},
			success:function(response)
			{
				//console.log(response);
				$("#disp_search_result").html(response);

			}
		});
		
	}
	
	

    function deletemylist(id){
		
			$.ajax({
				type:"POST",
				url:"appdeletemylist.php",
				data:{id:id,userid:$("#hdnID").val()},
				success:function(response){
					//console.log(response);
					if($.trim(response)=="Success"){
						alert("User remove from My List.");
						showData();
						
					}else if($.trim(response)=="Id"){
						alert("Some error raised, ID not found");
						
					}else{
						alert("Some error raised");
					}
				}
			});
		
		
	}  
    </script>

</body>

</html>
