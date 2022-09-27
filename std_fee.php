<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Fee Pay</title>

</head>
<?php
include "config.php";
if (isset($_POST['submit'])) {
  //std_Fee Table Fields
  $fee_pay_date = $_POST['fee_date'];
  $std_fee = $_POST['fee'];
  $fee_status = 1; 
  $Active = 1;
  $fee_month = $_POST['fee_month'];
  $fee_year = $_POST['fee_year'];
  $s_id = $_GET['stdid'];
  $fee_pay_query = "INSERT INTO `std_fee` ( `s_id`, `s_fee_pay_date`, `s_fee`, `s_fee_status`, `s_fee_month`, `s_fee_year`, `Active`) VALUES ('$s_id','$fee_pay_date','$std_fee','$fee_status','$fee_month','$fee_year','$Active' )";
  $fetch_query = "SELECT * FROM `std` WHERE s_id = ".$s_id;
  if(duplicate($s_id,$fee_month,$conn) == 0){
    $result_fee_pay_query = mysqli_query($conn, $fee_pay_query);
    $result_fetch_query = mysqli_query($conn, $fetch_query);
  $row = mysqli_fetch_assoc($result_fetch_query);
  if (!$result_fee_pay_query || !$result_fetch_query) {
    $_SESSION['fee_pay'] = "Something Went Wrong";
  } else {
    $_SESSION['fee_pay'] = $row['s_name'];
    $_SESSION["flag"] = 0;
    header("location:display.php?fee_status=NULL&s_fee_month=".$fee_month);
  }
}else{
  $_SESSION['fee_pay'] = "Fees Already Pay!";
}
}
?>
<?php
$fetch_query = "SELECT std.*,std_fee.* FROM `std`  INNER JOIN std_fee WHERE std.s_id = " . $_GET['stdid'];
$result = mysqli_query($conn, $fetch_query);
$row = mysqli_fetch_assoc($result);
if ($result && $row["s_id"] < 0) {
  $_SESSION["dflag"] = 1;
}
?>
<body><br><br>
  <div class="container mt-5 mb-5" style="background-color:white;padding:1%">
    <div>
      <div style="text-align: center;margin-bottom:2%">
        <h1>Fee Management</h1>
      </div>
      <?php  
      if($_SESSION['fee_pay'] != null){
      ?>
      <div class="alert alert-warning text-center" id="msg_v">
                  <strong>Warning!</strong> <?php echo $_SESSION['fee_pay'] ?>.
                </div>
          <?php
      }
          ?>
      <form class="needs-validation" method="POST" novalidate>
        <div class="container" style="margin-left:10%">
          <div class="input-group " style="text-align: center">
            <div class="form-group" style="width:40%;">
              <label for="sname">Student Name</label>
              <input disabled value="<?php echo $row["s_name"] ?>" type="text" class="form-control inp" id="sname" placeholder="Enter Student Name" autocomplete="off" name="sname" required>
              <input hidden value="<?php echo $row["s_name"] ?>" type="text" class="form-control inp" id="sname" placeholder="Enter Student Name" autocomplete="off" name="sname" required>
              <div class="invalid-feedback">Student Name is Required.</div>
            </div>
            <div class="form-group inp" style="margin-left:20px;width:40%">
              <label for="fname">Father Name</label>
              <input disabled value="<?php echo $row["f_name"] ?>" type="text" class="form-control inp" id="fname" placeholder="Enter Father Name" autocomplete="off" name="fname" required>
              <input hidden value="<?php echo $row["f_name"] ?>" type="text" class="form-control inp" id="fname" placeholder="Enter Father Name" autocomplete="off" name="fname" required>
              <div class="invalid-feedback">Father Name is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
          </div>
          <div class="input-group " style="text-align: center">
            <div class="form-group" style="width:40%;">
              <label for="contact">Student Contact Number</label>
              <input disabled value="<?php echo $row["s_cntct"] ?>" type="number" class="form-control" id="contact" placeholder="Enter Student Contact Number" autocomplete="off" name="contact" required>
              <div class="invalid-feedback">Student Contact is Required.</div>
            </div>
            <div class="form-group" style="margin-left:20px;width:40%">
              <label for="fee">Student Fee's</label>
              <input value="" type="number" class="form-control" id="fee" placeholder="Enter Student Fee's" autocomplete="off" name="fee" required>
              <div class="invalid-feedback">Student Fee's is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>ٖ
          </div>
          <div class="input-group" style="text-align: center">
            <div class="form-group" style="width:82%;">
              <label for="address">Address</label>
              <input disabled value="<?php echo $row["s_address"] ?>" type="text" class="form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
              <div class="invalid-feedback">Address is Required.</div>
            </div>
            <div class="form-group" style="width:82%;">
              <label for="fee_date">Fees Date</label>
              <input class="form-control" value="" id="fee_date" name="fee_date" type="Date" required>
              <div class="invalid-feedback">Fee Date is Required.</div>
            </div>
            <div class="form-group" style="width:40%">
              <label for="gender">Gender</label>
              <select disabled name="gender" id="gender" class="custom-select form-control" required>
                <option selected><?php echo $row["s_gender"] ?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="invalid-feedback">Gender is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
            <div class="form-group" style="width:40%">
              <label for="courses">Courses</label>
              <select disabled name="courses" id="courses" class="custom-select form-control" required>
                <option selected><?php echo $row["s_courses"] ?></option>
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
              <select  name="fee_year" id="fee_year" class="custom-select form-control" required>
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
              <select disabled id="class" name="class" id="class" class="custom-select form-control" required>
                <option selected><?php echo $row["s_class"] ?></option>
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
                <select disabled name="religion" id="religion" class="custom-select form-control" required>
                  <option selected><?php echo $row["s_religion"] ?></option>
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
                <select disabled name="city" id="city" class="custom-select form-control" required>
                  <option selected><?php echo $row["s_city"] ?></option>
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
            <div class="row container">
              <button type="submit" name="submit" class="btn btn-outline-danger btn" style="width:40%">Fee Pay</button>
              <a class="btn btn-outline-primary btn-default btn-block" href="./display.php?fee_status=NULL&s_fee_month=August" style="margin-left:2%;width:40%">Cancel Pay</a>
            </div>
          </center>
      </form>
    </div>
  </div>
  <script>
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
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>
</html>