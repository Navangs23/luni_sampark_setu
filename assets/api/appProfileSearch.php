<?php
    include("db_connect.php");
    $db = new DB_Connect();
    $con = $db->connect();
    $userid = $_REQUEST["user_id"];
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- scripts will be loaded at the bottom -->

    <style>
        .form-control {
            font-size: 11px !important;
            padding: 0px 5px;
        }
    </style>
    <style>
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .adsimg {
                width: 100%;
                height: 100px;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */

        @media only screen and (min-width: 768px) {
            .adsimg {
                display: block;
                margin: 0 auto;
                width: 500px;
                height: auto;
            }
        }

    </style>
</head>

<body style="background: #FAFAFAFF;">
<!-- Modal Mobile-->
<div class="modal fade" id="myModalCopy" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="background-color:#688a7e;">
                <div class="container">
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-12">
                            <div class="form-group"><br>
                                <center><label class="label" style="color:#FFFFFF;font-size;12px;">Copied to
                                        clipboard</label></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end -->
<!-- container section start -->
<section id="container" class="">

    <section id="main-content">
        <section class="wrapper" style="margin-top:0px !important;margin-bottom: 90px;">

            <div class="row">
                <div class="col-lg-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>
                        <div class="panel-body" style="border:none; background:transparent;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group ">
                                        <div class="row" id="row1" name="row1">
                                            <input type="hidden" id="hdnID" value="<?php echo $userid; ?>">
                                            <div class="col-xs-3" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selField1" name="selField1">
                                                    <option value="name">Name</option>
                                                    <option value="firstname">First Name</option>
                                                    <option value="middlename">Middle Name</option>
                                                    <option value="grandfathername">Grandfather Name</option>
                                                    <option value="lastname">Last Name</option>
                                                    <option value="mobileno">Mobile Number</option>
                                                    <option value="bloodgroup">Blood Group</option>
                                                    <option value="age">Age</option>
                                                    <option value="gender">Gender</option>
                                                    <option value="maritialstatus">Maritial Status</option>
                                                    <option value="residentalsuburb">Residence Suburb</option>
                                                    <option value="residentalcity">Residence City</option>
                                                    <option value="residentalstate">Residence State</option>
                                                    <option value="residentalcountry">Residence Country</option>
                                                    <option value="nameofcompany">Name of Company</option>
                                                    <option value="typeofbusiness">Type of Work</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6" style="padding-left:5px;padding-right:0px;">
                                                <input class="form-control" id="txtSearch1" name="txtSearch1"
                                                       type="text" placeholder="Type here to search"/>
                                                <select class="form-control" id="selBG1" name="selBG1"
                                                        style="display:none;">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <select class="form-control" id="selGen1" name="selGen1"
                                                        style="display:none;">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>

                                                <select class="form-control" id="selmar1" name="selmar1"
                                                        style="display:none;">
                                                    <option value="Unmarried">Unmarried</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>


                                                <select class="form-control" id="selBus1" name="selBus1"
                                                        style="display:none;">
                                                    <option value="Accounting/Finance">Accounting/Finance</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Agriculture / Dairy">Agriculture / Dairy</option>
                                                    <option value="Apparel / Garments">Apparel / Garments</option>
                                                    <option value="Architecture / Interior Design">Architecture /
                                                        Interior Design
                                                    </option>
                                                    <option value="Automobile/ Parts and Spares">Automobile/ Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Banking/ Financial Services">Banking/ Financial
                                                        Services
                                                    </option>
                                                    <option value="Beauty and Cosmetics">Beauty and Cosmetics</option>
                                                    <option value="Books / Stationery">Books / Stationery</option>
                                                    <option value="Chemicals/ Dyes and Solvents">Chemicals/ Dyes and
                                                        Solvents
                                                    </option>
                                                    <option value="Computer / IT Solutions">Computer / IT Solutions
                                                    </option>
                                                    <option value="Construction/Cement/Metals">
                                                        Construction/Cement/Metals
                                                    </option>
                                                    <option value="Doctor">Doctor</option>
                                                    <option value="Education / Training">Education / Training</option>
                                                    <option value="Electrical / Supplies">Electrical / Supplies</option>
                                                    <option value="Electronics / Home Appliances">Electronics / Home
                                                        Appliances
                                                    </option>
                                                    <option value="Engineering/ Ferrous and Non-ferrous metal">
                                                        Engineering/ Ferrous and Non-ferrous metal
                                                    </option>
                                                    <option value="Events/Entertainment">Events/Entertainment</option>
                                                    <option value="Fashion Accessories and Gear">Fashion Accessories and
                                                        Gear
                                                    </option>
                                                    <option value="Footwear">Footwear</option>
                                                    <option value="FMCG/ Food and Beverages">FMCG/ Food and Beverages
                                                    </option>
                                                    <option value="Furniture / Furnishing">Furniture / Furnishing
                                                    </option>
                                                    <option value="Gems/ Jewelry and Bullion">Gems/ Jewelry and
                                                        Bullion
                                                    </option>
                                                    <option value="Grains">Grains</option>
                                                    <option value="Home Decor/Gifts/Art/Artifacts">Home
                                                        Decor/Gifts/Art/Artifacts
                                                    </option>
                                                    <option value="Hotels and Restaurants">Hotels and Restaurants
                                                    </option>
                                                    <option value="Housekeeping Services">Housekeeping Services</option>
                                                    <option value="Industrial Plants/ Machinery / Supplies">Industrial
                                                        Plants/ Machinery / Supplies
                                                    </option>
                                                    <option value="Infrastructure / Projects">Infrastructure /
                                                        Projects
                                                    </option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="IT/BPO/KPO">IT/BPO/KPO</option>
                                                    <option value="Jewellery/Immitation Jewellery">Jewellery/Immitation
                                                        Jewellery
                                                    </option>
                                                    <option value="Kitchenware">Kitchenware</option>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Mechanical / Parts and Spares">Mechanical / Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Medical/ Healthcare/ Hospital">Medical/ Healthcare/
                                                        Hospital
                                                    </option>
                                                    <option value="Medical Shop">Medical Shop</option>
                                                    <option value="NGO/ Social Services">NGO/ Social Services</option>
                                                    <option value="Oil and Gas / Power">Oil and Gas / Power</option>
                                                    <option value="Optics">Optics</option>
                                                    <option value="Packaging">Packaging</option>
                                                    <option value="Paper/ Rubber/Glass">Paper/ Rubber/Glass</option>
                                                    <option value="Pharma/Biotech/Clinical Research">
                                                        Pharma/Biotech/Clinical Research
                                                    </option>
                                                    <option value="Plastics">Plastics</option>
                                                    <option value="PR/Media">PR/Media</option>
                                                    <option value="Printing and Publishing">Printing and Publishing
                                                    </option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Real Estate/ Property">Real Estate/ Property</option>
                                                    <option value="Security Systems and Services">Security Systems and
                                                        Services
                                                    </option>
                                                    <option value="Telecom/ ISP">Telecom/ ISP</option>
                                                    <option value="Textiles/ Yarn and Fabrics">Textiles/ Yarn and
                                                        Fabrics
                                                    </option>
                                                    <option value="Transportation and Logistics">Transportation and
                                                        Logistics
                                                    </option>
                                                    <option value="Travel/Airlines">Travel/Airlines</option>
                                                    <option value="Wellness/ Fitness/ Sports">Wellness/ Fitness/
                                                        Sports
                                                    </option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="row" id="ageDiv1" style="display:none;">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageFrom1" name="ageFrom1"
                                                               type="number" placeholder="Age From"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageTo1" name="ageTo1"
                                                               type="number" placeholder="Age To"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selOp1" name="selOp1"
                                                        style="display:none;">
                                                    <option value="and">And</option>
                                                    <option value="or">Or</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" id="addRow1" style="display:block;">
                                            <a href="javascript:row1()" style="margin-left:10px;">+ Add New Row</a>
                                        </div>
                                        <div class="row" id="row2" name="row2" style="display:none;">
                                            <div class="col-xs-3" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selField2" name="selField2">
                                                    <option value="name">Name</option>
                                                    <option value="firstname">First Name</option>
                                                    <option value="middlename">Middle Name</option>
                                                    <option value="grandfathername">Grandfather Name</option>
                                                    <option value="lastname">Last Name</option>
                                                    <option value="mobileno">Mobile Number</option>
                                                    <option value="bloodgroup">Blood Group</option>
                                                    <option value="age">Age</option>
                                                    <option value="gender">Gender</option>
                                                    <option value="maritialstatus">Maritial Status</option>
                                                    <option value="residentalsuburb">Residence Suburb</option>
                                                    <option value="residentalcity">Residence City</option>
                                                    <option value="residentalstate">Residence State</option>
                                                    <option value="residentalcountry">Residence Country</option>
                                                    <option value="nameofcompany">Name of Company</option>
                                                    <option value="typeofbusiness">Type of Work</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6" style="padding-left:5px;padding-right:0px;">
                                                <input class="form-control" id="txtSearch2" name="txtSearch2"
                                                       type="text" placeholder="Type here to search"/>
                                                <select class="form-control" id="selBG2" name="selBG2"
                                                        style="display:none;">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <select class="form-control" id="selGen2" name="selGen2"
                                                        style="display:none;">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <select class="form-control" id="selmar2" name="selmar2"
                                                        style="display:none;">
                                                    <option value="Unmarried">Unmarried</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                                <select class="form-control" id="selBus2" name="selBus2"
                                                        style="display:none;">
                                                    <option value="Accounting/Finance">Accounting/Finance</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Agriculture / Dairy">Agriculture / Dairy</option>
                                                    <option value="Apparel / Garments">Apparel / Garments</option>
                                                    <option value="Architecture / Interior Design">Architecture /
                                                        Interior Design
                                                    </option>
                                                    <option value="Automobile/ Parts and Spares">Automobile/ Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Banking/ Financial Services">Banking/ Financial
                                                        Services
                                                    </option>
                                                    <option value="Beauty and Cosmetics">Beauty and Cosmetics</option>
                                                    <option value="Books / Stationery">Books / Stationery</option>
                                                    <option value="Chemicals/ Dyes and Solvents">Chemicals/ Dyes and
                                                        Solvents
                                                    </option>
                                                    <option value="Computer / IT Solutions">Computer / IT Solutions
                                                    </option>
                                                    <option value="Construction/Cement/Metals">
                                                        Construction/Cement/Metals
                                                    </option>
                                                    <option value="Doctor">Doctor</option>
                                                    <option value="Education / Training">Education / Training</option>
                                                    <option value="Electrical / Supplies">Electrical / Supplies</option>
                                                    <option value="Electronics / Home Appliances">Electronics / Home
                                                        Appliances
                                                    </option>
                                                    <option value="Engineering/ Ferrous and Non-ferrous metal">
                                                        Engineering/ Ferrous and Non-ferrous metal
                                                    </option>
                                                    <option value="Events/Entertainment">Events/Entertainment</option>
                                                    <option value="Fashion Accessories and Gear">Fashion Accessories and
                                                        Gear
                                                    </option>
                                                    <option value="Footwear">Footwear</option>
                                                    <option value="FMCG/ Food and Beverages">FMCG/ Food and Beverages
                                                    </option>
                                                    <option value="Furniture / Furnishing">Furniture / Furnishing
                                                    </option>
                                                    <option value="Gems/ Jewelry and Bullion">Gems/ Jewelry and
                                                        Bullion
                                                    </option>
                                                    <option value="Grains">Grains</option>
                                                    <option value="Home Decor/Gifts/Art/Artifacts">Home
                                                        Decor/Gifts/Art/Artifacts
                                                    </option>
                                                    <option value="Hotels and Restaurants">Hotels and Restaurants
                                                    </option>
                                                    <option value="Housekeeping Services">Housekeeping Services</option>
                                                    <option value="Industrial Plants/ Machinery / Supplies">Industrial
                                                        Plants/ Machinery / Supplies
                                                    </option>
                                                    <option value="Infrastructure / Projects">Infrastructure /
                                                        Projects
                                                    </option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="IT/BPO/KPO">IT/BPO/KPO</option>
                                                    <option value="Jewellery/Immitation Jewellery">Jewellery/Immitation
                                                        Jewellery
                                                    </option>
                                                    <option value="Kitchenware">Kitchenware</option>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Mechanical / Parts and Spares">Mechanical / Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Medical/ Healthcare/ Hospital">Medical/ Healthcare/
                                                        Hospital
                                                    </option>
                                                    <option value="Medical Shop">Medical Shop</option>
                                                    <option value="NGO/ Social Services">NGO/ Social Services</option>
                                                    <option value="Oil and Gas / Power">Oil and Gas / Power</option>
                                                    <option value="Optics">Optics</option>
                                                    <option value="Packaging">Packaging</option>
                                                    <option value="Paper/ Rubber/Glass">Paper/ Rubber/Glass</option>
                                                    <option value="Pharma/Biotech/Clinical Research">
                                                        Pharma/Biotech/Clinical Research
                                                    </option>
                                                    <option value="Plastics">Plastics</option>
                                                    <option value="PR/Media">PR/Media</option>
                                                    <option value="Printing and Publishing">Printing and Publishing
                                                    </option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Real Estate/ Property">Real Estate/ Property</option>
                                                    <option value="Security Systems and Services">Security Systems and
                                                        Services
                                                    </option>
                                                    <option value="Telecom/ ISP">Telecom/ ISP</option>
                                                    <option value="Textiles/ Yarn and Fabrics">Textiles/ Yarn and
                                                        Fabrics
                                                    </option>
                                                    <option value="Transportation and Logistics">Transportation and
                                                        Logistics
                                                    </option>
                                                    <option value="Travel/Airlines">Travel/Airlines</option>
                                                    <option value="Wellness/ Fitness/ Sports">Wellness/ Fitness/
                                                        Sports
                                                    </option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="row" id="ageDiv2" style="display:none;">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageFrom2" name="ageFrom2"
                                                               type="number" placeholder="Age From"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageTo2" name="ageTo2"
                                                               type="number" placeholder="Age To"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selOp2" name="selOp2"
                                                        style="display:none;">
                                                    <option value="and">And</option>
                                                    <option value="or">Or</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-1" style="padding-left:5px;padding-right:0px;">
                                                <center><a href="javascript:removeRow2()">
                                                        <div id="remove2" name="remove2"><i
                                                                    class="fa fa-minus-circle fa-1x"
                                                                    style="color:#ff0000;"></i></div>
                                                    </a></center>
                                            </div>
                                        </div>
                                        <div class="row" id="addRow2" style="display:none;">
                                            <a href="javascript:row2()" style="margin-left:10px;">+ Add New Row</a>
                                        </div>
                                        <div class="row" id="row3" name="row3" style="display:none;">
                                            <div class="col-xs-3" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selField3" name="selField3">
                                                    <option value="name">Name</option>
                                                    <option value="firstname">First Name</option>
                                                    <option value="middlename">Middle Name</option>
                                                    <option value="grandfathername">Grandfather Name</option>
                                                    <option value="lastname">Last Name</option>
                                                    <option value="mobileno">Mobile Number</option>
                                                    <option value="bloodgroup">Blood Group</option>
                                                    <option value="age">Age</option>
                                                    <option value="gender">Gender</option>
                                                    <option value="maritialstatus">Maritial Status</option>
                                                    <option value="residentalsuburb">Residence Suburb</option>
                                                    <option value="residentalcity">Residence City</option>
                                                    <option value="residentalstate">Residence State</option>
                                                    <option value="residentalcountry">Residence Country</option>
                                                    <option value="nameofcompany">Name of Company</option>
                                                    <option value="typeofbusiness">Type of Work</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6" style="padding-left:5px;padding-right:0px;">
                                                <input class="form-control" id="txtSearch3" name="txtSearch3"
                                                       type="text" placeholder="Type here to search"/>
                                                <select class="form-control" id="selBG3" name="selBG3"
                                                        style="display:none;">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <select class="form-control" id="selGen3" name="selGen3"
                                                        style="display:none;">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <select class="form-control" id="selmar3" name="selmar3"
                                                        style="display:none;">
                                                    <option value="Unmarried">Unmarried</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                                <select class="form-control" id="selBus3" name="selBus3"
                                                        style="display:none;">
                                                    <option value="Accounting/Finance">Accounting/Finance</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Agriculture / Dairy">Agriculture / Dairy</option>
                                                    <option value="Apparel / Garments">Apparel / Garments</option>
                                                    <option value="Architecture / Interior Design">Architecture /
                                                        Interior Design
                                                    </option>
                                                    <option value="Automobile/ Parts and Spares">Automobile/ Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Banking/ Financial Services">Banking/ Financial
                                                        Services
                                                    </option>
                                                    <option value="Beauty and Cosmetics">Beauty and Cosmetics</option>
                                                    <option value="Books / Stationery">Books / Stationery</option>
                                                    <option value="Chemicals/ Dyes and Solvents">Chemicals/ Dyes and
                                                        Solvents
                                                    </option>
                                                    <option value="Computer / IT Solutions">Computer / IT Solutions
                                                    </option>
                                                    <option value="Construction/Cement/Metals">
                                                        Construction/Cement/Metals
                                                    </option>
                                                    <option value="Doctor">Doctor</option>
                                                    <option value="Education / Training">Education / Training</option>
                                                    <option value="Electrical / Supplies">Electrical / Supplies</option>
                                                    <option value="Electronics / Home Appliances">Electronics / Home
                                                        Appliances
                                                    </option>
                                                    <option value="Engineering/ Ferrous and Non-ferrous metal">
                                                        Engineering/ Ferrous and Non-ferrous metal
                                                    </option>
                                                    <option value="Events/Entertainment">Events/Entertainment</option>
                                                    <option value="Fashion Accessories and Gear">Fashion Accessories and
                                                        Gear
                                                    </option>
                                                    <option value="Footwear">Footwear</option>
                                                    <option value="FMCG/ Food and Beverages">FMCG/ Food and Beverages
                                                    </option>
                                                    <option value="Furniture / Furnishing">Furniture / Furnishing
                                                    </option>
                                                    <option value="Gems/ Jewelry and Bullion">Gems/ Jewelry and
                                                        Bullion
                                                    </option>
                                                    <option value="Grains">Grains</option>
                                                    <option value="Home Decor/Gifts/Art/Artifacts">Home
                                                        Decor/Gifts/Art/Artifacts
                                                    </option>
                                                    <option value="Hotels and Restaurants">Hotels and Restaurants
                                                    </option>
                                                    <option value="Housekeeping Services">Housekeeping Services</option>
                                                    <option value="Industrial Plants/ Machinery / Supplies">Industrial
                                                        Plants/ Machinery / Supplies
                                                    </option>
                                                    <option value="Infrastructure / Projects">Infrastructure /
                                                        Projects
                                                    </option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="IT/BPO/KPO">IT/BPO/KPO</option>
                                                    <option value="Jewellery/Immitation Jewellery">Jewellery/Immitation
                                                        Jewellery
                                                    </option>
                                                    <option value="Kitchenware">Kitchenware</option>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Mechanical / Parts and Spares">Mechanical / Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Medical/ Healthcare/ Hospital">Medical/ Healthcare/
                                                        Hospital
                                                    </option>
                                                    <option value="Medical Shop">Medical Shop</option>
                                                    <option value="NGO/ Social Services">NGO/ Social Services</option>
                                                    <option value="Oil and Gas / Power">Oil and Gas / Power</option>
                                                    <option value="Optics">Optics</option>
                                                    <option value="Packaging">Packaging</option>
                                                    <option value="Paper/ Rubber/Glass">Paper/ Rubber/Glass</option>
                                                    <option value="Pharma/Biotech/Clinical Research">
                                                        Pharma/Biotech/Clinical Research
                                                    </option>
                                                    <option value="Plastics">Plastics</option>
                                                    <option value="PR/Media">PR/Media</option>
                                                    <option value="Printing and Publishing">Printing and Publishing
                                                    </option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Real Estate/ Property">Real Estate/ Property</option>
                                                    <option value="Security Systems and Services">Security Systems and
                                                        Services
                                                    </option>
                                                    <option value="Telecom/ ISP">Telecom/ ISP</option>
                                                    <option value="Textiles/ Yarn and Fabrics">Textiles/ Yarn and
                                                        Fabrics
                                                    </option>
                                                    <option value="Transportation and Logistics">Transportation and
                                                        Logistics
                                                    </option>
                                                    <option value="Travel/Airlines">Travel/Airlines</option>
                                                    <option value="Wellness/ Fitness/ Sports">Wellness/ Fitness/
                                                        Sports
                                                    </option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="row" id="ageDiv3" style="display:none;">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageFrom3" name="ageFrom3"
                                                               type="number" placeholder="Age From"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageTo3" name="ageTo3"
                                                               type="number" placeholder="Age To"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selOp3" name="selOp3"
                                                        style="display:none;">
                                                    <option value="and">And</option>
                                                    <option value="or">Or</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-1" style="padding-left:5px;padding-right:0px;">
                                                <center><a href="javascript:removeRow3()">
                                                        <div id="remove3" name="remove3"><i
                                                                    class="fa fa-minus-circle fa-1x"
                                                                    style="color:#ff0000;"></i></div>
                                                    </a></center>
                                            </div>
                                        </div>
                                        <div class="row" id="addRow3" style="display:none;">
                                            <a href="javascript:row3()" style="margin-left:10px;">+ Add New Row</a>
                                        </div>
                                        <div class="row" id="row4" name="row4" style="display:none;">
                                            <div class="col-xs-3" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selField4" name="selField4">
                                                    <option value="name">Name</option>
                                                    <option value="firstname">First Name</option>
                                                    <option value="middlename">Middle Name</option>
                                                    <option value="grandfathername">Grandfather Name</option>
                                                    <option value="lastname">Last Name</option>
                                                    <option value="mobileno">Mobile Number</option>
                                                    <option value="bloodgroup">Blood Group</option>
                                                    <option value="age">Age</option>
                                                    <option value="gender">Gender</option>
                                                    <option value="maritialstatus">Maritial Status</option>
                                                    <option value="residentalsuburb">Residence Suburb</option>
                                                    <option value="residentalcity">Residence City</option>
                                                    <option value="residentalstate">Residence State</option>
                                                    <option value="residentalcountry">Residence Country</option>
                                                    <option value="nameofcompany">Name of Company</option>
                                                    <option value="typeofbusiness">Type of Work</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6" style="padding-left:5px;padding-right:0px;">
                                                <input class="form-control" id="txtSearch4" name="txtSearch4"
                                                       type="text" placeholder="Type here to search"/>
                                                <select class="form-control" id="selBG4" name="selBG4"
                                                        style="display:none;">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <select class="form-control" id="selGen4" name="selGen4"
                                                        style="display:none;">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <select class="form-control" id="selmar4" name="selmar4"
                                                        style="display:none;">
                                                    <option value="Unmarried">Unmarried</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                                <select class="form-control" id="selBus4" name="selBus4"
                                                        style="display:none;">
                                                    <option value="Accounting/Finance">Accounting/Finance</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Agriculture / Dairy">Agriculture / Dairy</option>
                                                    <option value="Apparel / Garments">Apparel / Garments</option>
                                                    <option value="Architecture / Interior Design">Architecture /
                                                        Interior Design
                                                    </option>
                                                    <option value="Automobile/ Parts and Spares">Automobile/ Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Banking/ Financial Services">Banking/ Financial
                                                        Services
                                                    </option>
                                                    <option value="Beauty and Cosmetics">Beauty and Cosmetics</option>
                                                    <option value="Books / Stationery">Books / Stationery</option>
                                                    <option value="Chemicals/ Dyes and Solvents">Chemicals/ Dyes and
                                                        Solvents
                                                    </option>
                                                    <option value="Computer / IT Solutions">Computer / IT Solutions
                                                    </option>
                                                    <option value="Construction/Cement/Metals">
                                                        Construction/Cement/Metals
                                                    </option>
                                                    <option value="Doctor">Doctor</option>
                                                    <option value="Education / Training">Education / Training</option>
                                                    <option value="Electrical / Supplies">Electrical / Supplies</option>
                                                    <option value="Electronics / Home Appliances">Electronics / Home
                                                        Appliances
                                                    </option>
                                                    <option value="Engineering/ Ferrous and Non-ferrous metal">
                                                        Engineering/ Ferrous and Non-ferrous metal
                                                    </option>
                                                    <option value="Events/Entertainment">Events/Entertainment</option>
                                                    <option value="Fashion Accessories and Gear">Fashion Accessories and
                                                        Gear
                                                    </option>
                                                    <option value="Footwear">Footwear</option>
                                                    <option value="FMCG/ Food and Beverages">FMCG/ Food and Beverages
                                                    </option>
                                                    <option value="Furniture / Furnishing">Furniture / Furnishing
                                                    </option>
                                                    <option value="Gems/ Jewelry and Bullion">Gems/ Jewelry and
                                                        Bullion
                                                    </option>
                                                    <option value="Grains">Grains</option>
                                                    <option value="Home Decor/Gifts/Art/Artifacts">Home
                                                        Decor/Gifts/Art/Artifacts
                                                    </option>
                                                    <option value="Hotels and Restaurants">Hotels and Restaurants
                                                    </option>
                                                    <option value="Housekeeping Services">Housekeeping Services</option>
                                                    <option value="Industrial Plants/ Machinery / Supplies">Industrial
                                                        Plants/ Machinery / Supplies
                                                    </option>
                                                    <option value="Infrastructure / Projects">Infrastructure /
                                                        Projects
                                                    </option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="IT/BPO/KPO">IT/BPO/KPO</option>
                                                    <option value="Jewellery/Immitation Jewellery">Jewellery/Immitation
                                                        Jewellery
                                                    </option>
                                                    <option value="Kitchenware">Kitchenware</option>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Mechanical / Parts and Spares">Mechanical / Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Medical/ Healthcare/ Hospital">Medical/ Healthcare/
                                                        Hospital
                                                    </option>
                                                    <option value="Medical Shop">Medical Shop</option>
                                                    <option value="NGO/ Social Services">NGO/ Social Services</option>
                                                    <option value="Oil and Gas / Power">Oil and Gas / Power</option>
                                                    <option value="Optics">Optics</option>
                                                    <option value="Packaging">Packaging</option>
                                                    <option value="Paper/ Rubber/Glass">Paper/ Rubber/Glass</option>
                                                    <option value="Pharma/Biotech/Clinical Research">
                                                        Pharma/Biotech/Clinical Research
                                                    </option>
                                                    <option value="Plastics">Plastics</option>
                                                    <option value="PR/Media">PR/Media</option>
                                                    <option value="Printing and Publishing">Printing and Publishing
                                                    </option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Real Estate/ Property">Real Estate/ Property</option>
                                                    <option value="Security Systems and Services">Security Systems and
                                                        Services
                                                    </option>
                                                    <option value="Telecom/ ISP">Telecom/ ISP</option>
                                                    <option value="Textiles/ Yarn and Fabrics">Textiles/ Yarn and
                                                        Fabrics
                                                    </option>
                                                    <option value="Transportation and Logistics">Transportation and
                                                        Logistics
                                                    </option>
                                                    <option value="Travel/Airlines">Travel/Airlines</option>
                                                    <option value="Wellness/ Fitness/ Sports">Wellness/ Fitness/
                                                        Sports
                                                    </option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="row" id="ageDiv4" style="display:none;">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageFrom4" name="ageFrom4"
                                                               type="number" placeholder="Age From"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageTo4" name="ageTo4"
                                                               type="number" placeholder="Age To"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selOp4" name="selOp4"
                                                        style="display:none;">
                                                    <option value="and">And</option>
                                                    <option value="or">Or</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-1" style="padding-left:5px;padding-right:0px;">
                                                <center><a href="javascript:removeRow4()">
                                                        <div id="remove4" name="remove4"><i
                                                                    class="fa fa-minus-circle fa-1x"
                                                                    style="color:#ff0000;"></i></div>
                                                    </a></center>
                                            </div>
                                        </div>
                                        <div class="row" id="addRow4" style="display:none;">
                                            <a href="javascript:row4()" style="margin-left:10px;">+ Add New Row</a>
                                        </div>
                                        <div class="row" id="row5" name="row5" style="display:none;">
                                            <div class="col-xs-3" style="padding-left:5px;padding-right:0px;">
                                                <select class="form-control" id="selField5" name="selField5">
                                                    <option value="name">Name</option>
                                                    <option value="firstname">First Name</option>
                                                    <option value="middlename">Middle Name</option>
                                                    <option value="grandfathername">Grandfather Name</option>
                                                    <option value="lastname">Last Name</option>
                                                    <option value="mobileno">Mobile Number</option>
                                                    <option value="bloodgroup">Blood Group</option>
                                                    <option value="age">Age</option>
                                                    <option value="gender">Gender</option>
                                                    <option value="maritialstatus">Maritial Status</option>
                                                    <option value="residentalsuburb">Residence Suburb</option>
                                                    <option value="residentalcity">Residence City</option>
                                                    <option value="residentalstate">Residence State</option>
                                                    <option value="residentalcountry">Residence Country</option>
                                                    <option value="nameofcompany">Name of Company</option>
                                                    <option value="typeofbusiness">Type of Work</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-6" style="padding-left:5px;padding-right:0px;">
                                                <input class="form-control" id="txtSearch5" name="txtSearch5"
                                                       type="text" placeholder="Type here to search"/>
                                                <select class="form-control" id="selBG5" name="selBG5"
                                                        style="display:none;">
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <select class="form-control" id="selGen5" name="selGen5"
                                                        style="display:none;">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <select class="form-control" id="selmar5" name="selmar5"
                                                        style="display:none;">
                                                    <option value="Unmarried">Unmarried</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                                <select class="form-control" id="selBus5" name="selBus5"
                                                        style="display:none;">
                                                    <option value="Accounting/Finance">Accounting/Finance</option>
                                                    <option value="Advertising">Advertising</option>
                                                    <option value="Agriculture / Dairy">Agriculture / Dairy</option>
                                                    <option value="Apparel / Garments">Apparel / Garments</option>
                                                    <option value="Architecture / Interior Design">Architecture /
                                                        Interior Design
                                                    </option>
                                                    <option value="Automobile/ Parts and Spares">Automobile/ Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Banking/ Financial Services">Banking/ Financial
                                                        Services
                                                    </option>
                                                    <option value="Beauty and Cosmetics">Beauty and Cosmetics</option>
                                                    <option value="Books / Stationery">Books / Stationery</option>
                                                    <option value="Chemicals/ Dyes and Solvents">Chemicals/ Dyes and
                                                        Solvents
                                                    </option>
                                                    <option value="Computer / IT Solutions">Computer / IT Solutions
                                                    </option>
                                                    <option value="Construction/Cement/Metals">
                                                        Construction/Cement/Metals
                                                    </option>
                                                    <option value="Doctor">Doctor</option>
                                                    <option value="Education / Training">Education / Training</option>
                                                    <option value="Electrical / Supplies">Electrical / Supplies</option>
                                                    <option value="Electronics / Home Appliances">Electronics / Home
                                                        Appliances
                                                    </option>
                                                    <option value="Engineering/ Ferrous and Non-ferrous metal">
                                                        Engineering/ Ferrous and Non-ferrous metal
                                                    </option>
                                                    <option value="Events/Entertainment">Events/Entertainment</option>
                                                    <option value="Fashion Accessories and Gear">Fashion Accessories and
                                                        Gear
                                                    </option>
                                                    <option value="Footwear">Footwear</option>
                                                    <option value="FMCG/ Food and Beverages">FMCG/ Food and Beverages
                                                    </option>
                                                    <option value="Furniture / Furnishing">Furniture / Furnishing
                                                    </option>
                                                    <option value="Gems/ Jewelry and Bullion">Gems/ Jewelry and
                                                        Bullion
                                                    </option>
                                                    <option value="Grains">Grains</option>
                                                    <option value="Home Decor/Gifts/Art/Artifacts">Home
                                                        Decor/Gifts/Art/Artifacts
                                                    </option>
                                                    <option value="Hotels and Restaurants">Hotels and Restaurants
                                                    </option>
                                                    <option value="Housekeeping Services">Housekeeping Services</option>
                                                    <option value="Industrial Plants/ Machinery / Supplies">Industrial
                                                        Plants/ Machinery / Supplies
                                                    </option>
                                                    <option value="Infrastructure / Projects">Infrastructure /
                                                        Projects
                                                    </option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="IT/BPO/KPO">IT/BPO/KPO</option>
                                                    <option value="Jewellery/Immitation Jewellery">Jewellery/Immitation
                                                        Jewellery
                                                    </option>
                                                    <option value="Kitchenware">Kitchenware</option>
                                                    <option value="Legal">Legal</option>
                                                    <option value="Mechanical / Parts and Spares">Mechanical / Parts and
                                                        Spares
                                                    </option>
                                                    <option value="Medical/ Healthcare/ Hospital">Medical/ Healthcare/
                                                        Hospital
                                                    </option>
                                                    <option value="Medical Shop">Medical Shop</option>
                                                    <option value="NGO/ Social Services">NGO/ Social Services</option>
                                                    <option value="Oil and Gas / Power">Oil and Gas / Power</option>
                                                    <option value="Optics">Optics</option>
                                                    <option value="Packaging">Packaging</option>
                                                    <option value="Paper/ Rubber/Glass">Paper/ Rubber/Glass</option>
                                                    <option value="Pharma/Biotech/Clinical Research">
                                                        Pharma/Biotech/Clinical Research
                                                    </option>
                                                    <option value="Plastics">Plastics</option>
                                                    <option value="PR/Media">PR/Media</option>
                                                    <option value="Printing and Publishing">Printing and Publishing
                                                    </option>
                                                    <option value="Professional Services">Professional Services</option>
                                                    <option value="Real Estate/ Property">Real Estate/ Property</option>
                                                    <option value="Security Systems and Services">Security Systems and
                                                        Services
                                                    </option>
                                                    <option value="Telecom/ ISP">Telecom/ ISP</option>
                                                    <option value="Textiles/ Yarn and Fabrics">Textiles/ Yarn and
                                                        Fabrics
                                                    </option>
                                                    <option value="Transportation and Logistics">Transportation and
                                                        Logistics
                                                    </option>
                                                    <option value="Travel/Airlines">Travel/Airlines</option>
                                                    <option value="Wellness/ Fitness/ Sports">Wellness/ Fitness/
                                                        Sports
                                                    </option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <div class="row" id="ageDiv5" style="display:none;">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageFrom5" name="ageFrom5"
                                                               type="number" placeholder="Age From"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                                        <input class="form-control" id="ageTo5" name="ageTo5"
                                                               type="number" placeholder="Age To"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2" style="padding-left:5px;padding-right:0px;">
                                            </div>
                                            <div class="col-xs-1" style="padding-left:5px;padding-right:0px;">
                                                <center><a href="javascript:removeRow5()">
                                                        <div id="remove5" name="remove5"><i
                                                                    class="fa fa-minus-circle fa-1x"
                                                                    style="color:#ff0000;"></i></div>
                                                    </a></center>
                                            </div>
                                        </div>


                                        <div class="row" style="display: none;">
                                            <div style="margin-left: 5px;">
                                                <label for="male" style='font-weight: 600;'>Search within - </label>
                                                <input type="radio" id="Primary" name="Profile" value="Primary">&nbsp
                                                <label for="male">Primary members</label>&nbsp
                                                <input type="radio" id="All" checked name="Profile" value="All">&nbsp
                                                <label for="female">All members</label>&nbsp
                                            </div>
                                        </div>

                                        <!--BEFORE THIS-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-4">
                                    <input type="submit" id="btnSubmit" value="Search Profile" onclick="search();"
                                           class="btn btn-primary"
                                           style="width:100%;background-color:#D81B60; height:50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div id="searchResultPanel" style="display:none; background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>
                        <div class="panel-body" id="disp_search_result" style="border:none; background:transparent;">

                        </div>
                    </div>
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
<script src="js/jquery.dataTables.min.js"></script>
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
<!--Copy-->
<script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>

<script>
    var cnt = 1;

    $('#selField1').change(function () {
        if ($('#selField1').val() == 'bloodgroup') {
            $("#txtSearch1").css("display", "none");
            $("#selBG1").css("display", "block");
            $("#ageDiv1").css("display", "none");
            $("#selGen1").css("display", "none");
            $("#selBus1").css("display", "none");
            $("#selmar1").css("display", "none");
        } else if ($('#selField1').val() == 'age') {
            $("#txtSearch1").css("display", "none");
            $("#selBG1").css("display", "none");
            $("#ageDiv1").css("display", "block");
            $("#selGen1").css("display", "none");
            $("#selBus1").css("display", "none");
            $("#selmar1").css("display", "none");
        } else if ($('#selField1').val() == 'gender') {
            $("#txtSearch1").css("display", "none");
            $("#selBG1").css("display", "none");
            $("#selGen1").css("display", "block");
            $("#ageDiv1").css("display", "none");
            $("#selBus1").css("display", "none");
            $("#selmar1").css("display", "none");
        } else if ($('#selField1').val() == 'maritialstatus') {
            $("#txtSearch1").css("display", "none");
            $("#selBG1").css("display", "none");
            $("#selGen1").css("display", "none");
            $("#ageDiv1").css("display", "none");
            $("#selBus1").css("display", "none");
            $("#selmar1").css("display", "block");
        } else if ($('#selField1').val() == 'typeofbusiness') {
            $("#txtSearch1").css("display", "none");
            $("#selBG1").css("display", "none");
            $("#selGen1").css("display", "none");
            $("#ageDiv1").css("display", "none");
            $("#selBus1").css("display", "block");
            $("#selmar1").css("display", "none");
        } else {
            $("#txtSearch1").css("display", "block");
            $("#selBG1").css("display", "none");
            $("#ageDiv1").css("display", "none");
            $("#selGen1").css("display", "none");
            $("#selBus1").css("display", "none");
            $("#selmar1").css("display", "none");
        }
    });

    $('#selField2').change(function () {
        if ($('#selField2').val() == 'bloodgroup') {
            $("#txtSearch2").css("display", "none");
            $("#selBG2").css("display", "block");
            $("#ageDiv2").css("display", "none");
            $("#selGen2").css("display", "none");
            $("#selBus2").css("display", "none");
            $("#selmar2").css("display", "none");
        } else if ($('#selField2').val() == 'age') {
            $("#txtSearch2").css("display", "none");
            $("#selBG2").css("display", "none");
            $("#ageDiv2").css("display", "block");
            $("#selGen2").css("display", "none");
            $("#selBus2").css("display", "none");
            $("#selmar2").css("display", "none");
        } else if ($('#selField2').val() == 'gender') {
            $("#txtSearch2").css("display", "none");
            $("#selBG2").css("display", "none");
            $("#selGen2").css("display", "block");
            $("#ageDiv2").css("display", "none");
            $("#selBus2").css("display", "none");
            $("#selmar2").css("display", "none");
        } else if ($('#selField2').val() == 'maritialstatus') {
            $("#txtSearch2").css("display", "none");
            $("#selBG2").css("display", "none");
            $("#selGen2").css("display", "none");
            $("#ageDiv2").css("display", "none");
            $("#selBus2").css("display", "none");
            $("#selmar2").css("display", "block");
        } else if ($('#selField2').val() == 'typeofbusiness') {
            $("#txtSearch2").css("display", "none");
            $("#selBG2").css("display", "none");
            $("#selGen2").css("display", "none");
            $("#ageDiv2").css("display", "none");
            $("#selBus2").css("display", "block");
            $("#selmar2").css("display", "none");
        } else {
            $("#txtSearch2").css("display", "block");
            $("#selBG2").css("display", "none");
            $("#ageDiv2").css("display", "none");
            $("#selGen2").css("display", "none");
            $("#selBus2").css("display", "none");
            $("#selmar2").css("display", "none");
        }
    });

    $('#selField3').change(function () {
        if ($('#selField3').val() == 'bloodgroup') {
            $("#txtSearch3").css("display", "none");
            $("#selBG3").css("display", "block");
            $("#ageDiv3").css("display", "none");
            $("#selGen3").css("display", "none");
            $("#selBus3").css("display", "none");
            $("#selmar3").css("display", "none");
        } else if ($('#selField3').val() == 'age') {
            $("#txtSearch3").css("display", "none");
            $("#selBG3").css("display", "none");
            $("#ageDiv3").css("display", "block");
            $("#selGen3").css("display", "none");
            $("#selBus3").css("display", "none");
            $("#selmar3").css("display", "none");
        } else if ($('#selField3').val() == 'gender') {
            $("#txtSearch3").css("display", "none");
            $("#selBG3").css("display", "none");
            $("#selGen3").css("display", "block");
            $("#ageDiv3").css("display", "none");
            $("#selBus3").css("display", "none");
            $("#selmar3").css("display", "none");
        } else if ($('#selField3').val() == 'maritialstatus') {
            $("#txtSearch3").css("display", "none");
            $("#selBG3").css("display", "none");
            $("#selGen3").css("display", "none");
            $("#ageDiv3").css("display", "none");
            $("#selBus3").css("display", "none");
            $("#selmar3").css("display", "block");
        } else if ($('#selField3').val() == 'typeofbusiness') {
            $("#txtSearch3").css("display", "none");
            $("#selBG3").css("display", "none");
            $("#selGen3").css("display", "none");
            $("#ageDiv3").css("display", "none");
            $("#selBus3").css("display", "block");
            $("#selmar3").css("display", "none");
        } else {
            $("#txtSearch3").css("display", "block");
            $("#selBG3").css("display", "none");
            $("#ageDiv3").css("display", "none");
            $("#selGen3").css("display", "none");
            $("#selBus3").css("display", "none");
            $("#selmar3").css("display", "none");
        }
    });

    $('#selField4').change(function () {
        if ($('#selField4').val() == 'bloodgroup') {
            $("#txtSearch4").css("display", "none");
            $("#selBG4").css("display", "block");
            $("#ageDiv4").css("display", "none");
            $("#selGen4").css("display", "none");
            $("#selBus4").css("display", "none");
            $("#selmar4").css("display", "none");
        } else if ($('#selField4').val() == 'age') {
            $("#txtSearch4").css("display", "none");
            $("#selBG4").css("display", "none");
            $("#ageDiv4").css("display", "block");
            $("#selGen4").css("display", "none");
            $("#selBus4").css("display", "none");
            $("#selmar4").css("display", "none");
        } else if ($('#selField4').val() == 'gender') {
            $("#txtSearch4").css("display", "none");
            $("#selBG4").css("display", "none");
            $("#selGen4").css("display", "block");
            $("#ageDiv4").css("display", "none");
            $("#selBus4").css("display", "none");
            $("#selmar4").css("display", "none");
        } else if ($('#selField4').val() == 'maritialstatus') {
            $("#txtSearch4").css("display", "none");
            $("#selBG4").css("display", "none");
            $("#selGen4").css("display", "none");
            $("#ageDiv4").css("display", "none");
            $("#selBus4").css("display", "none");
            $("#selmar4").css("display", "block");
        } else if ($('#selField4').val() == 'typeofbusiness') {
            $("#txtSearch4").css("display", "none");
            $("#selBG4").css("display", "none");
            $("#selGen4").css("display", "none");
            $("#ageDiv4").css("display", "none");
            $("#selBus4").css("display", "block");
            $("#selmar4").css("display", "none");
        } else {
            $("#txtSearch4").css("display", "block");
            $("#selBG4").css("display", "none");
            $("#ageDiv4").css("display", "none");
            $("#selGen4").css("display", "none");
            $("#selBus4").css("display", "none");
            $("#selmar4").css("display", "none");
        }
    });

    $('#selField5').change(function () {
        if ($('#selField5').val() == 'bloodgroup') {
            $("#txtSearch5").css("display", "none");
            $("#selBG5").css("display", "block");
            $("#ageDiv5").css("display", "none");
            $("#selGen5").css("display", "none");
            $("#selBus5").css("display", "none");
            $("#selmar5").css("display", "none");
        } else if ($('#selField5').val() == 'age') {
            $("#txtSearch5").css("display", "none");
            $("#selBG5").css("display", "none");

            $("#ageDiv5").css("display", "block");
            $("#selGen5").css("display", "none");
            $("#selBus5").css("display", "none");
            $("#selmar5").css("display", "none");
        } else if ($('#selField5').val() == 'gender') {
            $("#txtSearch5").css("display", "none");
            $("#selBG5").css("display", "none");
            $("#selGen5").css("display", "block");
            $("#ageDiv5").css("display", "none");
            $("#selBus5").css("display", "none");
            $("#selmar5").css("display", "none");
        } else if ($('#selField5').val() == 'maritialstatus') {
            $("#txtSearch5").css("display", "none");
            $("#selBG5").css("display", "none");
            $("#selGen5").css("display", "none");
            $("#ageDiv5").css("display", "none");
            $("#selBus5").css("display", "none");
            $("#selmar5").css("display", "block");
        } else if ($('#selField5').val() == 'typeofbusiness') {
            $("#txtSearch5").css("display", "none");
            $("#selBG5").css("display", "none");
            $("#selGen5").css("display", "none");
            $("#ageDiv5").css("display", "none");
            $("#selBus5").css("display", "block");
            $("#selmar5").css("display", "none");
        } else {
            $("#txtSearch5").css("display", "block");
            $("#selBG5").css("display", "none");
            $("#ageDiv5").css("display", "none");
            $("#selGen5").css("display", "none");
            $("#selBus5").css("display", "none");
            $("#selmar5").css("display", "none");
        }
    });

    function search() {
        var cookie_array = [];
        var cookie_parent_array = [];
        if ($("#txtSearch1").val() == "" && cnt >= 1 && $("#selField1").val() != "bloodgroup" && $("#selField1").val() != "age" && $("#selField1").val() != "gender" && $("#selField1").val() != "maritialstatus" && $("#selField1").val() != "typeofbusiness") {
            alert("Please enter any value to Search");
            document.getElementById("txtSearch1").focus();
        } else if ($("#txtSearch2").val() == "" && cnt >= 2 && $("#selField2").val() != "bloodgroup" && $("#selField2").val() != "age" && $("#selField2").val() != "gender" && $("#selField2").val() != "maritialstatus" && $("#selField2").val() != "typeofbusiness") {
            alert("Please enter any value to Search");
            document.getElementById("txtSearch2").focus();
        } else if ($("#txtSearch3").val() == "" && cnt >= 3 && $("#selField3").val() != "bloodgroup" && $("#selField3").val() != "age" && $("#selField3").val() != "gender" && $("#selField3").val() != "maritialstatus" && $("#selField3").val() != "typeofbusiness") {
            alert("Please enter any value to Search");
            document.getElementById("txtSearch3").focus();
        } else if ($("#txtSearch4").val() == "" && cnt >= 4 && $("#selField4").val() != "bloodgroup" && $("#selField4").val() != "age" && $("#selField4").val() != "gender" && $("#selField4").val() != "maritialstatus" && $("#selField4").val() != "typeofbusiness") {
            alert("Please enter any value to Search");
            document.getElementById("txtSearch4").focus();
        } else if ($("#txtSearch5").val() == "" && cnt == 5 && $("#selField5").val() != "bloodgroup" && $("#selField5").val() != "age" && $("#selField5").val() != "gender" && $("#selField5").val() != "maritialstatus" && $("#selField5").val() != "typeofbusiness") {
            alert("Please enter any value to Search");
            document.getElementById("txtSearch5").focus();
        } else {
            var selectFieldValue = $("#selField1").val();
            // var select_arr = [];
            select_arr = {}
            select_arr["selected_field_id"] = "selField1";
            select_arr["selected_field_value"] = $("#selField1").val();
            // cookie_array.push(select_arr);
            //cookie_array[0] = select_arr;
            // cookie_array['selected_field_id'] = "selField1";
            // cookie_array['selected_field_value'] = $("#selField1").val();
            var codn = "";
            if ($("#selField1").val() == "age") {

                if (isNaN($("#ageFrom1").val()) || $("#ageFrom1").val() == "") {
                    alert("Invalid value for age. Put only numbers. E.g.: 26");
                    document.getElementById("ageFrom1").focus();
                } else if (isNaN($("#ageTo1").val()) || $("#ageTo1").val() == "") {
                    alert("Invalid value for age. Put only numbers. E.g.: 26");
                    document.getElementById("ageTo1").focus();
                } else {
                    select_arr["input_field_name_1"] = "ageFrom1";
                    select_arr["input_field_value_1"] = $("#ageFrom1").val();
                    select_arr["input_field_name_2"] = "ageTo1";
                    select_arr["input_field_value_2"] = $("#ageTo1").val();
                    var d = new Date();
                    var n1 = d.getFullYear() - $("#ageFrom1").val();
                    var n2 = d.getFullYear() - $("#ageTo1").val();
                    var sd = "'" + n2 + "-01-01' and '" + n1 + "-12-31'";
                    codn = "dateofbirth between " + sd;
                }
                //console.log(select_arr);
                cookie_array.push(select_arr);
            } else {
                if ($("#selField1").val() == "bloodgroup") {
                    select_arr["input_field_name"] = "selBG1";
                    select_arr["input_field_value"] = $("#selBG1").val();
                    codn = $("#selField1").val() + "='" + $("#selBG1").val() + "'";
                } else if ($("#selField1").val() == "gender") {
                    select_arr["input_field_name"] = "selGen1";
                    select_arr["input_field_value"] = $("#selGen1").val();
                    codn = $("#selField1").val() + "='" + $("#selGen1").val() + "'";
                } else if ($("#selField1").val() == "mobileno") {
                    select_arr["input_field_name"] = "txtSearch1";
                    select_arr["input_field_value"] = $("#txtSearch1").val();
                    //codn=$("#selField1").val() + " like '%" + $("#txtSearch1").val() + "%' OR alternativemobileno like '%" + $("#txtSearch1").val() + "%'" ;
                    codn = $("#selField1").val() + " like '%" + $("#txtSearch1").val() + "%' OR alternativemobileno like '%" + $("#txtSearch1").val() + "%' OR residentalphone like '%" + $("#txtSearch1").val() + "%' OR officephone like '%" + $("#txtSearch1").val() + "%'";
                    ///alert(codn);
                } else if ($("#selField1").val() == "maritialstatus") {
                    select_arr["input_field_name"] = "selmar1";
                    select_arr["input_field_value"] = $("#selmar1").val();
                    codn = $("#selField1").val() + "='" + $("#selmar1").val() + "'";

                } else if ($("#selField1").val() == "typeofbusiness") {
                    select_arr["input_field_name"] = "selBus1";
                    select_arr["input_field_value"] = $("#selBus1").val();
                    codn = $("#selField1").val() + " like '%" + $("#selBus1").val() + "%'";
                } else if ($("#selField1").val() == "name") {
                    select_arr["input_field_name"] = "txtSearch1";
                    select_arr["input_field_value"] = $("#txtSearch1").val();
                    //cookie_array = select_arr;
                    var search_value_txt1 = $("#txtSearch1").val();
                    search_value_txt1 = search_value_txt1.replace(" ", "%");
                    codn = "(CONCAT_WS('', firstname, middlename, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', firstname, lastname, middlename) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, firstname, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, lastname, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, middlename, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, firstname, lastname) LIKE '%" + search_value_txt1 + "%')";
                    //alert(codn);
                } else {
                    select_arr["input_field_name"] = "txtSearch1";
                    select_arr["input_field_value"] = $("#txtSearch1").val();
                    codn = $("#selField1").val() + " like '%" + $("#txtSearch1").val() + "%'";
                    //alert(codn);
                }
                cookie_array.push(select_arr);
                // setCookie("input_array", JSON.stringify(cookie_array), 1);
            }
            if (cnt >= 2) {
                var select_arr = {}
                select_arr["selected_field_id"] = "selField2";
                select_arr["selected_field_value"] = $("#selField2").val();
                select_arr["selected_field_condition_id"] = "selOp1";
                select_arr["selected_field_condition_value"] = $("#selOp1").val();
                if ($("#selField2").val() == "age") {
                    if (isNaN($("#ageFrom2").val()) || $("#ageFrom2").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageFrom2").focus();
                    } else if (isNaN($("#ageTo2").val()) || $("#ageTo2").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageTo2").focus();
                    } else {
                        select_arr["input_field_name_1"] = "ageFrom2";
                        select_arr["input_field_value_1"] = $("#ageFrom2").val();
                        select_arr["input_field_name_2"] = "ageTo2";
                        select_arr["input_field_value_2"] = $("#ageTo2").val();
                        var d = new Date();
                        var n1 = d.getFullYear() - $("#ageFrom2").val();
                        var n2 = d.getFullYear() - $("#ageTo2").val();
                        var sd = "'" + n2 + "-01-01' and '" + n1 + "-12-31'";
                        codn = codn + " " + $("#selOp1").val() + " dateofbirth between " + sd;
                    }
                } else {
                    if ($("#selField2").val() == "bloodgroup") {
                        select_arr["input_field_name"] = "selBG2";
                        select_arr["input_field_value"] = $("#selBG2").val();
                        codn = codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + "='" + $("#selBG2").val() + "'";
                    } else if ($("#selField2").val() == "gender") {
                        select_arr["input_field_name"] = "selGen2";
                        select_arr["input_field_value"] = $("#selGen2").val();
                        codn = codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + "='" + $("#selGen2").val() + "'";
                    } else if ($("#selField2").val() == "mobileno") {
                        select_arr["input_field_name"] = "txtSearch2";
                        select_arr["input_field_value"] = $("#txtSearch2").val();
                        //codn=codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + " like '%" + $("#txtSearch2").val() + "%' OR alternativemobileno like '%" + $("#txtSearch2").val() + "%'" ;
                        codn = codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + " like '%" + $("#txtSearch2").val() + "%' OR alternativemobileno like '%" + $("#txtSearch2").val() + "%' OR residentalphone like '%" + $("#txtSearch2").val() + "%' OR officephone like '%" + $("#txtSearch2").val() + "%'";
                        //alert(codn);
                    } else if ($("#selField2").val() == "maritialstatus") {
                        select_arr["input_field_name"] = "selmar2";
                        select_arr["input_field_value"] = $("#selmar2").val();
                        codn = codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + "='" + $("#selmar2").val() + "'";
                    } else if ($("#selField2").val() == "typeofbusiness") {
                        select_arr["input_field_name"] = "selBus2";
                        select_arr["input_field_value"] = $("#selBus2").val();
                        codn = codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + " like '%" + $("#selBus2").val() + "%'";
                    } else if ($("#selField2").val() == "name") {
                        select_arr["input_field_name"] = "txtSearch2";
                        select_arr["input_field_value"] = $("#txtSearch2").val();
                        var search_value_txt1 = $("#txtSearch2").val();
                        search_value_txt1 = search_value_txt1.replace(" ", "%");
                        codn = codn + " " + $("#selOp1").val() + " (CONCAT_WS('', firstname, middlename, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', firstname, lastname, middlename) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, firstname, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, lastname, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, middlename, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, firstname, lastname) LIKE '%" + search_value_txt1 + "%')";
                    } else {
                        select_arr["input_field_name"] = "txtSearch2";
                        select_arr["input_field_value"] = $("#txtSearch2").val();
                        codn = codn + " " + $("#selOp1").val() + " " + $("#selField2").val() + " like '%" + $("#txtSearch2").val() + "%'";
                    }
                }
                cookie_array.push(select_arr);
            }
            if (cnt >= 3) {
                var select_arr = {}
                select_arr["selected_field_id"] = "selField3";
                select_arr["selected_field_value"] = $("#selField3").val();
                select_arr["selected_field_condition_id"] = "selOp2";
                select_arr["selected_field_condition_value"] = $("#selOp2").val();
                if ($("#selField3").val() == "age") {
                    if (isNaN($("#ageFrom3").val()) || $("#ageFrom3").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageFrom3").focus();
                    } else if (isNaN($("#ageTo3").val()) || $("#ageTo3").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageTo3").focus();
                    } else {
                        select_arr["input_field_name_1"] = "ageFrom3";
                        select_arr["input_field_value_1"] = $("#ageFrom3").val();
                        select_arr["input_field_name_2"] = "ageTo3";
                        select_arr["input_field_value_2"] = $("#ageTo3").val();
                        var d = new Date();
                        var n1 = d.getFullYear() - $("#ageFrom3").val();
                        var n2 = d.getFullYear() - $("#ageTo3").val();
                        var sd = "'" + n2 + "-01-01' and '" + n1 + "-12-31'";
                        codn = codn + " " + $("#selOp2").val() + " dateofbirth between " + sd;
                    }
                } else {
                    if ($("#selField3").val() == "bloodgroup") {
                        select_arr["input_field_name"] = "selBG3";
                        select_arr["input_field_value"] = $("#selBG3").val();
                        codn = codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + "='" + $("#selBG3").val() + "'";
                    } else if ($("#selField3").val() == "gender") {
                        select_arr["input_field_name"] = "selGen3";
                        select_arr["input_field_value"] = $("#selGen3").val();
                        codn = codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + "='" + $("#selGen3").val() + "'";
                    } else if ($("#selField3").val() == "mobileno") {
                        select_arr["input_field_name"] = "txtSearch3";
                        select_arr["input_field_value"] = $("#txtSearch3").val();
                        //codn=codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + " like '%" + $("#txtSearch3").val() + "%' OR alternativemobileno like '%" + $("#txtSearch3").val() + "%'" ;

                        codn = codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + " like '%" + $("#txtSearch3").val() + "%' OR alternativemobileno like '%" + $("#txtSearch3").val() + "%' OR residentalphone like '%" + $("#txtSearch3").val() + "%' OR officephone like '%" + $("#txtSearch3").val() + "%'";

                        //alert(codn);
                    } else if ($("#selField3").val() == "maritialstatus") {
                        select_arr["input_field_name"] = "selmar3";
                        select_arr["input_field_value"] = $("#selmar3").val();
                        codn = codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + "='" + $("#selmar3").val() + "'";
                    } else if ($("#selField3").val() == "typeofbusiness") {
                        select_arr["input_field_name"] = "selBus3";
                        select_arr["input_field_value"] = $("#selBus3").val();
                        codn = codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + " like '%" + $("#selBus3").val() + "%'";
                    } else if ($("#selField3").val() == "name") {
                        select_arr["input_field_name"] = "txtSearch3";
                        select_arr["input_field_value"] = $("#txtSearch3").val();
                        var search_value_txt1 = $("#txtSearch3").val();
                        search_value_txt1 = search_value_txt1.replace(" ", "%");
                        codn = codn + " " + $("#selOp2").val() + " (CONCAT_WS('', firstname, middlename, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', firstname, lastname, middlename) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, firstname, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, lastname, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, middlename, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, firstname, lastname) LIKE '%" + search_value_txt1 + "%')";
                    } else {
                        select_arr["input_field_name"] = "txtSearch3";
                        select_arr["input_field_value"] = $("#txtSearch3").val();
                        codn = codn + " " + $("#selOp2").val() + " " + $("#selField3").val() + " like '%" + $("#txtSearch3").val() + "%'";
                    }
                }
                cookie_array.push(select_arr);
            }
            if (cnt >= 4) {
                var select_arr = {}
                select_arr["selected_field_id"] = "selField4";
                select_arr["selected_field_value"] = $("#selField4").val();
                select_arr["selected_field_condition_id"] = "selOp3";
                select_arr["selected_field_condition_value"] = $("#selOp3").val();
                if ($("#selField4").val() == "age") {
                    if (isNaN($("#ageFrom4").val()) || $("#ageFrom4").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageFrom4").focus();
                    } else if (isNaN($("#ageTo4").val()) || $("#ageTo4").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageTo4").focus();
                    } else {
                        select_arr["input_field_name_1"] = "ageFrom4";
                        select_arr["input_field_value_1"] = $("#ageFrom4").val();
                        select_arr["input_field_name_2"] = "ageTo4";
                        select_arr["input_field_value_2"] = $("#ageTo4").val();
                        var d = new Date();
                        var n1 = d.getFullYear() - $("#ageFrom4").val();
                        var n2 = d.getFullYear() - $("#ageTo4").val();
                        var sd = "'" + n2 + "-01-01' and '" + n1 + "-12-31'";
                        codn = codn + " " + $("#selOp3").val() + " dateofbirth between " + sd;
                    }
                } else {
                    if ($("#selField4").val() == "bloodgroup") {
                        select_arr["input_field_name"] = "selBG4";
                        select_arr["input_field_value"] = $("#selBG4").val();
                        codn = codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + "='" + $("#selBG4").val() + "'";
                    } else if ($("#selField4").val() == "gender") {
                        select_arr["input_field_name"] = "selGen4";
                        select_arr["input_field_value"] = $("#selGen4").val();
                        codn = codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + "='" + $("#selGen4").val() + "'";
                    } else if ($("#selField4").val() == "mobileno") {
                        select_arr["input_field_name"] = "txtSearch4";
                        select_arr["input_field_value"] = $("#txtSearch4").val();
                        //codn=codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + " like '%" + $("#txtSearch4").val() + "%' OR alternativemobileno like '%" + $("#txtSearch4").val() + "%'" ;
                        codn = codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + " like '%" + $("#txtSearch4").val() + "%' OR alternativemobileno like '%" + $("#txtSearch4").val() + "%' OR residentalphone like '%" + $("#txtSearch4").val() + "%' OR officephone like '%" + $("#txtSearch4").val() + "%'";
                        //alert(codn);
                    } else if ($("#selField4").val() == "maritialstatus") {
                        select_arr["input_field_name"] = "selmar4";
                        select_arr["input_field_value"] = $("#selmar4").val();
                        codn = codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + "='" + $("#selmar4").val() + "'";
                    } else if ($("#selField4").val() == "typeofbusiness") {
                        select_arr["input_field_name"] = "selBus4";
                        select_arr["input_field_value"] = $("#selBus4").val();
                        codn = codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + " like '%" + $("#selBus4").val() + "%'";
                    } else if ($("#selField4").val() == "name") {
                        select_arr["input_field_name"] = "txtSearch4";
                        select_arr["input_field_value"] = $("#txtSearch4").val();
                        var search_value_txt1 = $("#txtSearch4").val();
                        search_value_txt1 = search_value_txt1.replace(" ", "%");
                        codn = codn + " " + $("#selOp3").val() + " (CONCAT_WS('', firstname, middlename, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', firstname, lastname, middlename) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, firstname, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, lastname, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, middlename, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, firstname, lastname) LIKE '%" + search_value_txt1 + "%')";
                    } else {
                        select_arr["input_field_name"] = "txtSearch4";
                        select_arr["input_field_value"] = $("#txtSearch4").val();
                        codn = codn + " " + $("#selOp3").val() + " " + $("#selField4").val() + " like '%" + $("#txtSearch4").val() + "%'";
                    }
                }
                cookie_array.push(select_arr);
            }
            if (cnt >= 5) {
                var select_arr = {}
                select_arr["selected_field_id"] = "selField5";
                select_arr["selected_field_value"] = $("#selField5").val();
                select_arr["selected_field_condition_id"] = "selOp4";
                select_arr["selected_field_condition_value"] = $("#selOp4").val();
                if ($("#selField5").val() == "age") {
                    if (isNaN($("#ageFrom5").val()) || $("#ageFrom5").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageFrom5").focus();
                    } else if (isNaN($("#ageTo5").val()) || $("#ageTo5").val() == "") {
                        alert("Invalid value for age. Put only numbers. E.g.: 26");
                        document.getElementById("ageTo5").focus();
                    } else {
                        select_arr["input_field_name_1"] = "ageFrom5";
                        select_arr["input_field_value_1"] = $("#ageFrom5").val();
                        select_arr["input_field_name_2"] = "ageTo5";
                        select_arr["input_field_value_2"] = $("#ageTo5").val();
                        var d = new Date();
                        var n1 = d.getFullYear() - $("#ageFrom5").val();
                        var n2 = d.getFullYear() - $("#ageTo5").val();
                        var sd = "'" + n2 + "-01-01' and '" + n1 + "-12-31'";
                        codn = codn + " " + $("#selOp4").val() + " dateofbirth between " + sd;
                    }
                } else {
                    if ($("#selField5").val() == "bloodgroup") {
                        select_arr["input_field_name"] = "selBG5";
                        select_arr["input_field_value"] = $("#selBG5").val();
                        codn = codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + "='" + $("#selBG5").val() + "'";
                    } else if ($("#selField5").val() == "gender") {
                        select_arr["input_field_name"] = "selGen5";
                        select_arr["input_field_value"] = $("#selGen5").val();
                        codn = codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + "='" + $("#selGen5").val() + "'";
                    } else if ($("#selField5").val() == "mobileno") {
                        select_arr["input_field_name"] = "txtSearch5";
                        select_arr["input_field_value"] = $("#txtSearch5").val();
                        //codn=codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + " like '%" + $("#txtSearch5").val() + "%' OR alternativemobileno like '%" + $("#txtSearch5").val() + "%'" ;

                        codn = codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + " like '%" + $("#txtSearch5").val() + "%' OR alternativemobileno like '%" + $("#txtSearch5").val() + "%' OR residentalphone like '%" + $("#txtSearch5").val() + "%' OR officephone like '%" + $("#txtSearch5").val() + "%'";

                        //alert(codn);
                    } else if ($("#selField5").val() == "maritialstatus") {
                        select_arr["input_field_name"] = "selmar5";
                        select_arr["input_field_value"] = $("#selmar5").val();
                        codn = codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + "='" + $("#selmar5").val() + "'";
                    } else if ($("#selField5").val() == "typeofbusiness") {
                        select_arr["input_field_name"] = "selBus5";
                        select_arr["input_field_value"] = $("#selBus5").val();
                        codn = codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + " like '%" + $("#selBus5").val() + "%'";
                    } else if ($("#selField5").val() == "name") {
                        select_arr["input_field_name"] = "txtSearch5";
                        select_arr["input_field_value"] = $("#txtSearch5").val();
                        var search_value_txt1 = $("#txtSearch5").val();
                        search_value_txt1 = search_value_txt1.replace(" ", "%");
                        codn = codn + " " + $("#selOp4").val() + " (CONCAT_WS('', firstname, middlename, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', firstname, lastname, middlename) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, firstname, lastname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', middlename, lastname, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, middlename, firstname) LIKE '%" + search_value_txt1 + "%' OR CONCAT_WS('', lastname, firstname, lastname) LIKE '%" + search_value_txt1 + "%')";
                    } else {
                        select_arr["input_field_name"] = "txtSearch5";
                        select_arr["input_field_value"] = $("#txtSearch5").val();
                        codn = codn + " " + $("#selOp4").val() + " " + $("#selField5").val() + " like '%" + $("#txtSearch5").val() + "%'";
                    }
                }
                cookie_array.push(select_arr);
            }
            var Profile = $('input[name=Profile]:checked').val();
            setCookie("input_array", JSON.stringify(cookie_array), 1);
            setCookie("profile", Profile, 1);
            setCookie("back", "0", 1);
            $.ajax({
                type: "POST",
                url: "appSearchResult.php",
                data: {searchterm: codn, userid: $("#hdnID").val(), Profile: Profile},
                success: function (response) {
                    $("#searchResultPanel").show();
                    $("#disp_search_result").html(response);
                    new Clipboard('.btn1');
                }
            });
        }
    }

    function row1() {
        document.getElementById("row2").style.display = "block";
        document.getElementById("addRow1").style.display = "none";
        document.getElementById("addRow2").style.display = "block";
        document.getElementById("selOp1").style.display = "block";
        cnt = 2;
    }

    function row2() {
        document.getElementById("row3").style.display = "block";
        document.getElementById("addRow2").style.display = "none";
        document.getElementById("addRow3").style.display = "block";
        document.getElementById("remove2").style.display = "none";
        document.getElementById("selOp2").style.display = "block";
        cnt = 3;
    }

    function row3() {
        document.getElementById("row4").style.display = "block";
        document.getElementById("addRow3").style.display = "none";
        document.getElementById("addRow4").style.display = "block";
        document.getElementById("remove3").style.display = "none";
        document.getElementById("selOp3").style.display = "block";
        cnt = 4;
    }

    function row4() {
        document.getElementById("row5").style.display = "block";
        document.getElementById("addRow4").style.display = "none";
        document.getElementById("remove4").style.display = "none";
        document.getElementById("selOp4").style.display = "block";
        cnt = 5;
    }

    function removeRow5() {
        document.getElementById("row5").style.display = "none";
        document.getElementById("addRow4").style.display = "block";
        document.getElementById("remove4").style.display = "block";
        document.getElementById("selOp4").style.display = "none";
        cnt = 4;
    }

    function removeRow4() {
        document.getElementById("row4").style.display = "none";
        document.getElementById("addRow3").style.display = "block";
        document.getElementById("addRow4").style.display = "none";
        document.getElementById("remove3").style.display = "block";
        document.getElementById("selOp3").style.display = "none";
        cnt = 3;
    }

    function removeRow3() {
        document.getElementById("row3").style.display = "none";
        document.getElementById("addRow2").style.display = "block";
        document.getElementById("addRow3").style.display = "none";
        document.getElementById("remove2").style.display = "block";
        document.getElementById("selOp2").style.display = "none";
        cnt = 2;
    }

    function removeRow2() {
        document.getElementById("row2").style.display = "none";
        document.getElementById("addRow1").style.display = "block";
        document.getElementById("addRow2").style.display = "none";
        document.getElementById("selOp1").style.display = "none";
        cnt = 1;
    }

    $(function () {
        new Clipboard('.btn1');
    });

    function buttonclick() {
        $('#myModalCopy').modal('show');
        setTimeout("$('#myModalCopy').modal('hide');", 2000);
    }



    // Set a Cookie
    function setCookie(cName, cValue, expDays) {
        let date = new Date();
        date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
    }

    function getCookie(name) {
        var dc = document.cookie;
        var prefix = name + "=";
        var begin = dc.indexOf("; " + prefix);
        if (begin == -1) {
            begin = dc.indexOf(prefix);
            if (begin != 0) return null;
        } else {
            begin += 2;
            var end = document.cookie.indexOf(";", begin);
            if (end == -1) {
                end = dc.length;
            }
        }
        // because unescape has been deprecated, replaced with decodeURI
        //return unescape(dc.substring(begin + prefix.length, end));
        return decodeURI(dc.substring(begin + prefix.length, end));
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    var cookie_setting = 1;
    var back = (getCookie("back") !== null) ? readCookie("back") : 0;
    if (back == 0) {
        setCookie("input_array", "", -1);
        setCookie("profile", "", -1);
    }
    $(document).ready(function () {
        if (getCookie("input_array") !== null) {
            var data = (getCookie("input_array") != "") ? JSON.parse(readCookie("input_array")) : [];
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    var input = data[i];
                    $("#" + input.selected_field_id).val(input.selected_field_value).trigger('change');
                    if (i > 0) {
                        $("#" + input.selected_field_condition_id).val(input.selected_field_condition_value);
                    }
                    if (i == 1) {
                        row1();
                    } else if (i == 2) {
                        row2();
                    } else if (i == 3) {
                        row3();
                    } else if (i == 4) {
                        row4();
                    }
                    if (input.selected_field_value == "age") {
                        console.log("check nan - 1" + isNaN(input.input_field_value_1));
                        console.log("check nan - 2" + isNaN(input.input_field_value_2));
                        $("#" + input.input_field_name_1).val(input.input_field_value_1);
                        $("#" + input.input_field_name_2).val(input.input_field_value_2);
                    } else {
                        $("#" + input.input_field_name).val(input.input_field_value);
                    }
                }
                if (getCookie("profile") !== null) {
                    $("input[name=Profile][value='" + readCookie("profile") + "']").prop("checked", true);
                }
                search();
            }
        }
        // console.log();
    })

    function profilepage(id, userid) {
        setCookie("back", 1, 1);
        window.location.href = "appViewProfile.php?id=" + id + "&userid=" + userid;
    }

    function familymember(member_id, user_id) {
        setCookie("back", 1, 1);
        window.location.href = "appFamilyTree.php?member_id=" + member_id + "&userid=" + user_id;
    }


</script>

</body>

</html>
