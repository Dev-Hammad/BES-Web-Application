<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Student Registration</title>
</head>
<?php
include "config.php";
if (isset($_POST['submit'])) {
  //Table std Fields
  $name = $_POST['sname'];
  $name = trim($name);
  $fname = $_POST['fname'];
  $fname = trim($fname);
  $cntct = $_POST['contact'];
  $address = $_POST['address'];
  $address = trim($address);
  $gender = $_POST['gender'];
  $courses = $_POST['courses'];
  $courses = trim($courses);
  $class = $_POST['class'];
  $class = trim($class);
  $religion = $_POST['religion'];
  $city = $_POST['city'];
  //std_Fee Table Fields
  $fee_pay_date = $_POST['fee_date'];
  $std_fee = $_POST['fee'];
  $fee_status = $_POST["fee_status"];
  $fee_month = $_POST['fee_month'];
  $fee_year = $_POST['fee_year'];
  $advance_fees = $_POST['advance_fees'];
  if ($class != "No-Selection"  || $courses != "No-Selection") {
    $_SESSION["insert_record"] = $s_id;
    $doa =  date("d") . "-" . date("M") . "-" . date("o");
    $dou = "No - Update";
    $Active = 1;
    $insert_query_std = "INSERT INTO `std` (`s_id`, `s_name`, `f_name`, `s_cntct`, `s_address`, `s_gender`, `s_religion`, `s_city`, `s_class`, `s_courses`, `s_doa`, `s_dou`, `Active`) 
    VALUES (NULL, '$name', '$fname', '$cntct', '$address', '$gender', '$religion', '$city', '$class', '$courses', '$doa', '$dou', '$Active')";
    $result_std = mysqli_query($conn, $insert_query_std);
    if ($result_std) {
      $s_id = mysqli_insert_id($conn);
    }
    $_SESSION["dflag"] = 0;
    $insert_query_std_fee = "INSERT INTO `std_fee`(`std_adv_fees`,`id`, `s_id`, `s_fee_pay_date`, `s_fee`, `s_fee_status`, `s_fee_month`, `s_fee_year`, `Active`) 
    VALUES ('$advance_fees',Null,'$s_id','$fee_pay_date','$std_fee','$fee_status','$fee_month','$fee_year','$Active')";
    $result_std_fee = mysqli_query($conn, $insert_query_std_fee);
    if (!$result_std || !$result_std_fee) {
      $_SESSION["insert"] = "Something Went Wrong";
    } else {
      $_SESSION["insert"] = $name . " " . $fname;
      header("location:display.php");
    }
  } else {
    header("location:Index.php");
    $_SESSION["insert"] = "It is Neccessary To Select atleast (1) Option From Class or Courses";
  }
}
?>
<body>
  <br><br>
  <div class="container mt-5 mb-5" style="background-color:white;padding:1%">
    <div>
      <div style="text-align: center;margin-bottom:2%">
        <h1> Student Registration</h1>
      </div>
      <form class="needs-validation" method="POST" novalidate>
        <div class="container" style="margin-left:10%">
          <div class="input-group " style="text-align: center">
            <div class="form-group" style="width:40%;">
              <label for="sname">Student Name</label>
              <input value="" type="text" class="form-control inp" id="sname" placeholder="Enter Student Name" autocomplete="off" name="sname" required>
              <div class="invalid-feedback">Student Name is Required.</div>
            </div>
            <div class="form-group inp" style="margin-left:20px;width:40%">
              <label for="fname">Father Name</label>
              <input value="" type="text" class="form-control inp" id="fname" placeholder="Enter Father Name" autocomplete="off" name="fname" required>
              <div class="invalid-feedback">Father Name is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
          </div>
          <div class="input-group " style="text-align: center">
            <div class="form-group" style="width:40%;">
              <label for="contact">Student Contact Number</label>
              <input value="" type="number" class="form-control" id="contact" placeholder="Enter Student Contact Number" autocomplete="off" name="contact" required>
              <div class="invalid-feedback">Student Contact is Required.</div>
            </div>
            <div class="form-group" style="margin-left:20px;width:40%">
              <label for="fee">Student Fee's</label>
              <input value="" type="number" class="form-control" id="fee" placeholder="Enter Advance Fees + Monthly Fees" autocomplete="off" name="fee" required>
              <div class="invalid-feedback">Student Fee's is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>ٖ
          </div>
          <div class="input-group" style="text-align: center">
            <div class="form-group" style="width:82%;">
              <label for="advance_fees">Advance Fees</label>
              <input value="" type="number" class="form-control inp" id="advance_fees" placeholder="Enter Student Advance Fees" autocomplete="off" name="advance_fees" required>
              <div class="invalid-feedback">Advance Fees is Required.</div>
            </div>
</div>
          <div class="input-group" style="text-align: center">
            <div class="form-group" style="width:82%;">
              <label for="address">Address</label>
              <input value="" type="text" class="form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
              <div class="invalid-feedback">Address is Required.</div>
            </div>
            <div class="form-group" style="width:82%;">
              <label for="fee_date">Fees Date</label>
              <input class="form-control" value="" id="fee_date" name="fee_date" type="Date" required>
              <div class="invalid-feedback">Fee Date is Required.</div>
            </div>
            <div class="form-group" style="width:82%;">
              <label for="fee_status">Fees Status</label>
              <select name="fee_status" class="custom-select form-control" id="fee_status" required>
              <option value="" selected>Select Fees Status</option>
                <option value="1">Paid</option>
                <option value="0">Not-Paid</option>
              </select>
              <div class="invalid-feedback">Fees Status is Required.</div>
            </div>
            <div class="form-group" style="width:40%">
              <label for="gender">Gender</label>
              <select name="gender" id="gender" class="custom-select form-control" required>
                <option value="" selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="invalid-feedback">Gender is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
            <div class="form-group" style="width:40%">
              <label for="courses">Courses</label>
              <select name="courses" id="courses" class="custom-select form-control" required>
                <option value="" selected>Select Courses</option>
                <option value="CIT">CIT</option>
                <option value="ACIT">ACIT</option>
                <option value="DIT">DIT</option>
                <option value="DCBM">DCBM</option>
                <option value="Web Development">Web Development</option>
                <option value="C Programming">C Programming</option>
                <option value="C++ Programming">C++ Programming</option>
                <option value="C Sharp Programming">C Sharp Programming</option>
                <option value="Java Programming">Java Programming</option>
                <option value="JavaScript Programming">JavaScript Programming</option>
                <option value="ASP.net MVC Programming">ASP.net MVC Programming</option>
                <option value="Basic English Language">Basic English Language</option>
                <option value="Advance English Language">Advance English Language</option>
                <option value="No-Selection">No-Selection</option>
              </select>
              <div class="invalid-feedback">Course is Required.</div>
              <div class="form-group form-check">
              </div>
            </div>
          </div>
          <div class="input-group" style="text-align: center">
            <div class="form-group" style="width:40%;">
              <label for="fee_month">Fees Month</label>
              <select name="fee_month" id="fee_month" class="custom-select form-control" required>
                <option value="">Select Fee Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select>
              <div class="invalid-feedback">Fee Month is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
            <div class="form-group" style="width:40%">
              <label for="fee_year">Fee Year</label>
              <select name="fee_year" id="fee_year" class="custom-select form-control" required>
                <option selected value="">Select Year</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
              </select>
              <div class="invalid-feedback">Fee Year is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
          </div>
          <div class="input-group " style="text-align: center">
            <div class="form-group" style="width:82%">
              <label for="class">Class</label>
              <select id="class" name="class" id="class" class="custom-select form-control" required>
                <option value="" selected>Select Class</option>
                <option value="IX (Computer Science)">IX (Computer Science)</option>
                <option value="IX (Biology)">IX (Biology)</option>
                <option value="IX (Computer Science)">X (Computer Science)</option>
                <option value="IX (Biology)">X (Biology)</option>
                <option value="IX (Computer Science)">XI (Computer Science)</option>
                <option value="IX (Biology)">XI (Biology)</option>
                <option value="IX (Biology)">XI (Pre-Enginieering)</option>
                <option value="IX (Computer Science)">XII (Computer Science)</option>
                <option value="IX (Biology)">XII (Biology)</option>
                <option value="IX (Biology)">XII (Pre-Enginieering)</option>
                <option value="Middle">Middle</option>
                <option value="No-Selection">No-Selection</option>
              </select>
              <div class="invalid-feedback">Class is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
            <div class="input-group" style="text-align: center">
              <div class="form-group" style="width:40%;">
                <label for="religion">Religion</label>
                <select name="religion" id="religion" class="custom-select form-control" required>
                  <option value="" selected>Select Religion</option>
                  <option value="Islam">Islam</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Cristian">Cristian</option>
                  <option value="Sikh">Sikh</option>
                </select>
                <div class="invalid-feedback">Religion is Required.</div>
              </div>
              <div class="form-group form-check">
              </div>
              <div class="form-group" style="width:40%">
                <label for="city">City</label>
                <select name="city" id="city" class="custom-select form-control" required>
                  <option value="" selected>Select City</option>
                  <option value="Hyderabad">Hyderabad</option>
                  <option value="Karachi">Karachi</option>
                  <option value="Peshawar">Peshawar</option>
                  <option value="Balochistan">Balochistan</option>
                  <option value="Khyber-PakhtunKhwa">Khyber-Pakhtunkhwa</option>
                  <option value="Lahore">Lahore</option>
                </select>
                <div class="invalid-feedback">City is Required.</div>
              </div>
              <div class="form-group form-check">
              </div>
            </div>
          </div>
          <center>
            <button type="submit" id="btn" name="submit" onclick="trim()" class="btn btn-outline-primary btn" style="width:60%;margin-right:19%;margin-top:2%;">Register</button>
          </center>
      </form>
    </div>
  </div>
  <script>
    var courses = $("#courses");
    var Class = $("#class");
    $('#msg_v').hide();
    function trim() {
      document.getElementsByClassName("inp")[0].value.trim();
      document.getElementsByClassName("inp")[2].value.trim();
      document.getElementsByClassName("inp")[3].value.trim();
    }
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            // if (courses.val() == Class.val()) {

            // }
            if (form.checkValidity() === false || courses.val() == Class.val()) {
              event.preventDefault();
              event.stopPropagation();
              $('#msg_v').show();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>
</html>
<script>
  $(document).ready(function() {
    var a = $("#sname");
    a.val() = "hello";
    $("#btn").on("click", function() {
      var name = $("#sname");
      var fname = $("#fname");
      var contact = $("#contact");
      var address = $("#address");
      var gender = $("#gender");
      var courses = $("#courses");
      var Class = $("#class");
      var religion = $("#religion");
      var city = $("#city");
      var tname = $("#sname");
      var tfname = $("#fname");
      var tcontact = $("#contact");
      var taddress = $("#address");
      var tgender = $("#gender");
      var tcourses = $("#courses");
      var tClass = $("#class");
      var treligion = $("#religion");
      var tcity = $("#city");
      name.val() = "hello";
    });
  });
</script>