<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Family Member</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #D81C5B;
    --secondary: #269CD8;
    --success: #4BB649;
    --warning: #F6911D;
    --bg: #F5F5F5;
    --surface: #FFFFFF;
    --text: #1E1E1E;
    --subtext: #6E6E6E;
    --divider: #E0E0E0;
}

body {
    background: var(--bg);
    font-family: 'Inter', sans-serif;
    color: var(--text);
}

.page-container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 16px;
}

.section-card {
    background: var(--surface);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 28px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    border-left: 4px solid var(--primary);
}

.section-title {
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 20px;
}

.form-control,
.form-select {
    border-radius: 12px;
    height: 50px;
    border: 1px solid var(--divider);
    transition: all 0.2s ease;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(216,28,91,0.08);
}

textarea.form-control {
    height: auto;
}

.form-label {
    font-size: 14px;
    font-weight: 500;
    color: var(--subtext);
}

.btn-primary {
    background-color: var(--primary);
    border: none;
    border-radius: 14px;
    height: 56px;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.btn-primary:hover {
    background-color: #c21850;
}

.profile-upload {
    text-align: center;
    margin-bottom: 24px;
}

.profile-upload img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid var(--divider);
    margin-bottom: 12px;
}

input[type="radio"],
input[type="checkbox"] {
    accent-color: var(--primary);
}

.invalid-feedback {
    display: block;
}

.submit-container {
    margin-bottom: 60px;
}
</style>
</head>

<body>

<div class="page-container">

<div class="text-center mb-4">
<h3 style="font-weight:600;">Add Family Member</h3>
<p style="color: var(--subtext); font-size:14px;">Please fill in the details carefully</p>
</div>

<form id="memberForm" method="post" enctype="multipart/form-data">

<div class="section-card profile-upload">
<img id="previewImage" src="https://via.placeholder.com/120" alt="Profile">
<input type="file" id="photo" name="photo" class="form-control mt-2" accept="image/*">
</div>

<div class="section-card">
<div class="section-title">Personal Information</div>
<div class="row g-3">
<div class="col-md-6">
<label class="form-label">First Name</label>
<input type="text" name="firstname" id="firstname" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Middle Name</label>
<input type="text" name="middlename" id="middlename" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Last Name</label>
<input type="text" name="lastname" id="lastname" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Grandfather Name</label>
<input type="text" name="grandfathername" id="grandfathername" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Gender</label>
<select name="gender" id="gender" class="form-select" required>
<option value="">Select</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Date of Birth</label>
<input type="date" name="dateofbirth" id="dateofbirth" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Marital Status</label>
<select name="maritialstatus" id="maritialstatus" class="form-select" required>
<option value="">Select</option>
<option value="Single">Single</option>
<option value="Married">Married</option>
</select>
</div>
<div class="col-md-6">
<label class="form-label">Blood Group</label>
<select name="bloodgroup" id="bloodgroup" class="form-select" required>
<option value="">Select</option>
<option>A+</option>
<option>B+</option>
<option>O+</option>
<option>AB+</option>
</select>
</div>
</div>
</div>

<div class="section-card">
<div class="section-title">Contact Information</div>
<div class="row g-3">
<div class="col-md-6">
<label class="form-label">Mobile Number</label>
<input type="text" name="mobileno" id="mobileno" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Alternate Mobile</label>
<input type="text" name="alternativemobileno" id="alternativemobileno" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Email</label>
<input type="email" name="emailid" id="emailid" class="form-control">
</div>
</div>
</div>

<div class="section-card">
<div class="section-title">Residential Address</div>
<div class="row g-3">
<div class="col-12">
<label class="form-label">Address</label>
<textarea name="residentaladdress" id="residentaladdress" class="form-control" required></textarea>
</div>
<div class="col-md-6">
<label class="form-label">Suburb</label>
<input type="text" name="residentalsuburb" id="residentalsuburb" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Pincode</label>
<input type="text" name="residentalpincode" id="residentalpincode" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">City</label>
<input type="text" name="residentalcity" id="residentalcity" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">State</label>
<input type="text" name="residentalstate" id="residentalstate" class="form-control" required>
</div>
<div class="col-md-6">
<label class="form-label">Country</label>
<input type="text" name="residentalcountry" id="residentalcountry" class="form-control" required>
</div>
</div>
</div>

<div class="section-card">
<div class="section-title">Work Information</div>
<div class="row g-3">
<div class="col-md-6">
<label class="form-label">Nature of Work</label>
<input type="text" name="natureofwork" id="natureofwork" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Company Name</label>
<input type="text" name="nameofcompany" id="nameofcompany" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Business Type</label>
<input type="text" name="typeofbusiness" id="typeofbusiness" class="form-control">
</div>
</div>
</div>

<div class="section-card">
<div class="section-title">Social Media</div>
<div class="row g-3">
<div class="col-md-6">
<label class="form-label">Facebook</label>
<input type="text" name="facebook" id="facebook" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Instagram</label>
<input type="text" name="instagram" id="instagram" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">LinkedIn</label>
<input type="text" name="linkedin" id="linkedin" class="form-control">
</div>
<div class="col-md-6">
<label class="form-label">Twitter</label>
<input type="text" name="twitter" id="twitter" class="form-control">
</div>
</div>
</div>

<div class="submit-container text-center">
<button type="submit" id="btnSubmit" class="btn btn-primary w-100">Submit Member Details</button>
</div>

</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('photo').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('previewImage').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});
</script>

</body>
</html>
