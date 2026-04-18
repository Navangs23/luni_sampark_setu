<?php
    include("db_connect.php");
    $db = new DB_Connect();
    $con = $db->connect();

    $userid = $_POST["userid"];
    $searchTerm = $_POST["searchterm"];
    $Profile = $_POST["Profile"];

    $table = "<div style='font-size:18px;font-weight:600;color:#263238;margin-bottom:12px;'>Search Result</div>";

    function renderCard($row, $userid, $con) {

        /* ------------------ Styling (Always Yellow) ------------------ */

        $gradient = "linear-gradient(180deg,#fffde7 0%,#fff9c4 100%)"; // Yellow 50-100
        $accent   = "#fbc02d"; // Yellow 700

        // Keep photo logic for deceased/gender for the image itself, but not card background
        $photoStyle = "height:60px;width:60px;border-radius:16px;object-fit:cover;";
        if ($row["deceased"] == "true") {
             $photoStyle .= "filter:grayscale(100%);opacity:0.8;";
             $memorialTag = "<div style='font-size:11px;color:#78909c;margin-bottom:4px;'>🕊 In Loving Memory</div>";
        } else {
             $memorialTag = "";
        }

        /* ------------------ Update Search Count ------------------ */

        $searchprofilecount = (!empty($row["searchprofilecount"])) ? $row["searchprofilecount"] + 1 : 1;
        mysqli_query($con, "update pp_profileinfo set searchprofilecount='$searchprofilecount' where id='".$row["id"]."'");

        /* ------------------ Business Info ------------------ */

        $companyName = !empty($row["nameofcompany"]) ? $row["nameofcompany"] : "";
        $personName = ucfirst($row["firstname"])." ".ucfirst($row["middlename"])." ".ucfirst($row["lastname"]);
        $userIcon = ($row["gender"] == "Female") ? "👩" : "👨";

        // Header Logic
        if ($companyName != "") {
             $mainTitle = "🏢 " . $companyName;
             $subTitle = "<div style='font-size:13px;color:#5d4037;margin-bottom:4px;font-weight:500;'>Owner: " . $personName . "</div>";
        } else {
             $mainTitle = $userIcon . " " . $personName;
             $subTitle = "";
        }

        // Business Categories
        $businessInfo = "";
        if(!empty($row["natureofwork"])) $businessInfo .= $row["natureofwork"];
        if(!empty($row["typeofbusiness"])) {
            if($businessInfo != "") $businessInfo .= " • ";
            $businessInfo .= $row["typeofbusiness"];
        }

        // Description (Truncated ?? potentially long)
        $description = "";
        if(!empty($row["businessdesp"])) {
            // strip tags just in case, though usually plain text
            $descText = strip_tags($row["businessdesp"]);
            if (strlen($descText) > 60) {
                 $descText = substr($descText, 0, 60) . "...";
            }
            $description = "<div style='font-size:11px;color:#795548;margin-bottom:6px;font-style:italic;'>" . $descText . "</div>";
        }

        // Address (Strictly Office)
        $addressParts = [];
        if(!empty($row["officeaddress"])) $addressParts[] = $row["officeaddress"];
        if(!empty($row["officesuburb"])) $addressParts[] = $row["officesuburb"];
        if(!empty($row["officecity"])) $addressParts[] = $row["officecity"];
        
        $address = "";
        if (!empty($addressParts)) {
             $address = implode(", ", $addressParts);
        }

        /* ------------------ Contact Info ------------------ */

        $contactDivs = "";
        
        // Mobile
        if (!empty($row["mobileno"])) {
            $contactDivs .= "<div><a href='tel:".$row["mobileno"]."' style='color:#4e342e;text-decoration:none;'>📞 ".$row["mobileno"]."</a></div>";
        }
        
        // Office Phone
        if (!empty($row["officephone"])) {
            $contactDivs .= "<div><a href='tel:".$row["officephone"]."' style='color:#4e342e;text-decoration:none;'>☎  ".$row["officephone"]."</a></div>";
        }

        // Email (Office pref)
        $email = !empty($row["officeemail"]) ? $row["officeemail"] : $row["emailid"];
        if (!empty($email)) {
             $contactDivs .= "<div><a href='mailto:".$email."' style='color:#4e342e;text-decoration:none;'>✉ ".$email."</a></div>";
        }

        // Website
        if (!empty($row["officewebsite"])) {
             $website = $row["officewebsite"];
             // Ensure protocol for link
             $link = (strpos($website, 'http') === 0) ? $website : "https://" . $website;
             $contactDivs .= "<div><a href='".$link."' target='_blank' style='color:#0277bd;text-decoration:none;'>🌐 $link</a></div>";
        }

        /* ------------------ My List Check ------------------ */

        $mylistdiv = "";

        /* ------------------ Card Layout ------------------ */
        $photo = (!empty($row["photo"])) ? $row["photo"] : "placeholder.png";
        return "
    <div style='background:$gradient;border-radius:18px;padding:14px;margin-bottom:14px;box-shadow:0 4px 12px rgba(251, 192, 45, 0.15);position:relative;overflow:hidden;border:1px solid #fff59d;'>
        <div style='position:absolute;left:0;top:0;bottom:0;width:5px;background:$accent;'></div>

        <div style='display:flex;align-items:flex-start;'>
            <div style='margin-right:12px;'>
                <img src='img/profilephoto/".$photo."' style='".$photoStyle."'>
            </div>
            <div style='flex:1;'>
                <div style='font-size:16px;font-weight:700;color:#3e2723;margin-bottom:2px;'>
                    $mainTitle
                </div>
                $subTitle
                $memorialTag

                <div style='font-size:12px;color:#ef6c00;font-weight:600;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px;'>
                    $businessInfo
                </div>

                $description

                " . ($address != "" ? "<div style='font-size:12px;color:#5d4037;margin-bottom:8px;'>📍 $address</div>" : "") . "

                ".($row["displaycontactstatus"] == "yes" ? 
                "<div style='font-size:12px;margin-bottom:8px;line-height:1.6;'>$contactDivs</div>" : "")."

                <div style='display:flex;justify-content:space-between;font-size:11px;color:#6d4c41;margin-top:8px;border-top:1px solid rgba(0,0,0,0.05);padding-top:8px;'>
                    
                    <div onclick='profilepage(".$row["id"].",".$userid.")' style='cursor:pointer;'>👁 View Profile</div>
                    <div>
                        <a style='color:#6d4c41;text-decoration:none;' class='btn1' data-clipboard-text='https://www.asanjodumra.com/mobile-app/pgviewprofileinfobyshare.php?id=".$row["id"]."' onclick='buttonclick();'>📋 Share</a>
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
