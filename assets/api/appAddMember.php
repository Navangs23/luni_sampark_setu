<?php
include("db_connect.php");
$db = new DB_Connect();
$con = $db->connect();
$op = "";
$id = "-1";
$op = $_REQUEST["op"];
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
}


$qry = "Select count(*) as Cnt,id,lastname,residentaladdress,residentalsuburb,residentalcity,residentalpincode,residentalstate,residentalcountry,residentalphone,villagename from pp_profileinfo where ID='" . $id . "'";
$run = mysqli_query($con, $qry);
$row = mysqli_fetch_array($run);
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Asanjo Dumra</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">-->
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100% !important; /*change to YOUR page height*/
            background: url(img/loader.gif) 50% 50% no-repeat #000000;
            filter: alpha(opacity=50);
            -moz-opacity: 0.5;
            -khtml-opacity: 0.5;
            opacity: 0.5;
            z-index: 998;
        }

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
                height: 120px;
                width: auto;

            }

            .adsimg2 {
                margin-right: 150px;
            }
        }

        .required {
            color: #ff0000;
        }

    </style>

    <!-- Modern UI Theme -->
    <style>
        /* Brand Colors */
        :root {
            --brand-primary: #D81C5B;
            --brand-secondary: #269CD8;
            --brand-success: #4BB649;
            --brand-warning: #F6911D;
            --bg-light: #f4f7f6;
            --card-bg: #ffffff;
            --text-main: #34495e;
            --text-muted: #7f8c8d;
            --border-radius: 12px;
            --shadow-soft: 0 10px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* --- Base Styles (Mobile First / Edge-to-Edge) --- */

        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            background-color: #FAFAFAFF; /* White bg for seamless mobile card look */
            font-family: 'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: var(--text-main);
            padding-bottom: 60px;
        }

        /* --- Unified Global Layout (Mobile & Desktop Common) --- */

        section.wrapper {
            width: 100%;
            max-width: 800px !important; /* Constrain width for larger screens */
            margin: 0 auto !important; /* Center on larger screens */
            padding: 10px !important; /* Small padding to prevent edge touching */
        }

        /* Grid Fixes - Force Stacking Everywhere */
        #register_form > .row {
            margin-left: 0;
            margin-right: 0;
        }

        #register_form > .row > .col-lg-12 {
            padding-left: 0;
            padding-right: 0;
        }

        /* Force all columns to stack vertically globally */
        .col-md-3, .col-md-4, .col-md-6, .col-md-12, .col-sm-6, .col-xs-12 {
            width: 100% !important;
            float: none !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Unified Card Style (Modern Card everywhere) */
        .panel {
            border: none !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05) !important; /* Soft shadow */
            border-radius: 12px !important; /* Rounded corners everywhere */
            margin-bottom: 20px;
            /* border-bottom: 8px solid var(--bg-light) !important;  Removed: using standard margin now */
            background-color: var(--card-bg);
            padding: 0; /* Clean panel */
            overflow: hidden; /* Contains children for border-radius */
        }

        .panel:last-child {
            border-bottom: none !important;
        }

        .panel-heading {
            background-color: var(--brand-primary) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            font-size: 18px;
            font-weight: 700;
            padding: 15px 20px;
            text-transform: uppercase;
            border-radius: 12px 12px 0 0 !important; /* Rounded top */
        }

        .panel-body {
            padding: 20px 20px; /* Consistent internal padding */
        }

        /* Uniform Internal Spacing */
        .form-group {
            margin-bottom: 20px !important; /* More breathing room */
        }

        /* Brand Button - Consistent everywhere */
        #btnSubmit {
            width: 100%;
            height: 55px;
            font-size: 16px;
            margin-top: 20px;
            background: linear-gradient(135deg, var(--brand-primary) 0%, #ff4b8b 100%) !important;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px !important;
            box-shadow: 0 4px 10px rgba(216, 28, 91, 0.4);
            cursor: pointer;
        }

        #btnSubmit:hover {
            box-shadow: 0 6px 15px rgba(216, 28, 91, 0.5);
            transform: translateY(-1px);
        }

        /* --- Utility Helpers (Refactored from Inline) --- */
        .d-none {
            display: none; /* jQuery .show() friendly */
        }

        .d-block {
            display: block !important;
        }

        .p-10 {
            padding: 10px !important;
        }

        .pt-30 {
            padding-top: 30px !important;
        }

        .mb-15 {
            margin-bottom: 15px !important;
        }

        .crop-container {
            width: 350px;
            margin-top: 30px;
        }

        .text-error {
            color: red;
        }

    </style>
</head>


<body style="background: #FAFAFAFF;">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p></p>
                <div id="instructionalert" class="p-10"></div>
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-secondary" onClick="checkmobile();">OK</button>-->
            </div>
        </div>
    </div>
</div>
<div class="overlay d-none" id="overlaydiv"></div>
<!-- container section start -->
<section id="container" class="">


    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->

            <form class="form-validate form-horizontal" id="register_form" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Basic Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!-- Names Row -->
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="firstname" class="control-label">First Name / પ્રથમ
                                                        નામ<span class="required">*</span></label>
                                                    <input type="hidden" id="hdnop"
                                                           value='<?php echo $_REQUEST["op"]; ?>'>
                                                    <input type="hidden" id="hdnID"
                                                           value='<?php echo $_REQUEST["id"]; ?>'>
                                                    <input class="form-control" id="firstname" name="firstname"
                                                           type="text" autocomplete="off" maxlength="50"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="middlename" class="control-label">Middle Name / વચલું
                                                        નામ<span class="required">*</span></label>
                                                    <input class="form-control" id="middlename" name="middlename"
                                                           type="text" autocomplete="off" maxlength="50"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="grandfathername" class="control-label">Grandfather/Father
                                                        Name / દાદા/પિતા<span class="required">*</span></label>
                                                    <input class="form-control" id="grandfathername"
                                                           name="grandfathername" type="text" autocomplete="off"
                                                           maxlength="50"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="lastname" class="control-label">Last Name / અટક<span
                                                                class="required">*</span></label>
                                                    <input class="form-control" id="lastname" name="lastname"
                                                           type="text" maxlength="50"
                                                           autocomplete="off" <?php if ($row["Cnt"] > 0) {
                                                        echo "value='" . $row["lastname"] . "'";
                                                    } ?> />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Personal Details Row -->
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Gender / જાતિ<span
                                                                class="required">*</span></label>
                                                    <br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender_male" value="Male"
                                                               onclick="handleClick(this);" checked="checked"> Male
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="gender" id="gender_female"
                                                               value="Female" onclick="handleClick(this);"> Female
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="dateofbirth" class="control-label">Date of Birth / જન્મ
                                                        તારીખ<span class="required">*</span></label>
                                                    <input class="form-control" id="dateofbirth" name="dateofbirth"
                                                           type="date" onblur="ValidateDOB()"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="maritialstatus" class="control-label">Marital Status /
                                                        વૈવાહિક સ્થિતિ<span class="required">*</span></label>
                                                    <select class="form-control" id="maritialstatus"
                                                            name="maritialstatus">
                                                        <option value="">Select</option>
                                                        <option value="Unmarried">Unmarried</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Divorced">Divorced</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12 d-none" id="divanniversarydate">
                                                <div class="form-group">
                                                    <label for="anniversarydate" class="control-label">Anniversary Date
                                                        / લગ્નની તારીખ</label>
                                                    <input class="form-control" id="anniversarydate"
                                                           name="anniversarydate" type="date"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12 d-none" id="diveligibleformarriage">
                                                <div class="form-group">
                                                    <label for="eligibleformarriage" class="control-label">Is eligible
                                                        for marriage?</label>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" id="eligibleformarriage"
                                                                      name="eligibleformarriage" value="Yes">
                                                            Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional Info Row -->
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="photo" class="control-label">Photo / ફોટોગ્રાફ<span
                                                                class="required">*</span></label>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <input type="file" name="photo" id="photo" accept="image/*"
                                                                   class="form-control p-10 mb-15"/>
                                                        </div>
                                                        <div class="col-xs-12 d-none" id="photodiv">
                                                            <img src="" class="img-thumbnail" width="auto" height="50px"
                                                                 id="editprofilephoto"/>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div id="uploaded_image"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="bloodgroup" class="control-label">Blood Group / બ્લડ
                                                        ગ્રુપ<span class="required">*</span></label>
                                                    <select class="form-control" id="bloodgroup" name="bloodgroup">
                                                        <option value="">Select</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                        <option value="Dont know">Dont know</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="relationshipwithmainperson" class="control-label">Relationship
                                                        / સંબંધ<span class="required">*</span></label>
                                                    <select class="form-control" id="relationshipwithmainperson"
                                                            name="relationshipwithmainperson"
                                                            onchange="checkrelationshipwithmainperson()">
                                                        <option value="">Select</option>
                                                        <?php if ($_REQUEST["op"] != "Add") { ?>
                                                            <option value="Self">Self</option>
                                                        <?php } ?>
                                                        <option value="Father">Father</option>
                                                        <option value="Mother">Mother</option>
                                                        <option value="Father-in-law">Father-in-law</option>
                                                        <option value="Mother-in-law">Mother-in-law</option>
                                                        <option value="Son">Son</option>
                                                        <option value="Daughter">Daughter</option>
                                                        <option value="Husband">Husband</option>
                                                        <option value="Wife">Wife</option>
                                                        <option value="Brother">Brother</option>
                                                        <option value="Sister">Sister</option>
                                                        <option value="Daughter in Law">Daughter in Law</option>
                                                        <option value="Son in Law">Son in Law</option>
                                                        <option value="Grand son">Grand son</option>
                                                        <option value="Grand daughter">Grand daughter</option>
                                                        <option value="Niyani">Niyani</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Deceased / મરણ</label>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="deceased" name="deceased"
                                                                   value="Yes" onchange="showdeathdate();"> Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 d-none" id="DeathAnniversaryDiv">
                                                <div class="form-group">
                                                    <label for="dateofdeathanniversary" class="control-label">Date of
                                                        demise / મરણ ની તારીખ</label>
                                                    <input class="form-control" id="dateofdeathanniversary"
                                                           name="dateofdeathanniversary" type="date"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Contact Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <?php if ($op == "Add") { ?>
                                                    <div class="form-group" id="selfmobile">
                                                        <label for="mobileno" class="control-label">Mobile No / મોબાઇલ
                                                            નંબર<span class="required">*</span></label>
                                                        <input class="form-control" id="mobileno" name="mobileno"
                                                               type="text" maxlength="20" autocomplete="off"/>
                                                    </div>
                                                    <div class="form-group d-none" id="mobilenonotself">
                                                        <label for="lblmobilenonotself" class="control-label">Mobile No
                                                            / મોબાઇલ નંબર</label>
                                                        <input class="form-control" id="lblmobilenonotself"
                                                               name="mobilenonotself" type="text" maxlength="20"
                                                               autocomplete="off"/>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-group" id="selfmobile">
                                                        <label for="mobileno" class="control-label">Mobile No / મોબાઇલ
                                                            નંબર<span class="required">*</span></label>
                                                        <input class="form-control" id="mobileno" name="mobileno"
                                                               type="text" maxlength="20" autocomplete="off"/>
                                                    </div>
                                                    <div class="form-group d-none" id="mobilenonotself">
                                                        <label for="lblmobilenonotself" class="control-label">Mobile No
                                                            / મોબાઇલ નંબર</label>
                                                        <input class="form-control" id="lblmobilenonotself"
                                                               name="mobilenonotself" type="text" maxlength="20"
                                                               autocomplete="off"/>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="emailid" class="control-label">Email Id / ઇમેઇલ
                                                        આઇડી</label>
                                                    <input class="form-control" id="emailid" name="emailid" type="email"
                                                           autocomplete="off" maxlength="100"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="alternativemobileno" class="control-label">Alternative
                                                        Mobile No / વૈકલ્પિક મોબાઇલ નંબર</label>
                                                    <input class="form-control" id="alternativemobileno"
                                                           name="alternativemobileno" type="tel" maxlength="20"
                                                           autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="displaycontactdetails" class="control-label">Display
                                                        Contact Details? / સંપર્ક વિગતો દર્શાવો</label>
                                                    <select class="form-control" id="displaycontactdetails"
                                                            name="displaycontactdetails">
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Education Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="educationqualification" class="control-label">Education
                                                        Qualification / શૈક્ષણિક લાયકાત</label>
                                                    <input class="form-control" id="educationqualification"
                                                           name="educationqualification" type="text" autocomplete="off"
                                                           maxlength="500"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="otherachivements" class="control-label">Other
                                                        Achivements / અન્ય સિદ્ધિઓ</label>
                                                    <textarea class="form-control" id="otherachivements"
                                                              name="otherachivements" autocomplete="off"
                                                              maxlength="500"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Residence Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentaladdress" class="control-label">Residential
                                                        Address / રહેઠાણનું સરનામું<span
                                                                class="required">*</span></label>
                                                    <textarea class="form-control" id="residentaladdress"
                                                              name="residentaladdress" maxlength="500" type="text"
                                                              autocomplete="off"><?php if ($row["Cnt"] > 0) {
                                                            echo $row["residentaladdress"];
                                                        } ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentalsuburb" class="control-label">Residential
                                                        Suburb / રહેઠાણ ઉપનગર<span class="required">*</span></label>
                                                    <select class="form-control" id="residentalsuburb"
                                                            name="residentalsuburb">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentalpincode" class="control-label">Residential
                                                        Pincode / રહેઠાણનો પિનકોડ<span class="required">*</span></label>
                                                    <div id="divpincodetext">
                                                        <input class="form-control" id="residentalpincode"
                                                               name="residentalpincode" maxlength="6" autocomplete="off"
                                                               type="number" <?php if ($row["Cnt"] > 0) {
                                                            echo "value='" . $row["residentalpincode"] . "'";
                                                        } ?>/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentalcity" class="control-label">Residential City /
                                                        રહેઠાણ શહેર<span class="required">*</span></label>
                                                    <input class="form-control" id="residentalcity"
                                                           name="residentalcity" type="text" maxlength="50"
                                                           autocomplete="off" <?php if ($row["Cnt"] > 0) {
                                                        echo "value='" . $row["residentalcity"] . "'";
                                                    } ?>/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentalstate" class="control-label">Residential State
                                                        / રહેઠાણ રાજ્ય<span class="required">*</span></label>
                                                    <input class="form-control" id="residentalstate"
                                                           name="residentalstate" type="text" maxlength="50"
                                                           autocomplete="off" <?php if ($row["Cnt"] > 0) {
                                                        echo "value='" . $row["residentalstate"] . "'";
                                                    } ?>/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentalcountry" class="control-label">Residential
                                                        Country / રહેઠાણ દેશ<span class="required">*</span></label>
                                                    <input class="form-control" id="residentalcountry"
                                                           name="residentalcountry" type="text" maxlength="50"
                                                           autocomplete="off" <?php if ($row["Cnt"] > 0) {
                                                        echo "value='" . $row["residentalcountry"] . "'";
                                                    } ?>/>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label for="residentalphone" class="control-label">Residential Phone
                                                        / રહેઠાણનો ફોન</label>
                                                    <input class="form-control" id="residentalphone"
                                                           name="residentalphone" autocomplete="off" maxlength="50"
                                                           type="number" <?php if ($row["Cnt"] > 0) {
                                                        echo "value='" . $row["residentalphone"] . "'";
                                                    } ?>/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Gyati and Sampraday Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="sampraday" class="control-label">Main Gyati / મુખ્ય
                                                        જ્ઞાતિ<span class="required">*</span></label>
                                                    <select class="form-control" id="sampraday" name="sampraday"
                                                            autocomplete="off">
                                                        <option value="">Select</option>
                                                        <option value="KVO">KVO</option>
                                                        <option value="KDO">KDO</option>
                                                        <option value="Vagad">Vagad</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="subreligion" class="control-label">Sub Gyati / પેટા
                                                        જ્ઞાતિ<span class="required">*</span></label>
                                                    <select class="form-control" id="subreligion" name="subreligion"
                                                            autocomplete="off">
                                                        <option value="">Select</option>
                                                        <option value="Deravasi">Deravasi</option>
                                                        <option value="Sthanakvasi">Sthanakvasi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="subsubreligion" class="control-label">Sampraday /
                                                        સંપ્રદાય<span class="required">*</span></label>
                                                    <select class="form-control" id="subsubreligion"
                                                            name="subsubreligion" autocomplete="off">
                                                        <option value="">Select</option>
                                                        <option value="Achalgachchh">Achalgachchh</option>
                                                        <option value="Parshvchandra Gachchh">Parshvachandra Gatch
                                                        </option>
                                                        <option value="Tapgachchh">Tapgachchh</option>
                                                        <option value="8 Koti Moti Paksh">8 Koti Moti Paksh</option>
                                                        <option value="8 Koti Nani Paksh">8 Koti Nani Paksh</option>
                                                        <option value="6 Koti Moti Paksh">6 Koti Moti Paksh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="ismember" class="control-label">Is Member / સભ્ય છે<span
                                                                class="required">*</span></label>
                                                    <select class="form-control" id="ismember" name="ismember">
                                                        <option value="">Select</option>
                                                        <option value="Shree KVO Deravasi Jain Mahajan Member">Shree KVO
                                                            Deravasi Jain Mahajan Member
                                                        </option>
                                                        <option value="Shree KVO Sthanakvasi Jain Mahajan Member">Shree
                                                            KVO Sthanakvasi Jain Mahajan Member
                                                        </option>
                                                        <option value="Shree Kutchi Dasha Oswal Jain Gyati">Shree Kutchi
                                                            Dasha Oswal Jain Gyati
                                                        </option>
                                                        <option value="Shri Vagad Visa Oswal Chovishi Mahajan">Shri
                                                            Vagad Visa Oswal Chovishi Mahajan
                                                        </option>
                                                        <option value="None">None</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Work Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="natureofwork" class="control-label">Nature Of Work / કામ
                                                        નો પ્રકાર<span class="required">*</span></label>
                                                    <select class="form-control" id="natureofwork" name="natureofwork"
                                                            autocomplete="off">
                                                        <option value="">Select</option>
                                                        <option value="Job/Service">Job / Service</option>
                                                        <option value="Business">Business</option>
                                                        <option value="Self Employed">Self Employed</option>
                                                        <option value="Professional">Professional</option>
                                                        <option value="Housewife">Housewife</option>
                                                        <option value="Retired">Retired</option>
                                                        <option value="Gruh Udyog">Gruh Udyog</option>
                                                        <option value="Student">Student</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="divworkinfo">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nameofcompany" class="control-label">Name Of Company
                                                            / કંપનીનું નામ</label>
                                                        <input class="form-control" id="nameofcompany"
                                                               name="nameofcompany" type="text" autocomplete="off"
                                                               maxlength="500"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="typeofbusiness" class="control-label">Type Of
                                                            Business / વ્યવસાય નો પ્રકાર</label>
                                                        <select id="typeofbusiness" class="form-control"
                                                                name="typeofbusiness">
                                                            <option value="">Select</option>
                                                            <option value="Accounting/Finance">Accounting/Finance
                                                            </option>
                                                            <option value="Advertising">Advertising</option>
                                                            <option value="Agriculture / Dairy">Agriculture / Dairy
                                                            </option>
                                                            <option value="Apparel / Garments">Apparel / Garments
                                                            </option>
                                                            <option value="Architecture / Interior Design">Architecture
                                                                / Interior Design
                                                            </option>
                                                            <option value="Automobile/ Parts and Spares">Automobile/
                                                                Parts and Spares
                                                            </option>
                                                            <option value="Banking/ Financial Services">Banking/
                                                                Financial Services
                                                            </option>
                                                            <option value="Beauty and Cosmetics">Beauty and Cosmetics
                                                            </option>
                                                            <option value="Books / Stationery">Books / Stationery
                                                            </option>
                                                            <option value="Chemicals/ Dyes and Solvents">Chemicals/ Dyes
                                                                and Solvents
                                                            </option>
                                                            <option value="Computer / IT Solutions">Computer / IT
                                                                Solutions
                                                            </option>
                                                            <option value="Construction/Cement/Metals">
                                                                Construction/Cement/Metals
                                                            </option>
                                                            <option value="Doctor">Doctor</option>
                                                            <option value="Education / Training">Education / Training
                                                            </option>
                                                            <option value="Electrical / Supplies">Electrical /
                                                                Supplies
                                                            </option>
                                                            <option value="Electronics / Home Appliances">Electronics /
                                                                Home Appliances
                                                            </option>
                                                            <option value="Engineering/ Ferrous and Non-ferrous metal">
                                                                Engineering/ Ferrous and Non-ferrous metal
                                                            </option>
                                                            <option value="Events/Entertainment">Events/Entertainment
                                                            </option>
                                                            <option value="Fashion Accessories and Gear">Fashion
                                                                Accessories and Gear
                                                            </option>
                                                            <option value="Footwear">Footwear</option>
                                                            <option value="FMCG/ Food and Beverages">FMCG/ Food and
                                                                Beverages
                                                            </option>
                                                            <option value="Furniture / Furnishing">Furniture /
                                                                Furnishing
                                                            </option>
                                                            <option value="Gems/ Jewelry and Bullion">Gems/ Jewelry and
                                                                Bullion
                                                            </option>
                                                            <option value="Grains">Grains</option>
                                                            <option value="Home Decor/Gifts/Art/Artifacts">Home
                                                                Decor/Gifts/Art/Artifacts
                                                            </option>
                                                            <option value="Hotels and Restaurants">Hotels and
                                                                Restaurants
                                                            </option>
                                                            <option value="Housekeeping Services">Housekeeping
                                                                Services
                                                            </option>
                                                            <option value="Industrial Plants/ Machinery / Supplies">
                                                                Industrial Plants/ Machinery / Supplies
                                                            </option>
                                                            <option value="Infrastructure / Projects">Infrastructure /
                                                                Projects
                                                            </option>
                                                            <option value="Insurance">Insurance</option>
                                                            <option value="IT/BPO/KPO">IT/BPO/KPO</option>
                                                            <option value="Jewellery/Immitation Jewellery">
                                                                Jewellery/Immitation Jewellery
                                                            </option>
                                                            <option value="Kitchenware">Kitchenware</option>
                                                            <option value="Legal">Legal</option>
                                                            <option value="Mechanical / Parts and Spares">Mechanical /
                                                                Parts and Spares
                                                            </option>
                                                            <option value="Medical/ Healthcare/ Hospital">Medical/
                                                                Healthcare/ Hospital
                                                            </option>
                                                            <option value="Medical Shop">Medical Shop</option>
                                                            <option value="NGO/ Social Services">NGO/ Social Services
                                                            </option>
                                                            <option value="Oil and Gas / Power">Oil and Gas / Power
                                                            </option>
                                                            <option value="Optics">Optics</option>
                                                            <option value="Packaging">Packaging</option>
                                                            <option value="Paper/ Rubber/Glass">Paper/ Rubber/Glass
                                                            </option>
                                                            <option value="Pharma/Biotech/Clinical Research">
                                                                Pharma/Biotech/Clinical Research
                                                            </option>
                                                            <option value="Plastics">Plastics</option>
                                                            <option value="PR/Media">PR/Media</option>
                                                            <option value="Printing and Publishing">Printing and
                                                                Publishing
                                                            </option>
                                                            <option value="Professional Services">Professional
                                                                Services
                                                            </option>
                                                            <option value="Real Estate/ Property">Real Estate/
                                                                Property
                                                            </option>
                                                            <option value="Security Systems and Services">Security
                                                                Systems and Services
                                                            </option>
                                                            <option value="Telecom/ ISP">Telecom/ ISP</option>
                                                            <option value="Textiles/ Yarn and Fabrics">Textiles/ Yarn
                                                                and Fabrics
                                                            </option>
                                                            <option value="Transportation and Logistics">Transportation
                                                                and Logistics
                                                            </option>
                                                            <option value="Travel/Airlines">Travel/Airlines</option>
                                                            <option value="Wellness/ Fitness/ Sports">Wellness/ Fitness/
                                                                Sports
                                                            </option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label for="businessdesp" class="control-label">Business
                                                            Description / વ્યાપાર વર્ણન</label>
                                                        <textarea class="form-control" id="businessdesp"
                                                                  name="businessdesp" type="text" autocomplete="off"
                                                                  maxlength="4000"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="officeaddress" class="control-label">Office Address
                                                            / ઓફિસનું સરનામું</label>
                                                        <textarea class="form-control" id="officeaddress"
                                                                  name="officeaddress" type="text" autocomplete="off"
                                                                  maxlength="500"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="officesuburb" class="control-label">Office Suburb /
                                                            ઓફિસ ઉપનગર</label>
                                                        <input class="form-control" id="officesuburb"
                                                               name="officesuburb" type="text" autocomplete="off"
                                                               maxlength="50"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="officepincode" class="control-label">Office Pincode
                                                            / ઓફિસ પિનકોડ</label>
                                                        <input class="form-control" id="officepincode"
                                                               name="officepincode" type="text" autocomplete="off"
                                                               maxlength="20"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="officecity" class="control-label">Office City / ઓફિસ
                                                            સિટી</label>
                                                        <input class="form-control" id="officecity" name="officecity"
                                                               type="text" autocomplete="off" maxlength="100"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="officestate" class="control-label">Office State /
                                                            ઓફિસ સ્ટેટ</label>
                                                        <input class="form-control" id="officestate" name="officestate"
                                                               type="text" autocomplete="off" maxlength="100"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="officecountry" class="control-label">Office Country
                                                            / ઓફિસ દેશ</label>
                                                        <input class="form-control" id="officecountry"
                                                               name="officecountry" type="text" autocomplete="off"
                                                               maxlength="50"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="officephone" class="control-label">Office Phone /
                                                            ઓફિસ ફોન નંબર</label>
                                                        <input class="form-control" id="officephone" name="officephone"
                                                               type="number" autocomplete="off" maxlength="50"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="officeemail" class="control-label">Office Email ID /
                                                            ઓફિસ ઇમેઇલ આઈડી</label>
                                                        <input class="form-control" id="officeemail" name="officeemail"
                                                               type="email" autocomplete="off" maxlength="500"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="officewebsite" class="control-label">Office Website
                                                            / ઓફિસ વેબસાઇટ</label>
                                                        <input class="form-control" id="officewebsite"
                                                               name="officewebsite" type="text" autocomplete="off"
                                                               maxlength="500"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Mediclaim Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="mediclaimpolicy" class="control-label">Mediclaim Policy
                                                        / મેડિક્લેમ પોલિસી<span class="required">*</span></label>
                                                    <select class="form-control" id="mediclaimpolicy"
                                                            name="mediclaimpolicy" autocomplete="off">
                                                        <option value="">Select</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group d-none" id="divmediclaimtype">
                                                    <label for="mediclaimtype" class="control-label">Mediclaim Type /
                                                        મેડિકલેમ પ્રકાર</label>
                                                    <select class="form-control" id="mediclaimtype" name="mediclaimtype"
                                                            autocomplete="off">
                                                        <option value="">Select</option>
                                                        <option value="private">Private</option>
                                                        <option value="sanstha">Sanstha</option>
                                                        <option value="both">Both</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Social Media Info
                            </header>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="facebook" class="control-label">Facebook Link / ફેસબુક
                                                    લિંક</label>
                                                <div class="input-group mb-15">
                                                    <input type="text" class="form-control" id="facebook"
                                                           name="facebook" autocomplete="off" maxlength="500">
                                                    <span class="input-group-addon"
                                                          onclick="instruction('Facebook');"><i
                                                                class="fa fa-exclamation-circle"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="twitter" class="control-label">Twitter Link / ટ્વિટર
                                                    લિંક</label>
                                                <div class="input-group mb-15">
                                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                                           autocomplete="off" maxlength="500">
                                                    <span class="input-group-addon" onclick="instruction('Twitter');"><i
                                                                class="fa fa-exclamation-circle"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <label for="linkedin" class="control-label">LinkedIn Link / લિંક્ડઇન
                                                    લિંક</label>
                                                <div class="input-group mb-15">
                                                    <input type="text" autocomplete="off" class="form-control"
                                                           id="linkedin" name="linkedin" maxlength="500">
                                                    <span class="input-group-addon"
                                                          onclick="instruction('LinkedIn');"><i
                                                                class="fa fa-exclamation-circle"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="instagram" class="control-label">Instagram Link /
                                                    ઇન્સ્ટાગ્રામ લિંક</label>
                                                <div class="input-group mb-15">
                                                    <input type="text" class="form-control" id="instagram"
                                                           name="instagram" autocomplete="off" maxlength="500">
                                                    <span class="input-group-addon" onclick="instruction('Instagram');"><i
                                                                class="fa fa-exclamation-circle"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="submit" id="btnSubmit" value="Save" onclick="save();"
                                               class="btn btn-primary">
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </form>
        </section>
    </section>
</section>
<input type="hidden" id="hdnIDimage">
<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload & Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" class="crop-container"></div>
                    </div>
                    <div class="col-md-4 pt-30">
                        <br/>
                        <br/>
                        <br/>
                        <button class="btn btn-success crop_image">Crop & Upload Image</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>

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
<!--<script src="js/jquery.nicescroll.js" type="text/javascript"></script>-->

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
<!--<script src="js/jquery.nicescroll.js" type="text/javascript"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script>
    function ValidateDOB() {
        var str = $("#dateofbirth").val();
        var res = str.split("-");
        var dateString = res[1] + "/" + res[2] + "/" + res[0];
        //document.getElementById("dateofbirth").value = "Nikul";

        //document.getElementById("demo").innerHTML = res[0];
        //  var lblError = document.getElementById("lblError");

        //Get the date from the TextBox.
        //   var dateString = document.getElementById("dateofbirth").value;
        //var dateString = res[1]+"/"+res[2]+"/"+res[0];
        // alert(dateString);
        var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;

        //Check whether valid dd/MM/yyyy Date Format.
        if (regex.test(dateString)) {
            // alert("Eligibility1");
            var parts = dateString.split("/");
            var dtDOB = new Date(parts[1] + "/" + parts[0] + "/" + parts[2]);
            var dtCurrent = new Date();
            //lblError.innerHTML = "Eligibility 18 years ONLY."
            //$('#divkjmmember').hide();
            $("#divkjmno").css("display", "none");
            // $("#dateofbirth").focus();
            //alert("Eligibility 18 years ONLY.");

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
                return false;
            }

            if (dtCurrent.getFullYear() - dtDOB.getFullYear() == 18) {

                //CD: 11/06/2018 and DB: 15/07/2000. Will turned 18 on 15/07/2018.
                if (dtCurrent.getMonth() < dtDOB.getMonth()) {
                    return false;
                }
                if (dtCurrent.getMonth() == dtDOB.getMonth()) {
                    //CD: 11/06/2018 and DB: 15/06/2000. Will turned 18 on 15/06/2018.
                    if (dtCurrent.getDate() < dtDOB.getDate()) {
                        return false;
                    }
                }
            }
            // lblError.innerHTML = "";

            $('#divkjmmember').show();
            //	$("#divkjmno").css("display","block");
            if ($('#kjmmember').val() == 'yes') {
                $("#divakjmno").css("display", "block");
            } else {
                $("#divkjmno").css("display", "none");
            }
            return true;
        } else {
            //alert("Eligibility else");
            // lblError.innerHTML = "Enter date in dd/MM/yyyy format ONLY."
            return false;
        }
    }

    var currentValue = 0;

    function handleClick(gender) {
        // alert('Old value: ' + currentValue);
        //alert('New value: ' + gender.value);
        currentValue = gender.value;
        if (currentValue == "Female") {
            //$('#divkjmmember').hide();
            $('#divkjmmember').show();
            //$("#divkjmno").css("display","block");
            if ($('#kjmmember').val() == 'yes') {
                $("#divkjmno").css("display", "block");
            } else {
                $("#divkjmno").css("display", "none");
            }
        } else {
            $('#divkjmmember').show();
            //$("#divkjmno").css("display","block");
            if ($('#kjmmember').val() == 'yes') {
                $("#divkjmno").css("display", "block");
            } else {
                $("#divkjmno").css("display", "none");
            }
        }
    }

    function checkrelationshipwithmainperson(relationshipwithmainperson) {
        //Checking for Mobile Required Field
        if ($("#relationshipwithmainperson").val() == "Self") {
            $("#selfmobile").css("display", "block");
            $("#mobilenonotself").css("display", "none");
        } else {
            $("#selfmobile").css("display", "none");
            $("#mobilenonotself").css("display", "block");
        }

        fillResidentSurburb();
    }

    function fillResidentSurburb() {
        //Populate Residential Surburb Data
        $("#residentalsuburb").empty();
        $("#residentalsuburb").append("<option value=''>Select</option>");
        $("#residentalsuburb").append("<option value='Airoli'>Airoli</option>");
        $("#residentalsuburb").append("<option value='Ambernath'>Ambernath</option>");
        $("#residentalsuburb").append("<option value='Ambivili'>Ambivili</option>");
        $("#residentalsuburb").append("<option value='Andheri'>Andheri</option>");
        $("#residentalsuburb").append("<option value='Asangaon'>Asangaon</option>");
        $("#residentalsuburb").append("<option value='Atgaon'>Atgaon</option>");
        $("#residentalsuburb").append("<option value='Badlapur'>Badlapur</option>");
        $("#residentalsuburb").append("<option value='Bandra'>Bandra</option>");
        $("#residentalsuburb").append("<option value='Belapur CBD'>Belapur CBD</option>");
        $("#residentalsuburb").append("<option value='Bhandup'>Bhandup</option>");
        $("#residentalsuburb").append("<option value='Bhayander'>Bhayander</option>");
        $("#residentalsuburb").append("<option value='Bhivpuri'>Bhivpuri</option>");
        $("#residentalsuburb").append("<option value='Borivali'>Borivali</option>");
        $("#residentalsuburb").append("<option value='Byculla'>Byculla</option>");
        $("#residentalsuburb").append("<option value='Charni Rd'>Charni Rd</option>");
        $("#residentalsuburb").append("<option value='Chembur'>Chembur</option>");
        $("#residentalsuburb").append("<option value='Chinchpokli'>Chinchpokli</option>");
        $("#residentalsuburb").append("<option value='Chunabhatti'>Chunabhatti</option>");
        $("#residentalsuburb").append("<option value='Churchgate'>Churchgate</option>");
        $("#residentalsuburb").append("<option value='Cotton Green'>Cotton Green</option>");
        $("#residentalsuburb").append("<option value='Currey Road'>Currey Road</option>");
        $("#residentalsuburb").append("<option value='Dadar'>Dadar</option>");
        $("#residentalsuburb").append("<option value='Dahisar'>Dahisar</option>");
        $("#residentalsuburb").append("<option value='Diva'>Diva</option>");
        $("#residentalsuburb").append("<option value='Dockyard Road'>Dockyard Road</option>");
        $("#residentalsuburb").append("<option value='Dolavi'>Dolavi</option>");
        $("#residentalsuburb").append("<option value='Dombivili'>Dombivili</option>");
        $("#residentalsuburb").append("<option value='Prabhadevi'>Prabhadevi</option>");
        $("#residentalsuburb").append("<option value='Ghansoli'>Ghansoli</option>");
        $("#residentalsuburb").append("<option value='Ghatkopar'>Ghatkopar</option>");
        $("#residentalsuburb").append("<option value='Goregaon'>Goregaon</option>");
        $("#residentalsuburb").append("<option value='Govandi'>Govandi</option>");
        $("#residentalsuburb").append("<option value='Grant Rd'>Grant Rd</option>");
        $("#residentalsuburb").append("<option value='GTB Nagar'>GTB Nagar</option>");
        $("#residentalsuburb").append("<option value='Jogeshwari'>Jogeshwari</option>");
        $("#residentalsuburb").append("<option value='Juinagar'>Juinagar</option>");
        $("#residentalsuburb").append("<option value='Kalwa'>Kalwa</option>");
        $("#residentalsuburb").append("<option value='Kalyan'>Kalyan</option>");
        $("#residentalsuburb").append("<option value='Kandivali'>Kandivali</option>");
        $("#residentalsuburb").append("<option value='Kanjurmarg'>Kanjurmarg</option>");
        $("#residentalsuburb").append("<option value='Karjat'>Karjat</option>");
        $("#residentalsuburb").append("<option value='Kasara'>Kasara</option>");
        $("#residentalsuburb").append("<option value='Kelavi'>Kelavi</option>");
        $("#residentalsuburb").append("<option value='Khadavli'>Khadavli</option>");
        $("#residentalsuburb").append("<option value='Khandeshwar'>Khandeshwar</option>");
        $("#residentalsuburb").append("<option value='Khar Rd'>Khar Rd</option>");
        $("#residentalsuburb").append("<option value='Khar Road'>Khar Road</option>");
        $("#residentalsuburb").append("<option value='Khardi'>Khardi</option>");
        $("#residentalsuburb").append("<option value='Kharghar'>Kharghar</option>");
        $("#residentalsuburb").append("<option value='Khopoli'>Khopoli</option>");
        $("#residentalsuburb").append("<option value='Kings Circle'>Kings Circle</option>");
        $("#residentalsuburb").append("<option value='Kopar'>Kopar</option>");
        $("#residentalsuburb").append("<option value='Koparkhairne'>Koparkhairne</option>");
        $("#residentalsuburb").append("<option value='Kurla'>Kurla</option>");
        $("#residentalsuburb").append("<option value='Lower Parel'>Lower Parel</option>");
        $("#residentalsuburb").append("<option value='Lowjee'>Lowjee</option>");
        $("#residentalsuburb").append("<option value='Mahalakshmi'>Mahalakshmi</option>");
        $("#residentalsuburb").append("<option value='Mahim'>Mahim</option>");
        $("#residentalsuburb").append("<option value='Mahim Jn'>Mahim Jn</option>");
        $("#residentalsuburb").append("<option value='Malad'>Malad</option>");
        $("#residentalsuburb").append("<option value='Manasarovar'>Manasarovar</option>");
        $("#residentalsuburb").append("<option value='Mankhurd'>Mankhurd</option>");
        $("#residentalsuburb").append("<option value='Mansarovar'>Mansarovar</option>");
        $("#residentalsuburb").append("<option value='Marine Lines'>Marine Lines</option>");
        $("#residentalsuburb").append("<option value='Masjid'>Masjid</option>");
        $("#residentalsuburb").append("<option value='Matunga'>Matunga</option>");
        $("#residentalsuburb").append("<option value='Matunga Rd'>Matunga Rd</option>");
        $("#residentalsuburb").append("<option value='Mira Rd'>Mira Rd</option>");
        $("#residentalsuburb").append("<option value='Mulund'>Mulund</option>");
        $("#residentalsuburb").append("<option value='Mumbai Central'>Mumbai Central</option>");
        $("#residentalsuburb").append("<option value='Mumbai CST'>Mumbai CST</option>");
        $("#residentalsuburb").append("<option value='Mumbra'>Mumbra</option>");
        $("#residentalsuburb").append("<option value='Nahur'>Nahur</option>");
        $("#residentalsuburb").append("<option value='Naigaon'>Naigaon</option>");
        $("#residentalsuburb").append("<option value='Nalla Sopara'>Nalla Sopara</option>");
        $("#residentalsuburb").append("<option value='Neral'>Neral</option>");
        $("#residentalsuburb").append("<option value='Nerul'>Nerul</option>");
        $("#residentalsuburb").append("<option value='Palasdari'>Palasdari</option>");
        $("#residentalsuburb").append("<option value='Panvel'>Panvel</option>");
        $("#residentalsuburb").append("<option value='Parel'>Parel</option>");
        $("#residentalsuburb").append("<option value='Rabale'>Rabale</option>");
        $("#residentalsuburb").append("<option value='Ram Mandir'>Ram Mandir</option>");
        $("#residentalsuburb").append("<option value='Reay Road'>Reay Road</option>");
        $("#residentalsuburb").append("<option value='Sandhurst Road'>Sandhurst Road</option>");
        $("#residentalsuburb").append("<option value='Sandurst Road'>Sandurst Road</option>");
        $("#residentalsuburb").append("<option value='Sanpada'>Sanpada</option>");
        $("#residentalsuburb").append("<option value='Santa Cruz'>Santa Cruz</option>");
        $("#residentalsuburb").append("<option value='Santacruz'>Santacruz</option>");
        $("#residentalsuburb").append("<option value='Seawood Darave'>Seawood Darave</option>");
        $("#residentalsuburb").append("<option value='Sewri'>Sewri</option>");
        $("#residentalsuburb").append("<option value='Shahad'>Shahad</option>");
        $("#residentalsuburb").append("<option value='Shelu'>Shelu</option>");
        $("#residentalsuburb").append("<option value='Sion'>Sion</option>");
        $("#residentalsuburb").append("<option value='Thakurli'>Thakurli</option>");
        $("#residentalsuburb").append("<option value='Thane'>Thane</option>");
        $("#residentalsuburb").append("<option value='Tilaknagar'>Tilaknagar</option>");
        $("#residentalsuburb").append("<option value='Titwala'>Titwala</option>");
        $("#residentalsuburb").append("<option value='Turbhe'>Turbhe</option>");
        $("#residentalsuburb").append("<option value='Ulhasnagar'>Ulhasnagar</option>");
        $("#residentalsuburb").append("<option value='Vangani'>Vangani</option>");
        $("#residentalsuburb").append("<option value='Vasai Rd'>Vasai Rd</option>");
        $("#residentalsuburb").append("<option value='Vashi'>Vashi</option>");
        $("#residentalsuburb").append("<option value='Vasind'>Vasind</option>");
        $("#residentalsuburb").append("<option value='Vidhyavihar'>Vidhyavihar</option>");
        $("#residentalsuburb").append("<option value='Vikhroli'>Vikhroli</option>");
        $("#residentalsuburb").append("<option value='Vile Parle'>Vile Parle</option>");
        $("#residentalsuburb").append("<option value='Virar'>Virar</option>");
        $("#residentalsuburb").append("<option value='Vithalwadi'>Vithalwadi</option>");
        $("#residentalsuburb").append("<option value='Wadala Rd'>Wadala Rd</option>");
        $("#residentalsuburb").append("<option value='Other'>Other</option>");
        $("#residentalsuburb").append("<option value='Outside Mumbai'>Outside Mumbai</option>");
    }

    function instruction(type) {

        if (type == "Instagram") {
            $('#exampleModal').modal('show');
            $("#instructionalert").html('<p> Instagram instruction</p><p>https://www.instagram.com/(type your username here)</p>');
        } else if (type == "LinkedIn") {
            $('#exampleModal').modal('show');
            $("#instructionalert").html('<p>LinkedIn instruction</p><p>Type your linkedin link</p>');
        } else if (type == "Twitter") {
            $('#exampleModal').modal('show');
            $("#instructionalert").html('<p>Twitter instruction</p><p>Type your twitter link</p>');
        } else if (type == "Facebook") {
            $('#exampleModal').modal('show');
            $("#instructionalert").html('<p>Facebook instruction</p><p>Go to Facebook home page</p><p>Tap on your profile photo</p><p>Tap on 3dots … </p><p>The last line shows your profile link & there is a button copy link – Tap on it.</p><p>Paste on the Facbook link </p>');
        }

    }

    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();

        if ($("#relationshipwithmainperson").val() == "Self") {
            $("#selfmobile").css("display", "block");
            $("#mobilenonotself").css("display", "none");
            //$("#mobileno").val($("#mobileno"+id).html());
            //	alert($("#mobileno"+id).html());
        } else {
            $("#selfmobile").css("display", "none");
            $("#mobilenonotself").css("display", "block");
            //	$("#lblmobilenonotself").val($("#mobileno"+id).html());
            //alert($("#mobileno"+id).html());
            //alert("else");
        }


    });
    var aadharphoto = "";
    var photo = "";
    $(document).ready(function () {


        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
                //type:'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#photo').on('change', function () {
            $("#hdnIDimage").val('photo');
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('#aadharphoto').on('change', function () {

            $("#hdnIDimage").val('aadharphoto');
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "cropimageupload.php",
                    type: "POST",
                    data: {"image": response},
                    success: function (data) {
                        //alert(data);


                        $('#uploadimageModal').modal('hide');

                        if ($("#hdnIDimage").val() == "photo") {
                            //$('#uploaded_image').html(data);
                            photo = data;
                            $("#editprofilephoto").attr('src', 'img/profilephoto/' + data);
                            $("#photodiv").css("display", "block");
                            $('#photo').val("");
                            //$('#uploaded_image').html("<img src='img/profilephoto/"+data+"'class='img-thumbnail' style='width:100px !important; height:100px !important;'/>");
                        }
                        if ($("#hdnIDimage").val() == "aadharphoto") {
                            aadharphoto = data;
                            //$('#uploaded_image_aadhar').html(data);
                            $("#editaadhaarphoto").attr('src', 'img/profilephoto/' + data);
                            $("#aadhaarphotodiv").css("display", "block");
                            //$('#uploaded_image_aadhar').html("<img src='img/profilephoto/"+data+"'class='img-thumbnail' style='width:100px !important; height:100px !important;'/>");
                            $('#aadharphoto').val("");
                        }

                    }
                });
            })
        });

    });
</script>
<script>
    $(document).ready(function () {
        if ($('#hdnop').val() == 'Edit') {
            editRecord($('#hdnID').val());
        }
    });

    $('#mediclaimpolicy').change(function () {
        if ($('#mediclaimpolicy').val() == 'yes') {
            $("#divmediclaimtype").css("display", "block");
        } else {
            $("#divmediclaimtype").css("display", "none");
        }
    });

    $('#maritialstatus').change(function () {
        if ($('#maritialstatus').val() == 'Married') {
            $("#divanniversarydate").css("display", "block");
        } else {
            $("#divanniversarydate").css("display", "none");
        }
        if ($('#maritialstatus').val() == 'Married' || $('#maritialstatus').val() == '') {
            $("#diveligibleformarriage").css("display", "none");
        } else {
            $("#diveligibleformarriage").css("display", "block");
        }
        $('input[id=eligibleformarriage]').prop('checked', false);
    });

    $('#natureofwork').change(function () {
        if ($('#natureofwork').val() == 'Housewife' || $('#natureofwork').val() == 'Retired' || $('#natureofwork').val() == 'Student') {
            $("#divworkinfo").css("display", "none");
        } else {
            $("#divworkinfo").css("display", "block");
        }
    });


    $("#firstname").blur(function () {
        if ($("#firstname").val() == "") {
            $("#errfirstname").html("");
            $('#firstname').css('border-color', 'red');
            $('#firstname').after('<span id="errfirstname"><i class="fa fa-exclamation-circle text-error"> Please Enter First Name</i></span>');
            $("#firstname").focus();
        } else {
            $("#errfirstname").fadeOut();
            $('#firstname').css('border-color', '#D2D6DE');
        }
    });

    $("#middlename").blur(function () {
        if ($("#middlename").val() == "") {
            $("#errmiddlename").html("");
            $('#middlename').css('border-color', 'red');
            $('#middlename').after('<span id="errmiddlename"><i class="fa fa-exclamation-circle text-error"> Please Enter Middle Name</i></span>');
            $("#middlename").focus();
        } else {
            $("#errmiddlename").fadeOut();
            $('#middlename').css('border-color', '#D2D6DE');
        }
    });
    $("#grandfathername").blur(function () {
        if ($("#grandfathername").val() == "") {
            $("#errgrandfathername").html("");
            $('#grandfathername').css('border-color', 'red');
            $('#grandfathername').after('<span id="errgrandfathername"><i class="fa fa-exclamation-circle text-error"> Please Enter Grandfather Name</i></span>');
            $("#grandfathername").focus();
        } else {
            $("#errgrandfathername").fadeOut();
            $('#grandfathername').css('border-color', '#D2D6DE');
        }
    });
    $("#lastname").blur(function () {
        if ($("#lastname").val() == "") {
            $("#errlastname").html("");
            $('#lastname').css('border-color', 'red');
            $('#lastname').after('<span id="errlastname"><i class="fa fa-exclamation-circle text-error"> Please Enter Last Name</i></span>');
            $("#lastname").focus();
        } else {
            $("#errlastname").fadeOut();
            $('#lastname').css('border-color', '#D2D6DE');
        }
    });
    $("#dateofbirth").blur(function () {
        if ($("#dateofbirth").val() == "") {
            $("#errdateofbirth").html("");
            $('#dateofbirth').css('border-color', 'red');
            $('#dateofbirth').after('<span id="errdateofbirth"><i class="fa fa-exclamation-circle text-error"> Please Enter Date of Birth</i></span>');
            $("#dateofbirth").focus();
        } else {
            $("#errdateofbirth").fadeOut();
            $('#dateofbirth').css('border-color', '#D2D6DE');
        }
    });
    $("#maritialstatus").blur(function () {
        if ($("#maritialstatus").val() == "") {
            $("#errmaritialstatus").html("");
            $('#maritialstatus').css('border-color', 'red');
            $('#maritialstatus').after('<span id="errmaritialstatus"><i class="fa fa-exclamation-circle text-error"> Please Select Maritial Status</i></span>');
            $("#maritialstatus").focus();
        } else {
            $("#errmaritialstatus").fadeOut();
            $('#maritialstatus').css('border-color', '#D2D6DE');
        }
    });
    $("#bloodgroup").blur(function () {
        if ($("#bloodgroup").val() == "") {
            $("#errbloodgroup").html("");
            $('#bloodgroup').css('border-color', 'red');
            $('#bloodgroup').after('<span id="errbloodgroup"><i class="fa fa-exclamation-circle text-error"> Please Select Blood Group</i></span>');
            $("#bloodgroup").focus();
        } else {
            $("#errbloodgroup").fadeOut();
            $('#bloodgroup').css('border-color', '#D2D6DE');
        }
    });
    $("#photo").blur(function () {
        if ($("#photo").val() == "") {
            $("#errphoto").html("");
            $('#photo').css('border-color', 'red');
            $('#photo').after('<span id="errphoto"><i class="fa fa-exclamation-circle text-error"> Please Upload Photo</i></span>');
            $("#photo").focus();
        } else {
            $("#errphoto").fadeOut();
            $('#photo').css('border-color', '#D2D6DE');
        }
    });
    $("#relationshipwithmainperson").blur(function () {
        if ($("#relationshipwithmainperson").val() == "") {
            $("#errrelationshipwithmainperson").html("");
            $('#relationshipwithmainperson').css('border-color', 'red');
            $('#relationshipwithmainperson').after('<span id="errrelationshipwithmainperson"><i class="fa fa-exclamation-circle text-error"> Please Select Relationship with Main Person Name</i></span>');
            $("#relationshipwithmainperson").focus();
        } else {
            $("#errrelationshipwithmainperson").fadeOut();
            $('#relationshipwithmainperson').css('border-color', '#D2D6DE');
        }
    });
    $("#mobileno").blur(function () {
        if ($("#mobileno").val() == "") {
            $("#errmobileno").html("");
            $('#mobileno').css('border-color', 'red');
            $('#mobileno').after('<span id="errmobileno"><i class="fa fa-exclamation-circle text-error"> Please Enter Mobile No </i></span>');
            $("#mobileno").focus();
        } else {
            $("#errmobileno").fadeOut();
            $('#mobileno').css('border-color', '#D2D6DE');
        }
    });

    $("#mobileno").blur(function () {
        var val = $("#mobileno").val();
        if (val != "") {
            if (/^\d{10}$/.test(val)) {

            } else {
                $("#mobileno").val("");
                $("#errmobileno").html("");
                $('#mobileno').css('border-color', 'red');
                $('#mobileno').after('<span id="errmobileno"><i class="fa fa-exclamation-circle text-error"> Mobile Number must be ten digits </i></span>');
                $("#mobileno").focus();

            }
        }
    });// Mobile validate

    /*$("#lblmobilenonotself").blur(function(){
	var val=$("#lblmobilenonotself").val();
	if(val!=""){
		if (/^\d{10}$/.test(val)) {
			$("#errlblmobilenonotself").fadeOut();
			$('#lblmobilenonotself').css('border-color', '#D2D6DE');
		} else{
			$("#lblmobilenonotself").val("");
			 $("#errlblmobilenonotself").html("");
			  $('#lblmobilenonotself').css('border-color', 'red');
			  $('#lblmobilenonotself').after('<span id="errlblmobilenonotself"><i style="color:red" class="fa fa-exclamation-circle"> Mobile Number must be ten digits </i></span>');
			$("#lblmobilenonotself").focus();

		}
	}
});// Mobile validate*/

    $("#alternativemobileno").blur(function () {
        var val = $("#alternativemobileno").val();
        if (val != "") {
            if (/^(\+)?\d{1,15}$/.test(val)) {
                $("#erralternativemobileno").fadeOut();
                $('#alternativemobileno').css('border-color', '#D2D6DE');
            } else {
                //$("#alternativemobileno").val("");
                $("#erralternativemobileno").html("");
                $('#alternativemobileno').css('border-color', 'red');
                $('#alternativemobileno').after('<span id="erralternativemobileno"><i class="fa fa-exclamation-circle text-error"> Alternative Mobile Number must be between 6 - 15 digits </i></span>');
                $("#alternativemobileno").focus();

            }
        }
    });// Mobile validate

    $("#residentaladdress").blur(function () {
        if ($("#residentaladdress").val() == "") {
            $("#errresidentaladdress").html("");
            $('#residentaladdress').css('border-color', 'red');
            $('#residentaladdress').after('<span id="errresidentaladdress"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Address </i></span>');
            $("#residentaladdress").focus();
        } else {
            $("#errresidentaladdress").fadeOut();
            $('#residentaladdress').css('border-color', '#D2D6DE');
        }
    });
    $("#residentalsuburb").blur(function () {
        if ($("#residentalsuburb").val() == "") {
            $("#errresidentalsuburb").html("");
            $('#residentalsuburb').css('border-color', 'red');
            $('#residentalsuburb').after('<span id="errresidentalsuburb"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Suburb</i></span>');
            $("#residentalsuburb").focus();
        } else {
            $("#errresidentalsuburb").fadeOut();
            $('#residentalsuburb').css('border-color', '#D2D6DE');
        }
    });

    $("#residentalpincode").blur(function () {
        if ($("#residentalpincode").val() == "") {
            $("#errresidentalpincode").html("");
            $('#residentalpincode').css('border-color', 'red');
            $('#residentalpincode').after('<span id="errresidentalpincode"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Pincode</i></span>');
            $("#residentalpincode").focus();
        } else {
            $("#errresidentalpincode").fadeOut();
            $('#residentalpincode').css('border-color', '#D2D6DE');
        }
    });

    $("#residentalcity").blur(function () {
        if ($("#residentalcity").val() == "") {
            $("#errresidentalcity").html("");
            $('#residentalcity').css('border-color', 'red');
            $('#residentalcity').after('<span id="errresidentalcity"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential City</i></span>');
            $("#residentalcity").focus();
        } else {
            $("#errresidentalcity").fadeOut();
            $('#residentalcity').css('border-color', '#D2D6DE');
        }
    });

    $("#residentalstate").blur(function () {
        if ($("#residentalstate").val() == "") {
            $("#errresidentalstate").html("");
            $('#residentalstate').css('border-color', 'red');
            $('#residentalstate').after('<span id="errresidentalstate"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential State</i></span>');
            $("#residentalstate").focus();
        } else {
            $("#errresidentalstate").fadeOut();
            $('#residentalstate').css('border-color', '#D2D6DE');
        }
    });

    $("#residentalcountry").blur(function () {
        if ($("#residentalcountry").val() == "") {
            $("#errresidentalcountry").html("");
            $('#residentalcountry').css('border-color', 'red');
            $('#residentalcountry').after('<span id="errresidentalcountry"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Country</i></span>');
            $("#residentalcountry").focus();
        } else {
            $("#errresidentalcountry").fadeOut();
            $('#residentalcountry').css('border-color', '#D2D6DE');
        }
    });

    $("#sampraday").blur(function () {
        if ($("#sampraday").val() == "") {
            $("#errsampraday").html("");
            $('#sampraday').css('border-color', 'red');
            $('#sampraday').after('<span id="errsampraday"><i class="fa fa-exclamation-circle text-error"> Please Select Main Gyati</i></span>');
            $("#sampraday").focus();
        } else {
            $("#errsampraday").fadeOut();
            $('#sampraday').css('border-color', '#D2D6DE');
        }
    });

    $("#subreligion").blur(function () {
        if ($("#subreligion").val() == "") {
            $("#errsubreligion").html("");
            $('#subreligion').css('border-color', 'red');
            $('#subreligion').after('<span id="errsubreligion"><i class="fa fa-exclamation-circle text-error"> Please Select Sub Gyati</i></span>');
            $("#subreligion").focus();
        } else {
            $("#errsubreligion").fadeOut();
            $('#subreligion').css('border-color', '#D2D6DE');
        }
    });

    $("#subsubreligion").blur(function () {
        if ($("#subsubreligion").val() == "") {
            $("#errsubsubreligion").html("");
            $('#subsubreligion').css('border-color', 'red');
            $('#subsubreligion').after('<span id="errsubsubreligion"><i class="fa fa-exclamation-circle text-error"> Please Select Sampraday</i></span>');
            $("#subsubreligion").focus();
        } else {
            $("#errsubsubreligion").fadeOut();
            $('#subsubreligion').css('border-color', '#D2D6DE');
        }
    });

    $("#ismember").blur(function () {
        if ($("#ismember").val() == "") {
            $("#errismember").html("");
            $('#ismember').css('border-color', 'red');
            $('#ismember').after('<span id="errismember"><i class="fa fa-exclamation-circle text-error"> Please select Is Member</i></span>');
            $("#ismember").focus();
        } else {
            $("#errismember").fadeOut();
            $('#ismember').css('border-color', '#D2D6DE');
        }
    });

    $("#natureofwork").blur(function () {
        if ($("#natureofwork").val() == "") {
            $("#errnatureofwork").html("");
            $('#natureofwork').css('border-color', 'red');
            $('#natureofwork').after('<span id="errnatureofwork"><i class="fa fa-exclamation-circle text-error"> Please select Nature of Work</i></span>');
            $("#natureofwork").focus();
        } else {
            $("#errnatureofwork").fadeOut();
            $('#natureofwork').css('border-color', '#D2D6DE');
        }
    });

    $("#mediclaimpolicy").blur(function () {
        if ($("#mediclaimpolicy").val() == "") {
            $("#errmediclaimpolicy").html("");
            $('#mediclaimpolicy').css('border-color', 'red');
            $('#mediclaimpolicy').after('<span id="errmediclaimpolicy"><i class="fa fa-exclamation-circle text-error"> Please select Mediclaim Policy</i></span>');
            $("#mediclaimpolicy").focus();
        } else {
            $("#errmediclaimpolicy").fadeOut();
            $('#mediclaimpolicy').css('border-color', '#D2D6DE');
        }
    });

    $("#residentalpincode").blur(function () {
        if ($("#residentalpincode").val() != "") {
            if (isNaN($("#residentalpincode").val())) {
                $("#residentalcity").val("");
                $("#residentalstate").val("");
                $("#residentalcountry").val("");
                $("#residentalcity").focus();
            } else {
                getPinCodeResi($("#residentalpincode").val());
            }
        }
    });
    $("#officepincode").blur(function () {
        if ($("#officepincode").val() != "") {
            if (isNaN($("#officepincode").val())) {
                $("#officecity").val("");
                $("#officestate").val("");
                $("#officecountry").val("");
                $("#officecity").focus();
            } else {
                getPinCodeOff($("#officepincode").val());
            }
        }
    });

    function showdeathdate() {
        if ($('#deceased').prop('checked')) {
            $("#DeathAnniversaryDiv").css({'display': 'block'});
        } else {
            $("#DeathAnniversaryDiv").css({'display': 'none'});
        }
    }

    function save() {
        var deceased = $('#deceased').prop('checked');
        if (deceased == "") {
            deceased = "false";
        }
        var eligibleformarriage = $('#eligibleformarriage').prop('checked');
        if (eligibleformarriage == "") {
            eligibleformarriage = "false";
        }
        //Office Website
        var owebsite = $("#officewebsite").val();
        if (owebsite != "") {
            owebsite = owebsite.toLowerCase();
            if (owebsite.startsWith('http') == false) {
                owebsite = "http://" + owebsite;
            }
        }
        //Facebook
        var fb = $("#facebook").val();
        if (fb != "") {
            fb = fb.toLowerCase();
            if (fb.startsWith('http') == false) {
                fb = "https://" + fb;
            }
        }
        //Twitter
        var twitter = $("#twitter").val();
        if (twitter != "") {
            twitter = twitter.toLowerCase();
            if (twitter.startsWith('http') == false) {
                twitter = "https://" + twitter;
            }
        }
        //LinkedIn
        var linkedin = $("#linkedin").val();
        if (linkedin != "") {
            linkedin = linkedin.toLowerCase();
            if (linkedin.startsWith('http') == false) {
                linkedin = "https://" + linkedin;
            }
        }
        //Instagram
        var instagram = $("#instagram").val();
        if (instagram != "") {
            instagram = instagram.toLowerCase();
            if (instagram.startsWith('http') == false) {
                instagram = "https://" + instagram;
            }
        }


        $("#overlaydiv").css("display", "block");
        if ($("#btnSubmit").val() == "Save") {
            var gender = $('input[name=gender]:checked').val();
            var resi_phone = $("#residentalphone").val();

            var off_phone = $("#officephone").val();

            var mobile = "";
            var vResiPincode = "";
            if ($("#relationshipwithmainperson").val() == "Self") {
                mobile = $("#mobileno").val();
                vResiPincode = $("#residentalpincodeselect").val();
            } else {
                mobile = $("#lblmobilenonotself").val();
                vResiPincode = $("#residentalpincode").val();
            }


            $('#register_form').ajaxForm({
                type: "POST",
                url: "appSaveProfileInfo.php",
                data: {
                    id: $("#hdnID").val(),
                    firstname: $("#firstname").val(),
                    middlename: $("#middlename").val(),
                    grandfathername: $("#grandfathername").val(),
                    lastname: $("#lastname").val(),
                    gender: gender,
                    dateofbirth: $("#dateofbirth").val(),
                    maritialstatus: $("#maritialstatus").val(),
                    anniversarydate: $("#anniversarydate").val(),
                    eligibleformarriage: eligibleformarriage,
                    photo: photo,
                    bloodgroup: $("#bloodgroup").val(),
                    relationshipwithmainperson: $("#relationshipwithmainperson").val(),
                    deceased: deceased,
                    dateofdeathanniversary: $("#dateofdeathanniversary").val(),
                    mobileno: mobile,
                    emailid: $("#emailid").val(),
                    alternativemobileno: $("#alternativemobileno").val(),
                    displaycontactdetails: $("#displaycontactdetails").val(),
                    educationqualification: $("#educationqualification").val(),
                    otherachivements: $("#otherachivements").val(),
                    residentaladdress: $("#residentaladdress").val(),
                    residentalsuburb: $("#residentalsuburb").val(),
                    residentalpincode: vResiPincode,
                    residentalcity: $("#residentalcity").val(),
                    residentalstate: $("#residentalstate").val(),
                    residentalcountry: $("#residentalcountry").val(),
                    residentalphone: resi_phone,
                    sampraday: $("#sampraday").val(),
                    subreligion: $("#subreligion").val(),
                    subsubreligion: $("#subsubreligion").val(),
                    ismember: $("#ismember").val(),
                    natureofwork: $("#natureofwork").val(),
                    nameofcompany: $("#nameofcompany").val(),
                    typeofbusiness: $("#typeofbusiness").val(),
                    businessdesp: $("#businessdesp").val(),
                    officeaddress: $("#officeaddress").val(),
                    officesuburb: $("#officesuburb").val(),
                    officepincode: $("#officepincode").val(),
                    officecity: $("#officecity").val(),
                    officestate: $("#officestate").val(),
                    officecountry: $("#officecountry").val(),
                    officephone: off_phone,
                    officeemail: $("#officeemail").val(),
                    officewebsite: owebsite,
                    mediclaimpolicy: $("#mediclaimpolicy").val(),
                    mediclaimtype: $("#mediclaimtype").val(),
                    facebook: fb,
                    twitter: twitter,
                    linkedin: linkedin,
                    instagram: instagram
                },
                success: function (response) {
                    console.log(response);
                },
                complete: function (response) {
                    $("#overlaydiv").css("display", "none");
                    console.log(response);
                    $("#btnSubmit").attr("disabled", false);

                    var response = response.responseText;
                    //alert(response);
                    if ($.trim(response) == "firstname") //jaisa echo saveprofileinfo mai kiya hai vaisa
                    {
                        alert("Please enter First Name");
                        $("#firstname").focus();
                    } else if ($.trim(response) == "existmobile") {
                        alert("Mobile number already exist");
                        $("#lblmobilenonotself").focus();
                        $("#mobileno").focus();
                    } else if ($.trim(response) == "middlename") {
                        alert("Please enter Middle Name");
                        $("#middlename").focus();
                    } else if ($.trim(response) == "grandfathername") {
                        alert("Please enter Grandfather Name");
                        $("#grandfathername").focus();
                    } else if ($.trim(response) == "lastname") {
                        alert("Please enter Last Name");
                        $("#lastname").focus();
                    } else if ($.trim(response) == "dateofbirth") {
                        alert("Please enter Date of Birth");
                        $("#dateofbirth").focus();
                    } else if ($.trim(response) == "maritialstatus") {
                        alert("Please select Maritial Status");
                        $("#maritialstatus").focus();
                    } else if ($.trim(response) == "photo") {
                        alert("Please upload photo");
                        $("#photo").focus();
                    } else if ($.trim(response) == "bloodgroup") {
                        alert("Please select Blood Group");
                        $("#bloodgroup").focus();
                    } else if ($.trim(response) == "relationshipwithmainperson") {
                        alert("Please select Relationship with Main Person");
                        $("#relationshipwithmainperson").focus();
                    } else if ($.trim(response) == "mobileno") {
                        alert("Please enter Mobile Number");
                        $("#lblmobilenonotself").focus();
                        $("#mobileno").focus();
                    } else if ($.trim(response) == "invalidmobile") {
                        alert("Please enter valid Mobile Number");
                        $("#lblmobilenonotself").focus();
                        $("#mobilenonotself").focus();
                    } else if ($.trim(response) == "villagename") {
                        alert("Please enter Village Name");
                        $("#villagename").focus();
                    } else if ($.trim(response) == "kjmmember") {
                        alert("Please enter KJM Member");
                        $("#kjmmember").focus();
                    } else if ($.trim(response) == "residentaladdress") {
                        alert("Please enter Residential Address");
                        $("#residentaladdress").focus();
                    } else if ($.trim(response) == "residentalsuburb") {
                        alert("Please enter Residential Suburb");
                        $("#residentalsuburb").focus();
                    } else if ($.trim(response) == "residentalpincode") {
                        alert("Please enter Residential Pin Code");
                        $("#residentalpincode").focus();
                    } else if ($.trim(response) == "residentalcity") {
                        alert("Please enter Residential Pin City");
                        $("#residentalcity").focus();
                    } else if ($.trim(response) == "residentalstate") {
                        alert("Please enter Residential State");
                        $("#residentalstate").focus();
                    } else if ($.trim(response) == "residentalcountry") {
                        alert("Please enter Residential Country");
                        $("#residentalcountry").focus();
                    } else if ($.trim(response) == "sampraday") {
                        alert("Please select Main Gyati");
                        $("#sampraday").focus();
                    } else if ($.trim(response) == "subreligion") {
                        alert("Please select Sub Gyati");
                        $("#subreligion").focus();
                    } else if ($.trim(response) == "subsubreligion") {
                        alert("Please select Sampraday");
                        $("#subsubreligion").focus();
                    } else if ($.trim(response) == "ismember") {
                        alert("Please select Is Member");
                        $("#ismember").focus();
                    } else if ($.trim(response) == "natureofwork") {
                        alert("Please select Nature of Work");
                        $("#natureofwork").focus();
                    } else if ($.trim(response) == "mediclaimpolicy") {
                        alert("Please select Mediclaim Policy");
                        $("#mediclaimpolicy").focus();
                    } else if ($.trim(response) == "success") {
                        alert("New member details added successfully");
                        $('input[type=checkbox]').prop('checked', false);
                        $("#firstname").val("");
                        $("#middlename").val("");
                        $("#grandfathername").val("");
                        $("#lastname").val("");
                        $("#dateofbirth").val("");
                        $("#bloodgroup").val("");
                        $("#gender").val("");
                        $("#educationqualification").val("");
                        $("#villagename").val("");
                        $("#residentaladdress").val("");
                        $("#residentalsuburb").val("");
                        $("#residentalcity").val("");
                        $("#residentalpincode").val("");
                        $("#residentalstate").val("");
                        $("#residentalcountry").val("");
                        $("#residentalphone").val("");
                        $("#displaycontactdetails").val("");
                        $("#sampraday").val("");
                        $("#subreligion").val("");
                        $("#subsubreligion").val("");
                        $("#ismember").val("");
                        $("#emailid").val("");
                        $("#mobileno").val("");
                        $("#lblmobilenonotself").val("");
                        $("#maritialstatus").val("");
                        $("#anniversarydate").val("");
                        $("#natureofwork").val("");
                        $("#nameofcompany").val("");
                        $("#typeofbusiness").val("");
                        $("#officesuburb").val("");
                        $("#officeaddress").val("");
                        $("#officecity").val("");
                        $("#officepincode").val("");
                        $("#officestate").val("");
                        $("#officecountry").val("");
                        $("#dateofdeathanniversary").val("");
                        $("#officephone").val("");
                        $("#officeemail").val("");
                        $("#officewebsite").val("");
                        $("#alternativemobileno").val("");
                        $("#photo").val("");
                        $("#adharno").val("");
                        $("#relationshipwithmainperson").val("");
                        $("#kjmmember").val("");
                        $("#kjmno").val("");
                        $("#otherachivements").val("");
                        $("#mediclaimpolicy").val("");
                        $("#mediclaimtype").val("");
                        $("#facebook").val("");
                        $("#twitter").val("");
                        $("#linkedin").val("");
                        $("#instagram").val("");
                        $("#editprofilephoto").attr('src', '');
                        $("#photodiv").css("display", "none");
                        $("#editaadhaarphoto").attr('src', '');
                        $("#aadhaarphotodiv").css("display", "none");
                        $('#uploaded_image_aadhara').html("");
                        $('#uploaded_image').html("");
                        $("#photo").val("");
                        $("#aadharphoto").val("");
                        $("#businessdesp").val("");
                        $("#dateofdeathanniversary").val("");
                        $("#firstname").focus();
                        location.reload();
                    } else {
                        alert("Something went wrong. Please try again.");

                    }
                }
            });
        } else {
            var gender = $('input[name=gender]:checked').val();
            var resi_phone = $("#residentalphone").val();
            var off_phone = $("#officephone").val();
            var mobile = "";
            var vResiPincode = "";
            if ($("#relationshipwithmainperson").val() == "Self") {
                mobile = $("#mobileno").val();
                vResiPincode = $("#residentalpincodeselect").val();

            } else {
                mobile = $("#lblmobilenonotself").val();
                vResiPincode = $("#residentalpincode").val();
            }

            $('#register_form').ajaxForm({
                type: "POST",
                url: "editprofileinfo1.php",
                data: {
                    id: $("#hdnID").val(),
                    firstname: $("#firstname").val(),
                    middlename: $("#middlename").val(),
                    grandfathername: $("#grandfathername").val(),
                    lastname: $("#lastname").val(),
                    gender: gender,
                    dateofbirth: $("#dateofbirth").val(),
                    maritialstatus: $("#maritialstatus").val(),
                    anniversarydate: $("#anniversarydate").val(),
                    eligibleformarriage: eligibleformarriage,
                    photo: photo,
                    bloodgroup: $("#bloodgroup").val(),
                    relationshipwithmainperson: $("#relationshipwithmainperson").val(),
                    deceased: deceased,
                    dateofdeathanniversary: $("#dateofdeathanniversary").val(),
                    mobileno: mobile,
                    emailid: $("#emailid").val(),
                    alternativemobileno: $("#alternativemobileno").val(),
                    displaycontactdetails: $("#displaycontactdetails").val(),
                    educationqualification: $("#educationqualification").val(),
                    otherachivements: $("#otherachivements").val(),
                    residentaladdress: $("#residentaladdress").val(),
                    residentalsuburb: $("#residentalsuburb").val(),
                    residentalpincode: vResiPincode,
                    residentalcity: $("#residentalcity").val(),
                    residentalstate: $("#residentalstate").val(),
                    residentalcountry: $("#residentalcountry").val(),
                    residentalphone: resi_phone,
                    sampraday: $("#sampraday").val(),
                    subreligion: $("#subreligion").val(),
                    subsubreligion: $("#subsubreligion").val(),
                    ismember: $("#ismember").val(),
                    natureofwork: $("#natureofwork").val(),
                    nameofcompany: $("#nameofcompany").val(),
                    typeofbusiness: $("#typeofbusiness").val(),
                    businessdesp: $("#businessdesp").val(),
                    officeaddress: $("#officeaddress").val(),
                    officesuburb: $("#officesuburb").val(),
                    officepincode: $("#officepincode").val(),
                    officecity: $("#officecity").val(),
                    officestate: $("#officestate").val(),
                    officecountry: $("#officecountry").val(),
                    officephone: off_phone,
                    officeemail: $("#officeemail").val(),
                    officewebsite: owebsite,
                    mediclaimpolicy: $("#mediclaimpolicy").val(),
                    mediclaimtype: $("#mediclaimtype").val(),
                    facebook: fb,
                    twitter: twitter,
                    linkedin: linkedin,
                    instagram: instagram
                },
                success: function (response) {

                },
                complete: function (response) {
                    $("#overlaydiv").css("display", "none");
                    $("#btnSubmit").attr("disabled", false);
                    $("#mobileno").prop('disabled', false);
                    var response = response.responseText;
                    console.log(response);
                    if ($.trim(response) == "Success") {
                        alert("Record of member updated successfully");
                    } else if ($.trim(response) == "self") //jaisa echo saveprofileinfo mai kiya hai vaisa
                    {
                        alert("Cannot have 2 Self members in same family. Please choose different relation");
                        $("#relationshipwithmainperson").focus();
                    } else if ($.trim(response) == "firstname") //jaisa echo saveprofileinfo mai kiya hai vaisa
                    {
                        alert("Please enter First Name");
                        $("#firstname").focus();
                    } else if ($.trim(response) == "existmobile") {
                        alert("Mobile number already exist");
                        $("#lblmobilenonotself").focus();
                        $("#mobileno").focus();
                    } else if ($.trim(response) == "middlename") {
                        alert("Please enter Middle Name");
                        $("#middlename").focus();
                    } else if ($.trim(response) == "grandfathername") {
                        alert("Please enter Grandfather Name");
                        $("#grandfathername").focus();
                    } else if ($.trim(response) == "lastname") {
                        alert("Please enter Last Name");
                        $("#lastname").focus();
                    } else if ($.trim(response) == "dateofbirth") {
                        alert("Please enter Date of Birth");
                        $("#dateofbirth").focus();
                    } else if ($.trim(response) == "maritialstatus") {
                        alert("Please select Maritial Status");
                        $("#maritialstatus").focus();
                    } else if ($.trim(response) == "photo") {
                        alert("Please upload photo");
                        $("#photo").focus();
                    } else if ($.trim(response) == "bloodgroup") {
                        alert("Please select Blood Group");
                        $("#bloodgroup").focus();
                    } else if ($.trim(response) == "relationshipwithmainperson") {
                        alert("Please select Relationship with Main Person");
                        $("#relationshipwithmainperson").focus();
                    } else if ($.trim(response) == "mobileno") {
                        alert("Please enter Mobile Number");
                        $("#lblmobilenonotself").focus();
                        $("#mobileno").focus();
                    } else if ($.trim(response) == "invalidmobile") {
                        alert("Please enter valid Mobile Number");
                        $("#lblmobilenonotself").focus();
                        $("#mobilenonotself").focus();
                    } else if ($.trim(response) == "villagename") {
                        alert("Please enter Village Name");
                        $("#villagename").focus();
                    } else if ($.trim(response) == "kjmmember") {
                        alert("Please enter KJM Member");
                        $("#kjmmember").focus();
                    } else if ($.trim(response) == "residentaladdress") {
                        alert("Please enter Residential Address");
                        $("#residentaladdress").focus();
                    } else if ($.trim(response) == "residentalsuburb") {
                        alert("Please enter Residential Suburb");
                        $("#residentalsuburb").focus();
                    } else if ($.trim(response) == "residentalpincode") {
                        alert("Please enter Residential Pin Code");
                        $("#residentalpincode").focus();
                    } else if ($.trim(response) == "residentalcity") {
                        alert("Please enter Residential Pin City");
                        $("#residentalcity").focus();
                    } else if ($.trim(response) == "residentalstate") {
                        alert("Please enter Residential State");
                        $("#residentalstate").focus();
                    } else if ($.trim(response) == "residentalcountry") {
                        alert("Please enter Residential Country");
                        $("#residentalcountry").focus();
                    } else if ($.trim(response) == "sampraday") {
                        alert("Please select Main Gyati");
                        $("#sampraday").focus();
                    } else if ($.trim(response) == "subreligion") {
                        alert("Please select Sub Gyati");
                        $("#subreligion").focus();
                    } else if ($.trim(response) == "subsubreligion") {
                        alert("Please select Sampraday");
                        $("#subsubreligion").focus();
                    } else if ($.trim(response) == "ismember") {
                        alert("Please select Is Member");
                        $("#ismember").focus();
                    } else if ($.trim(response) == "natureofwork") {
                        alert("Please select Nature of Work");
                        $("#natureofwork").focus();
                    } else if ($.trim(response) == "mediclaimpolicy") {
                        alert("Please select Mediclaim Policy");
                        $("#mediclaimpolicy").focus();
                    } else if ($.trim(response) == "error") {
                        alert("Unknown error occurred. Please try again");
                    } else {
                        alert("Something went wrong. Please try again.");
                    }


                }

            });
        }
    }

    function editRecord(id) {
        $("#overlaydiv").css("display", "block");
        $.ajax({
            type: "POST",
            url: "appGetProfileEdit.php",
            dataType: "JSON",
            data: {id: id},
            success: function (response) {
                console.log(response);
                //	alert($("#mobileno"+id).val());

                $("#firstname").val(response["firstname"]);
                $("#middlename").val(response["middlename"]);
                $("#grandfathername").val(response["grandfathername"]);
                $("#lastname").val(response["lastname"]);
                $("input[name=gender][value='" + response["gender"] + "']").prop('checked', 'checked');
                $("#dateofbirth").val(response["dateofbirth"]);
                $("#maritialstatus").val(response["maritialstatus"]);
                if ($('#maritialstatus').val() == 'Married') {
                    $("#divanniversarydate").css("display", "block");
                } else {
                    $("#divanniversarydate").css("display", "none");
                }
                $("#anniversarydate").val(response["anniversarydate"]);
                if ($('#maritialstatus').val() == 'Married' || $('#maritialstatus').val() == '') {
                    $("#diveligibleformarriage").css("display", "none");
                } else {
                    $("#diveligibleformarriage").css("display", "block");
                }
                if (response["eligibleformarriage"] == "true") {
                    $('input[id=eligibleformarriage]').prop('checked', true);
                } else {
                    $('input[id=eligibleformarriage]').prop('checked', false);
                }
                $("#editprofilephoto").attr('src', "img/profilephoto/" + response["editprofilephoto"]);
                $("#photodiv").css("display", "block");
                $("#bloodgroup").val(response["bloodgroup"]);
                $("#relationshipwithmainperson").val(response["relationshipwithmainperson"]);
                if (response["relationshipwithmainperson"] == "Self") {
                    $("#selfmobile").css("display", "block");
                    $("#mobilenonotself").css("display", "none");
                    $("#mobileno").val(response["mobileno"]);
                } else {
                    $("#selfmobile").css("display", "none");
                    $("#mobilenonotself").css("display", "block");
                    $("#lblmobilenonotself").val(response["mobileno"]);
                }
                fillResidentSurburb();
                if (response["deceased"] == 'true') {
                    $('input[name=deceased]').attr('checked', true).triggerHandler('click');
                    $("#DeathAnniversaryDiv").css({'display': 'block'});
                }
                $("#dateofdeathanniversary").val(response["dateofdeathanniversary"]);
                $("#mobileno").val(response["mobileno"]);
                $("#emailid").val(response["emailid"]);
                $("#alternativemobileno").val(response["alternativemobileno"]);
                $("#displaycontactdetails").val(response["displaycontactstatus"]);
                $("#educationqualification").val(response["educationqualification"]);
                $("#otherachivements").val(response["otherachivements"]);
                $("#residentaladdress").val(response["residentaladdress"]);
                $("#residentalsuburb").val(response["residentalsuburb"]);
                $("#residentalpincodeselect").val(response["residentalpincode"]);

                $("#residentalcity").val(response["residentalcity"]);
                $("#residentalstate").val(response["residentalstate"]);
                $("#residentalcountry").val(response["residentalcountry"]);
                if (response["relationshipwithmainperson"] == "Self") {
                    $("#residentalcity").val("Mumbai");
                    $("#residentalstate").val("Maharashtra");
                    $("#residentalcountry").val("India");
                }
                $("#residentalphone").val(response["residentalphone"]);
                $("#sampraday").val(response["sampraday"]);
                $("#subreligion").val(response["subreligion"]);
                $("#subsubreligion").val(response["subsubreligion"]);
                $("#ismember").val(response["ismember"]);
                $("#natureofwork").val(response["natureofwork"]);
                if ($('#natureofwork').val() == 'Housewife' || $('#natureofwork').val() == 'Retired' || $('#natureofwork').val() == 'Student') {
                    $("#divworkinfo").css("display", "none");
                } else {
                    $("#divworkinfo").css("display", "block");
                }
                $("#nameofcompany").val(response["nameofcompany"]);
                $("#typeofbusiness").val(response["typeofbusiness"]);
                $("#businessdesp").val(response["businessdesp"]);
                $("#officeaddress").val(response["officeaddress"]);
                $("#officesuburb").val(response["officesuburb"]);
                $("#officepincode").val(response["officepincode"]);
                $("#officecity").val(response["officecity"]);
                $("#officestate").val(response["officestate"]);
                $("#officecountry").val(response["officecountry"]);
                $("#officephone").val(response["officephone"]);
                $("#officeemail").val(response["officeemail"]);
                $("#officewebsite").val(response["officewebsite"]);
                $("#mediclaimpolicy").val(response["mediclaimpolicy"]);
                if ($('#mediclaimpolicy').val() == 'yes') {
                    $("#divmediclaimtype").css("display", "block");
                } else {
                    $("#divmediclaimtype").css("display", "none");
                }
                $("#mediclaimtype").val(response["mediclaimtype"]);
                $("#facebook").val(response["facebook"]);
                $("#twitter").val(response["twitter"]);
                $("#linkedin").val(response["linkedin"]);
                $("#instagram").val(response["instagram"]);
                $("#btnSubmit").val("Update");
                $("#overlaydiv").css("display", "none");
            }
        });
    }

    function getPinCodeResi(id) {
        $("#overlaydiv").css("display", "block");
        $.ajax({
            type: "GET",
            url: "https://api.postalpincode.in/pincode/" + id,
            dataType: "JSON",
            data: {},
            success: function (response) {
                if (response["0"]["Message"] != "No records found") {
                    $("#residentalcity").val(response["0"]["PostOffice"]["0"]["Region"]);
                    $("#residentalstate").val(response["0"]["PostOffice"]["0"]["State"]);
                    $("#residentalcountry").val("India");
                    $("#residentalphone").focus();
                    $("#overlaydiv").css("display", "none");
                } else {
                    $("#residentalcity").val("");
                    $("#residentalstate").val("");
                    $("#residentalcountry").val("");
                    $("#residentalcity").focus();
                    $("#overlaydiv").css("display", "none");
                }
            }
        });
    }

    function getPinCodeOff(id) {
        $("#overlaydiv").css("display", "block");
        $.ajax({
            type: "GET",
            url: "https://api.postalpincode.in/pincode/" + id,
            dataType: "JSON",
            data: {},
            success: function (response) {
                if (response["0"]["Message"] != "No records found") {
                    $("#officecity").val(response["0"]["PostOffice"]["0"]["Region"]);
                    $("#officestate").val(response["0"]["PostOffice"]["0"]["State"]);
                    $("#officecountry").val("India");
                    $("#officephone").focus();
                    $("#overlaydiv").css("display", "none");
                } else {
                    $("#officecity").val("");
                    $("#officestate").val("");
                    $("#officecountry").val("");
                    $("#officecity").focus();
                    $("#overlaydiv").css("display", "none");

                }
            }
        });
    }

    function validationCheck() {
        //----------Validation Start--------------------
        if ($("#firstname").val() == "") {
            $("#errfirstname").html("");
            $('#firstname').css('border-color', 'red');
            $('#firstname').after('<span id="errfirstname"><i class="fa fa-exclamation-circle text-error"> Please Enter First Name</i></span>');
            $("#firstname").focus();
            return false;
        } else if ($("#middlename").val() == "") {
            $("#errmiddlename").html("");
            $('#middlename').css('border-color', 'red');
            $('#middlename').after('<span id="errmiddlename"><i class="fa fa-exclamation-circle text-error"> Please Enter Middle Name</i></span>');
            $("#middlename").focus();
            return false;
        } else if ($("#grandfathername").val() == "") {
            $("#errgrandfathername").html("");
            $('#grandfathername').css('border-color', 'red');
            $('#grandfathername').after('<span id="errgrandfathername"><i class="fa fa-exclamation-circle text-error"> Please Enter Grandfather Name</i></span>');
            $("#grandfathername").focus();
            return false;
        } else if ($("#lastname").val() == "") {
            $("#errlastname").html("");
            $('#lastname').css('border-color', 'red');
            $('#lastname').after('<span id="errlastname"><i class="fa fa-exclamation-circle text-error"> Please Enter Last Name</i></span>');
            $("#lastname").focus();
            return false;
        } else if ($("#dateofbirth").val() == "") {
            $("#errdateofbirth").html("");
            $('#dateofbirth').css('border-color', 'red');
            $('#dateofbirth').after('<span id="errdateofbirth"><i class="fa fa-exclamation-circle text-error"> Please Enter Date of Birth</i></span>');
            $("#dateofbirth").focus();
            return false;
        } else if ($("#maritialstatus").val() == "") {
            $("#errmaritialstatus").html("");
            $('#maritialstatus').css('border-color', 'red');
            $('#maritialstatus').after('<span id="errmaritialstatus"><i class="fa fa-exclamation-circle text-error"> Please Select Maritial Status</i></span>');
            $("#maritialstatus").focus();
            return false;
        } else if ($("#bloodgroup").val() == "") {
            $("#errbloodgroup").html("");
            $('#bloodgroup').css('border-color', 'red');
            $('#bloodgroup').after('<span id="errbloodgroup"><i class="fa fa-exclamation-circle text-error"> Please Select Blood Group</i></span>');
            $("#bloodgroup").focus();
            return false;
        } else if ($("#photo").val() == "") {
            $("#errphoto").html("");
            $('#photo').css('border-color', 'red');
            $('#photo').after('<span id="errphoto"><i class="fa fa-exclamation-circle text-error"> Please Upload Photo</i></span>');
            $("#photo").focus();
            return false;
        } else if ($("#relationshipwithmainperson").val() == "") {
            $("#errrelationshipwithmainperson").html("");
            $('#relationshipwithmainperson').css('border-color', 'red');
            $('#relationshipwithmainperson').after('<span id="errrelationshipwithmainperson"><i class="fa fa-exclamation-circle text-error"> Please Select Relationship with Main Person Name</i></span>');
            $("#relationshipwithmainperson").focus();
            return false;
        } else if ($("#mobileno").val() == "") {
            $("#errmobileno").html("");
            $('#mobileno').css('border-color', 'red');
            $('#mobileno').after('<span id="errmobileno"><i class="fa fa-exclamation-circle text-error"> Please Enter Mobile No </i></span>');
            $("#mobileno").focus();
            return false;
        } else if ($("#residentaladdress").val() == "") {
            $("#errresidentaladdress").html("");
            $('#residentaladdress').css('border-color', 'red');
            $('#residentaladdress').after('<span id="errresidentaladdress"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Address </i></span>');
            $("#residentaladdress").focus();
            return false;
        } else if ($("#residentalsuburb").val() == "") {
            $("#errresidentalsuburb").html("");
            $('#residentalsuburb').css('border-color', 'red');
            $('#residentalsuburb').after('<span id="errresidentalsuburb"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Suburb</i></span>');
            $("#residentalsuburb").focus();
            return false;
        } else if ($("#residentalpincode").val() == "") {
            $("#errresidentalpincode").html("");
            $('#residentalpincode').css('border-color', 'red');
            $('#residentalpincode').after('<span id="errresidentalpincode"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Pincode</i></span>');
            $("#residentalpincode").focus();
            return false;
        } else if ($("#residentalcity").val() == "") {
            $("#errresidentalcity").html("");
            $('#residentalcity').css('border-color', 'red');
            $('#residentalcity').after('<span id="errresidentalcity"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential City</i></span>');
            $("#residentalcity").focus();
            return false;
        } else if ($("#residentalstate").val() == "") {
            $("#errresidentalstate").html("");
            $('#residentalstate').css('border-color', 'red');
            $('#residentalstate').after('<span id="errresidentalstate"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential State</i></span>');
            $("#residentalstate").focus();
            return false;
        } else if ($("#residentalcountry").val() == "") {
            $("#errresidentalcountry").html("");
            $('#residentalcountry').css('border-color', 'red');
            $('#residentalcountry').after('<span id="errresidentalcountry"><i class="fa fa-exclamation-circle text-error"> Please Enter Residential Country</i></span>');
            $("#residentalcountry").focus();
            return false;
        } else if ($("#sampraday").val() == "") {
            $("#errsampraday").html("");
            $('#sampraday').css('border-color', 'red');
            $('#sampraday').after('<span id="errsampraday"><i class="fa fa-exclamation-circle text-error"> Please Select Main Gyati</i></span>');
            $("#sampraday").focus();
            return false;
        } else if ($("#subreligion").val() == "") {
            $("#errsubreligion").html("");
            $('#subreligion').css('border-color', 'red');
            $('#subreligion').after('<span id="errsubreligion"><i class="fa fa-exclamation-circle text-error"> Please Select Sub Gyati</i></span>');
            $("#subreligion").focus();
            return false;
        } else if ($("#subsubreligion").val() == "") {
            $("#errsubsubreligion").html("");
            $('#subsubreligion').css('border-color', 'red');
            $('#subsubreligion').after('<span id="errsubsubreligion"><i class="fa fa-exclamation-circle text-error"> Please Select Sampraday</i></span>');
            $("#subsubreligion").focus();
            return false;
        } else if ($("#ismember").val() == "") {
            $("#errismember").html("");
            $('#ismember').css('border-color', 'red');
            $('#ismember').after('<span id="errismember"><i style="color:red" class="fa fa-exclamation-circle"> Please Select Is Member</i></span>');
            $("#ismember").focus();
            return false;
        } else {
            return true;
        }
        //----------Validation End----------------------


    }
</script>

</body>

</html>
