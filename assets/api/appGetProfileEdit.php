<?php
    include("db_connect.php");
    $db = new DB_Connect();
    $con = $db->connect();

    $stmtq = $con->prepare("SELECT 
		id,
		familyid,
		password,
		firstname,
		middlename,
		grandfathername,
		lastname,
		dateofbirth,
		bloodgroup,
		gender,
		educationqualification,
		otherachivements,
		villagename,
		residentaladdress,
		residentalsuburb,
		residentalcity,
		residentalpincode,
		residentalstate,
		residentalcountry,
		residentalphone,
		sampraday,
		subreligion,
		subsubreligion,
		ismember,
		displaycontactstatus,
		emailid,
		mobileno,
		kjmmember,
		kjmno,
		maritialstatus,
		anniversarydate,
		eligibleformarriage,
		natureofwork,
		nameofcompany,
		typeofbusiness,
		businessdesp,
		officesuburb,
		officeaddress,
		officecity,
		officepincode,
		officestate,
		officecountry,
		officephone,
		officeemail,
		officewebsite,
		mediclaimpolicy,
		mediclaimtype,
		alternativemobileno,
		photo,
		relationshipwithmainperson,
		deceased,
		dateofdeathanniversary,
		facebook,
		twitter,
		linkedin,
		instagram,
		status,
		searchprofilecount,
		viewprofilecount,
		area,
		area1,
		area2,
		area3,
		profile_search,
		notice_search,
		mylist_search,
		view_profile,
		add_profile,
		Committee,
		notificationstatus,
		otpcount,
		fcm_id,
		login_device,
		createdby,
		createdon,
		createdip,
		modifiedby,
		modifiedon,
		modifiedip
	FROM pp_profileinfo WHERE id=?");

    $stmtq->bind_param("s", $_REQUEST["id"]);
    $stmtq->execute();
    $result = $stmtq->get_result();

    if ($row = $result->fetch_assoc()) {

        // Rename photo key to editprofilephoto
        $row['editprofilephoto'] = $row['photo'];
        unset($row['photo']);

        $response = $row;

    } else {
        $response = array('error' => 'No record found');
    }

    echo json_encode($response);
    $stmtq->close();
?>
