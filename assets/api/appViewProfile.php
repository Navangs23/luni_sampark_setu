<?php
    include("db_connect.php");
    $db = new DB_Connect();
    $con = $db->connect();

    $id = $_REQUEST["id"];
    $userid = $_REQUEST["userid"];
    //echo $id;
    $qws = "Select * from pp_profileinfo where id='" . $id . "'";
    $runii = mysqli_query($con, $qws);
    $row = mysqli_fetch_array($runii);
    //echo $qws;

    //echo $row["dateofbirth"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .mySlides {
            display: none;
        }

        @media screen and (max-width: 600px) {
            #login {
                visibility: hidden;
                display: none;
            }

            #mobile_menu {
                margin-left: 80%;
                margin: 15px;
            }

            #desktop_logo {
                visibility: hidden;
                display: none;
                width: 0px;
            }

            #mobile_logo {
                height: 100%;
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

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
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
                height: 120px;
                width: auto;

            }

            .adsimg2 {
                margin-right: 150px !important;
            }
        }

    </style>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
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
        <section class="wrapper" style="margin-top:0px !important;">

            <div class="row">
                <div class="col-12">
                    <?php
                        $gradient = "";
                        $accent = "";

                        if ($row["deceased"] == "true") {
                            $gradient = "linear-gradient(180deg,#f5f5f5 0%,#eeeeee 100%)";
                            $accent = "#bdbdbd"; // Dark Gray
                        } else if ($row["gender"] == "Female") {
                            $gradient = "linear-gradient(180deg,#fff7fa 0%,#fdecef 100%)";
                            $accent = "#f48fb1"; // Pink
                        } else {
                            $gradient = "linear-gradient(180deg,#f4f9ff 0%,#e8f2fb 100%)";
                            $accent = "#90caf9"; // Blue
                        }
                    ?>
                    <div style="background:<?php echo $gradient; ?>;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:<?php echo $accent; ?>;"></div>

                        <div class="panel-body" style="background:transparent; border:none;">
                            <!-- Removed class 'follow-ava' to prevent external CSS interference (borders/backgrounds) -->
                            <div style="display:flex; justify-content:center; align-items:center; width:100%; margin-bottom:10px;">
                                <?php
                                    // Force 100x100 square with flex-shrink to prevent oval distortion
                                    $imgStyle = "flex-shrink:0; width:100px; height:100px; min-width:100px; min-height:100px; max-width:100px; max-height:100px; border-radius:50%; object-fit:cover; border:3px solid white; box-shadow:0 2px 5px rgba(0,0,0,0.1); display:block;";
                                    if ($row["deceased"] == "true") {
                                        $imgStyle .= "filter:grayscale(100%);";
                                    }
                                    echo "<img style='" . $imgStyle . "' src='img/profilephoto/" . $row['photo'] . "'>";
                                ?>
                            </div>
                            <div class="follow-info" style="text-align:center; padding-top:10px">
                                <div style="font-size:20px; font-weight:bold; color:#263238; margin-bottom:5px;">
                                    <?php echo ucfirst($row["firstname"]) . " " . ucfirst($row["middlename"]) . " " . ucfirst($row["grandfathername"]) . " " . ucfirst($row["lastname"]); ?>
                                </div>

                                <div style="font-size:13px; color:#455a64; margin-bottom:10px;">
                                    <?php echo $row["gender"] . " • " . $row["maritialstatus"] . " • " . $row["natureofwork"]; ?>
                                </div>

                                <?php if ($row["deceased"] == "true") { ?>
                                    <div style="font-size:12px; color:#616161; margin-bottom:10px; font-weight:bold;">
                                        🕊 In Loving Memory
                                    </div>
                                <?php } ?>

                                <div style="display:flex; justify-content:center; gap:15px; margin-bottom:10px;">
                                    <a class="btn1"
                                       data-clipboard-text="https://www.fairlorry.com/luni/pgviewprofileinfobyshare.php?id=<?php echo $row["id"]; ?>"
                                       onClick="buttonclick();" style="cursor:pointer;color:#455a64;font-size:18px;">
                                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                                    </a>
                                    <!--<a href="https://api.whatsapp.com/send?text=http://avjsm.in/pgviewprofileinfobyshare.php?id=<?php //echo $row["id"];?>" target="_blank" style="color:#fff;"><img src="img/whatsappimg.png" style="width:20px;height:20px;"></a>-->
                                    <a href="https://wa.me/?text=https://www.fairlorry.com/luni/pgviewprofileinfobyshare.php?id=<?php echo $row["id"]; ?>"
                                       data-action="share/whatsapp/share">
                                        <img src="img/whatsappimg.png" style="width:24px;height:24px;">
                                    </a>
                                </div>

                                <div style="font-size:13px; font-weight:600;">
                                    <a href="appFamilyTree.php?member_id=<?php echo $row["id"]; ?>&userid=<?php echo $userid; ?>"
                                       style="cursor:pointer;color:#D81C5B; text-decoration:none;">
                                        View Family Details <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                        <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                            Basic Info
                        </div>

                        <div class="panel-body" style="padding:0; border:none; background:transparent;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div style="font-size:12px; color:#78909c;">Date of Birth / જન્મ તારીખ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500;">
                                        <?php
                                            if ($row["dateofbirth"] == "0000-00-00") {
                                                echo "00/00/0000";
                                            } else {
                                                $date = new DateTime($row["dateofbirth"]);
                                                echo $date->format('d/m/Y');
                                            }
                                        ?>
                                    </div>

                                    <hr style="margin-top:10px;margin-bottom:10px; border-top:1px solid #f0f0f0;">

                                    <?php if ($row["anniversarydate"] != "" && $row["maritialstatus"] == "Married") { ?>
                                        <div style="font-size:12px; color:#78909c;">Anniversary Date / લગ્નની વર્ષગાંઠની
                                            તારીખ
                                        </div>
                                        <div style="font-size:14px; color:#263238; font-weight:500;">
                                            <?php
                                                $date = new DateTime($row["anniversarydate"]);
                                                echo $date->format('d/m/Y');
                                            ?>
                                        </div>
                                        <hr style="margin-top:10px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                    <?php } ?>

                                    <?php if ($row["dateofdeathanniversary"] != "" && $row["deceased"] == "true") { ?>
                                        <div style="font-size:12px; color:#78909c;">Date of Demise / મરણ ની તારીખ</div>
                                        <div style="font-size:14px; color:#263238; font-weight:500;">
                                            <?php
                                                $date = new DateTime($row["dateofdeathanniversary"]);
                                                echo $date->format('d/m/Y');
                                            ?>
                                        </div>
                                        <hr style="margin-top:10px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                    <?php } ?>

                                    <div style="font-size:12px; color:#78909c;">Blood Group / બ્લડ ગ્રુપ</div>
                                    <div style="font-size:14px; color:#d84315; font-weight:bold;">
                                        <?php echo $row["bloodgroup"]; ?>
                                    </div>

                                    <hr style="margin-top:10px;margin-bottom:10px; border-top:1px solid #f0f0f0;">

                                    <div style="font-size:12px; color:#78909c;">Relationship with Main Person / મુખ્ય
                                        વ્યક્તિ સાથે સંબંધ
                                    </div>
                                    <div style="font-size:14px; color:#263238; font-weight:500;">
                                        <?php echo $row["relationshipwithmainperson"]; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Div Start -->
            <?php
                $displayFlag = "";
                if (isset($row["displaycontactstatus"])) {
                    $displayFlag = $row["displaycontactstatus"];
                } else {
                    $displayFlag = "yes";
                }

                if ($displayFlag == "yes") {
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                                <!-- Accent Bar -->
                                <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                                <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                                    Contact Info
                                </div>

                                <div class="panel-body" style="padding:0; border:none; background:transparent;">
                                    <?php if ($row["mobileno"] != "") { ?>
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-xs-6">
                                                <div style="font-size:12px; color:#78909c;">Mobile Number / મોબાઇલ
                                                    નંબર
                                                </div>
                                                <div style="font-size:14px; margin-top:2px;">
                                                    <i class="fa fa-mobile" style="font-size:16px; color:#455a64;"></i>
                                                    <a href="tel:<?php echo $row["mobileno"]; ?>"
                                                       style="color:#263238;font-weight:500;text-decoration:none;"><?php echo $row["mobileno"]; ?></a>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="tel:<?php echo $row["mobileno"]; ?>"><img
                                                            src="img/ic_phone.png" style="width:24px;"></a>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="sms:<?php echo $row["mobileno"]; ?>"><img src="img/ic_sms.png"
                                                                                                   style="width:24px;"></a>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="https://wa.me/+91<?php echo $row["mobileno"]; ?>"><img
                                                            src="img/ic_whatsapp.png" style="width:24px;"></a>
                                            </div>
                                        </div>
                                        <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                    <?php } ?>

                                    <?php if ($row["alternativemobileno"] != "") { ?>
                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-xs-6">
                                                <div style="font-size:12px; color:#78909c;">Alt. Mobile / વૈકલ્પિક
                                                    મોબાઇલ
                                                </div>
                                                <div style="font-size:14px; margin-top:2px;">
                                                    <i class="fa fa-mobile" style="font-size:16px; color:#455a64;"></i>
                                                    <a href="tel:<?php echo $row["alternativemobileno"]; ?>"
                                                       style="color:#263238;font-weight:500;text-decoration:none;"><?php echo $row["alternativemobileno"]; ?></a>
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="tel:<?php echo $row["alternativemobileno"]; ?>"><img
                                                            src="img/ic_phone.png" style="width:24px;"></a>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="sms:<?php echo $row["alternativemobileno"]; ?>"><img
                                                            src="img/ic_sms.png" style="width:24px;"></a>
                                            </div>
                                            <div class="col-xs-2">
                                                <a href="https://wa.me/+91<?php echo $row["alternativemobileno"]; ?>"><img
                                                            src="img/ic_whatsapp.png" style="width:24px;"></a>
                                            </div>
                                        </div>
                                        <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                    <?php } ?>

                                    <?php if ($row["emailid"] != "") { ?>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div style="font-size:12px; color:#78909c;">Email ID / ઇમેઇલ આઇડી</div>
                                                <div style="font-size:14px; margin-top:2px;">
                                                    <i class="fa fa-envelope-o" style="color:#455a64;"></i>
                                                    <a href="mailto:<?php echo $row["emailid"]; ?>"
                                                       style="color:#269CD8;font-weight:500;text-decoration:none;"><?php echo $row["emailid"]; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
            <!-- Contact Div End -->

            <div class="row">
                <div class="col-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                        <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                            Educational Info
                        </div>

                        <div class="panel-body" style="padding:0; border:none; background:transparent;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div style="font-size:12px; color:#78909c;">Educational Qualification / શૈક્ષણિક
                                        લાયકાત
                                    </div>
                                    <div style="font-size:14px; color:#263238; font-weight:500;">
                                        <?php echo $row["educationqualification"]; ?>
                                    </div>

                                    <hr style="margin-top:10px;margin-bottom:10px; border-top:1px solid #f0f0f0;">

                                    <div style="font-size:12px; color:#78909c;">Other Achievements & Qualifications /
                                        અન્ય સિદ્ધિઓ અને લાયકાતો
                                    </div>
                                    <div style="font-size:14px; color:#263238; font-weight:500;">
                                        <?php echo $row["otherachivements"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                        <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                            Residence Info
                        </div>

                        <div class="panel-body" style="padding:0; border:none; background:transparent;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div style="font-size:12px; color:#78909c;">Residental Address / રહેઠાણનું સરનામું
                                    </div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["residentaladdress"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Residental Suburb / રહેઠાણ ઉપનગર</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["residentalsuburb"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Residental City / રહેઠાણ શહેર</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["residentalcity"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Residental Pincode / રહેઠાણ પિનકોડ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["residentalpincode"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Residental State / રહેઠાણ રાજ્ય</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["residentalstate"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Residental Country / રહેઠાણ દેશ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["residentalcountry"]; ?>
                                    </div>

                                    <?php if ($row["residentalphone"] != "") { ?>
                                        <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                        <div style="font-size:12px; color:#78909c;">Residental Phone / રહેઠાણનો ફોન
                                        </div>
                                        <div style="font-size:14px; margin-top:2px;">
                                            <i class="fa fa-phone-square" style="color:#455a64;"></i>
                                            <a href="tel:<?php echo $row["residentalphone"]; ?>"
                                               style="color:#263238;font-weight:500;text-decoration:none;"><?php echo $row["residentalphone"]; ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                        <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                            Gyati and Sampraday Info
                        </div>

                        <div class="panel-body" style="padding:0; border:none; background:transparent;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div style="font-size:12px; color:#78909c;">Main Gyati / મુખ્ય જ્ઞાતિ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["sampraday"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Sub Gyati / પેટા જ્ઞાતિ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["subreligion"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Sampraday / સંપ્રદાય</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["subsubreligion"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Is Member / સભ્ય છે</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["ismember"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                        <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                            Work Info
                        </div>

                        <div class="panel-body" style="padding:0; border:none; background:transparent;">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div style="font-size:12px; color:#78909c;">Nature of Work / કામ નો પ્રકાર</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["natureofwork"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Name of the Company / કંપનીનું નામ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["nameofcompany"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Type of Business / વ્યવસાય નો પ્રકાર
                                    </div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["typeofbusiness"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Business Description / વ્યાપાર વર્ણન
                                    </div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["businessdesp"]; ?>
                                    </div>

                                    <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">

                                    <div style="font-size:12px; color:#78909c;">Office Address / ઓફિસનું સરનામું</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["officeaddress"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Office Suburb / ઓફિસ ઉપનગર</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["officesuburb"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Office City / ઓફિસ સિટી</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["officecity"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Office Pincode / ઓફિસ પિનકોડ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["officepincode"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Office State / ઓફિસ સ્ટેટ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["officestate"]; ?>
                                    </div>

                                    <div style="font-size:12px; color:#78909c;">Office Country / ઓફિસ દેશ</div>
                                    <div style="font-size:14px; color:#263238; font-weight:500; margin-bottom:10px;">
                                        <?php echo $row["officecountry"]; ?>
                                    </div>

                                    <?php if ($row["officephone"] != "") { ?>
                                        <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                        <div style="font-size:12px; color:#78909c;">Office Phone / ઓફિસ ફોન નંબર</div>
                                        <div style="font-size:14px; margin-top:2px;">
                                            <i class="fa fa-phone-square" style="color:#455a64;"></i>
                                            <a href="tel:<?php echo $row["officephone"]; ?>"
                                               style="color:#263238;font-weight:500;text-decoration:none;"><?php echo $row["officephone"]; ?></a>
                                        </div>
                                    <?php } ?>

                                    <?php if ($row["officeemail"] != "") { ?>
                                        <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                        <div style="font-size:12px; color:#78909c;">Office Email ID / ઓફિસ ઇમેઇલ આઈડી
                                        </div>
                                        <div style="font-size:14px; margin-top:2px;">
                                            <i class="fa fa-envelope-o" style="color:#455a64;"></i>
                                            <a href="mailto:<?php echo $row["officeemail"]; ?>"
                                               style="color:#269CD8;font-weight:500;text-decoration:none;"><?php echo $row["officeemail"]; ?></a>
                                        </div>
                                    <?php } ?>

                                    <?php if ($row["officewebsite"] != "") { ?>
                                        <hr style="margin-top:5px;margin-bottom:10px; border-top:1px solid #f0f0f0;">
                                        <div style="font-size:12px; color:#78909c;">Office Website / ઓફિસ વેબસાઇટ</div>
                                        <div style="font-size:14px; margin-top:2px;">
                                            <i class="fa fa-globe" style="color:#455a64;"></i>
                                            <?php if (strpos($row["officewebsite"], 'http') === 0) { ?>
                                                <a href="<?php echo $row["officewebsite"]; ?>"
                                                   style="color:#269CD8;font-weight:500;text-decoration:none;"><?php echo $row["officewebsite"]; ?></a>
                                            <?php } else { ?>
                                                <a href="http://<?php echo $row["officewebsite"]; ?>"
                                                   style="color:#269CD8;font-weight:500;text-decoration:none;"><?php echo "http://" . $row["officewebsite"]; ?></a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div style="background:#ffffff;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 3px 10px rgba(0,0,0,0.04);position:relative;overflow:hidden; margin-left:4px; margin-right:4px;">
                        <!-- Accent Bar -->
                        <div style="position:absolute;left:0;top:0;bottom:0;width:4px;background:#D81C5B;"></div>

                        <div style="font-size:16px; font-weight:bold; color:#D81C5B; margin-bottom:15px; border-bottom:1px solid #eee; padding-bottom:10px;">
                            Social Links
                        </div>

                        <div class="panel-body" style="padding:0; border:none; background:transparent;">
                            <div class="row">
                                <div class="col-xs-3" style="text-align:center;">
                                    <?php
                                        if ($row["facebook"] != "") {
                                            ?>
                                            <div style="font-size:11px; color:#78909c; margin-bottom:5px;">Facebook
                                            </div>
                                            <a href="<?php echo $row["facebook"]; ?>"><i
                                                        class="fa fa-facebook-square fa-2x" style="color:#3b5998;"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <div style="font-size:11px; color:#cfd8dc; margin-bottom:5px;">Facebook
                                            </div>
                                            <i class="fa fa-facebook-square fa-2x" style="color:#cfd8dc;"></i>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-xs-3" style="text-align:center;">
                                    <?php
                                        if ($row["twitter"] != "") {
                                            ?>
                                            <div style="font-size:11px; color:#78909c; margin-bottom:5px;">Twitter</div>
                                            <a href="<?php echo $row["twitter"]; ?>"><i
                                                        class="fa fa-twitter-square fa-2x"
                                                        style="color:#00acee;"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <div style="font-size:11px; color:#cfd8dc; margin-bottom:5px;">Twitter</div>
                                            <i class="fa fa-twitter-square fa-2x" style="color:#cfd8dc;"></i>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-xs-3" style="text-align:center;">
                                    <?php
                                        if ($row["linkedin"] != "") {
                                            ?>
                                            <div style="font-size:11px; color:#78909c; margin-bottom:5px;">LinkedIn
                                            </div>
                                            <a href="<?php echo $row["linkedin"]; ?>"><i
                                                        class="fa fa-linkedin-square fa-2x" style="color:#0072b1;"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <div style="font-size:11px; color:#cfd8dc; margin-bottom:5px;">LinkedIn
                                            </div>
                                            <i class="fa fa-linkedin-square fa-2x" style="color:#cfd8dc;"></i>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-xs-3" style="text-align:center;">
                                    <?php
                                        if ($row["instagram"] != "") {
                                            ?>
                                            <div style="font-size:11px; color:#78909c; margin-bottom:5px;">Instagram
                                            </div>
                                            <a href="<?php echo $row["instagram"]; ?>"><i class="fa fa-instagram fa-2x"
                                                                                          style="color:#C13584;"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <div style="font-size:11px; color:#cfd8dc; margin-bottom:5px;">Instagram
                                            </div>
                                            <i class="fa fa-instagram fa-2x" style="color:#cfd8dc;"></i>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="hdnUser" id="hdnUser" value="<?php echo $userid; ?>">
            <input type="hidden" name="hdnid" id="hdnid" value="<?php echo $id; ?>">

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
<script src="js/gdp-data.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!--Copy-->
<script src="https://cdn.jsdelivr.net/npm/clipboard@1/dist/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>

<script>
    $(function () {
        new Clipboard('.btn1');

    });

    function buttonclick() {
        $('#myModalCopy').modal('show');
        setTimeout("$('#myModalCopy').modal('hide');", 2000);
    }
</script>
</script>
</body>

</html>
