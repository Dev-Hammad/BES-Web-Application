<!DOCTYPE html>
<html lang="en">
<?php
include "config.php";
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Confirm Delete</title>

</head>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['sname'];
  $name = trim($name);

  $fname = $_POST['fname'];
  $fname = trim($fname);

  $Active = 1;
  $delete_query_std = "UPDATE `std` SET `Active` = '$Active' WHERE `s_id` =" . $_GET['Recycleid'];
  $delete_query_std_fee = "UPDATE `std_fee` SET `Active` = '$Active' WHERE `s_id` =" . $_GET['Recycleid'];  
  $result_std = mysqli_query($conn, $delete_query_std);
  $result_std_fee = mysqli_query($conn, $delete_query_std_fee);
  if (!$result_std || !$result_std_fee) {
    $_SESSION["recycle"] = "Something Went Wrong";
  } else {
    $_SESSION["recycle"] = $name . " " . $fname;
    header('location:display.php');
    $_SESSION["recycle_record"] = $_GET['Recycleid'];
  }
}
?>
<?php
 $fetch_query = "SELECT *
 FROM std T1, std_fee T2
 WHERE T1.s_id = ".$_GET['Recycleid'];
$result = mysqli_query($conn, $fetch_query);
if ($result) {
  $_SESSION["dflag"] = 0;
}
$row = mysqli_fetch_assoc($result);
?>
<body><br><br>
  <div class="container mt-5 mb-5" style="background-color:white;padding:1%">
    <div>
      <div style="text-align: center;margin-bottom:2%">
        <h1 class="text-danger">Are You Sure Want to Recycle <?php echo $row["s_name"] . " ";
                                                              echo $row["f_name"] ?></h1>
      </div>
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
              <input disabled value="<?php echo $row["s_fee"] ?>" type="number" class="form-control" id="fee" placeholder="Enter Student Fee's" autocomplete="off" name="fee" required>
              <div class="invalid-feedback">Student Fee's is Required.</div>
            </div>
            <div class="form-group form-check">
            </div>
          </div>

          <div class="input-group" style="text-align: center">
            <div class="form-group" style="width:82%;">
              <label for="address">Address</label>
              <input disabled value="<?php echo $row["s_address"] ?>" type="text" class="form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
              <div class="invalid-feedback">Address is Required.</div>
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

              <button type="submit" name="submit" class="btn btn-outline-danger btn" style="width:40%">Recycle Record</button>
              <!-- <a href="" class="btn btn-outline-primary btn-default btn-block">Update</a> -->
              <a class="btn btn-outline-primary btn-default btn-block" href="./recycle.php" style="margin-left:2%;width:40%">Cancel Recycle</a>

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