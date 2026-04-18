<?php
    include("db_connect.php");
    $db = new DB_Connect();
    $con = $db->connect();

    $userid = $_POST["userid"];
    $searchTerm = $_POST["searchterm"];
    $Profile = $_POST["Profile"];

    $table = "<div style='font-size:18px;font-weight:600;color:#263238;margin-bottom:12px;'>Search Result</div>";

    function renderCard($row, $userid, $con) {

        /* ------------------ Background Logic ------------------ */

        if ($row["deceased"] == "true") {

            // Muted memorial styling
            $gradient = "linear-gradient(180deg,#f3f4f7 0%,#e6e8ee 100%)";
            $accent   = "#b0bec5";

            $photoStyle = "height:60px;width:60px;border-radius:16px;object-fit:cover;
                       filter:grayscale(70%);opacity:0.85;";

            $memorialTag = "<div style='font-size:11px;color:#78909c;margin-bottom:4px;'>🕊 In Loving Memory</div>";

            $deathDate = "";
            if (!empty($row["dateofdeathanniversary"]) && $row["dateofdeathanniversary"] != "0000-00-00") {
                $dObj = new DateTime($row["dateofdeathanniversary"]);
                $deathDate = "<div style='font-size:11px;color:#90a4ae;margin-bottom:4px;'>
                          Passed on ".$dObj->format('d M Y')."
                          </div>";
            }

        } else {

            $memorialTag = "";
            $deathDate = "";

            if ($row["gender"] == "Female") {
                $gradient = "linear-gradient(180deg,#fff7fa 0%,#fdecef 100%)";
                $accent   = "#f48fb1";
            } else {
                $gradient = "linear-gradient(180deg,#f4f9ff 0%,#e8f2fb 100%)";
                $accent   = "#90caf9";
            }

            $photoStyle = "height:60px;width:60px;border-radius:16px;object-fit:cover;";
        }

        /* ------------------ Update Search Count ------------------ */

        $searchprofilecount = (!empty($row["searchprofilecount"]))
            ? $row["searchprofilecount"] + 1
            : 1;

        mysqli_query($con, "update pp_profileinfo set searchprofilecount='$searchprofilecount' where id='".$row["id"]."'");

        /* ------------------ Profile Info ------------------ */

        $dob = "";
        if (!empty($row["dateofbirth"]) && $row["dateofbirth"] != "0000-00-00") {
            $dobObj = new DateTime($row["dateofbirth"]);
            $dob = $dobObj->format('d M Y');
        }

        $blood = (!empty($row["bloodgroup"]))
            ? "<span style='color:#d84315;'>• ".$row["bloodgroup"]."</span>"
            : "";

        $work = (!empty($row["nameofcompany"]))
            ? $row["nameofcompany"]." • ".$row["typeofbusiness"]
            : "";

        $userIcon = "👤";
        if ($row["gender"] == "Male") $userIcon = "👨";
        if ($row["gender"] == "Female") $userIcon = "👩";

        $contact = "";
        if (!empty($row["mobileno"])) {
            $contact .= "<a href='tel:".$row["mobileno"]."' 
                     style='color:#37474f;text-decoration:none;'>".$row["mobileno"]."</a>";
        }
        if (!empty($row["emailid"])) {
            if ($contact != "") $contact .= " • ";
            $contact .= "<a href='mailto:".$row["emailid"]."' 
                     style='color:#37474f;text-decoration:none;'>".$row["emailid"]."</a>";
        }

        /* ------------------ My List Check ------------------ */

        $mylistdiv = "";

        /* ------------------ Card Layout ------------------ */
        $photo = (!empty($row["photo"])) ? $row["photo"] : "placeholder.png";
        return "
    <div style='
        background:$gradient;
        border-radius:18px;
        padding:14px;
        margin-bottom:14px;
        box-shadow:0 3px 10px rgba(0,0,0,0.04);
        position:relative;
        overflow:hidden;'>

        <div style='
            position:absolute;
            left:0;
            top:0;
            bottom:0;
            width:4px;
            background:$accent;'></div>



        <div style='display:flex;align-items:flex-start;'>

            <div style='margin-right:12px;'>
                <img src='img/profilephoto/".$photo."' style='".$photoStyle."'>
            </div>

            <div style='flex:1;'>

                <div style='font-size:15px;font-weight:600;color:#263238;margin-bottom:3px;'>
                    $userIcon ".ucfirst($row["firstname"])." "
            .ucfirst($row["middlename"])." "
            .ucfirst($row["lastname"])."
                </div>

                $memorialTag
                $deathDate

                <div style='font-size:12px;color:#78909c;margin-bottom:4px;'>
                    $dob $blood
                </div>

                <div style='font-size:12px;color:#607d8b;margin-bottom:6px;'>
                    ".$row["residentalsuburb"].", ".$row["residentalcity"]."
                </div>

                ".($row["displaycontactstatus"] == "yes" ?
                "<div style='font-size:12px;margin-bottom:6px;color:#37474f;'>$contact</div>" : "")."

                <div style='font-size:12px;color:#546e7a;margin-bottom:8px;'>
                    $work
                </div>

                <div style='display:flex;justify-content:space-between;font-size:11px;color:#455a64;'>

                    <div onclick='familymember(".$row["id"].",".$userid.")'
                         style='cursor:pointer;'>👪 Family</div>

                    <div onclick='profilepage(".$row["id"].",".$userid.")'
                         style='cursor:pointer;'>👁 View</div>

                    <div>
                        <a style='color:#455a64;text-decoration:none;' class='btn1'
                           data-clipboard-text='https://www.asanjodumra.com/mobile-app/pgviewprofileinfobyshare.php?id=".$row["id"]."'
                           onclick='buttonclick();'>📋</a>
                    </div>

                </div>

            </div>
        </div>
    </div>";
    }


    /* ------------------ Query ------------------ */

    if ($Profile == "Primary") {
        $Qwv = "Select * from pp_profileinfo 
            where status='on' 
            and relationshipwithmainperson='Self' 
            and ($searchTerm) 
            order by firstname,lastname";
    } else {
        $Qwv = "Select * from pp_profileinfo 
            where status='on' 
            and ($searchTerm) 
            order by firstname,lastname";
    }

    $runi = mysqli_query($con, $Qwv);
    $i = 0;

    while ($row = mysqli_fetch_array($runi)) {
        $table .= renderCard($row, $userid, $con);
        $i++;
    }

    if ($i == 0) {
        $table .= "<div style='color:#90a4ae;font-size:14px;margin-top:10px;'>No record found</div>";
    }

    echo $table;
?>
