<?php
include "config.php";

?>
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Student Details</title>
<style>
  .btn{
    width:40%;margin-right: 100px;
  }
</style>
</head>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['sname'];
  $name = trim($name);

  $fname = $_POST['fname'];
  $fname = trim($fname);


  $cntct = $_POST['contact'];

  $fee = $_POST['fee'];


  $address = $_POST['address'];
  $address = trim($address);

  $courses = $_POST['courses'];
  $courses = trim($courses);


  $class = $_POST['class'];
  $class = trim($class);



  $gender = $_POST['gender'];




  $religion = $_POST['religion'];

  $city = $_POST['city'];

  $s_id = $_POST["s_id"];
  if ($class != "No-Selection"  || $courses != "No-Selection") {
    $date =  date("d") . "-" . date("M") . "-" . date("o");
    $Active = 1;
    $_SESSION["s_id"] = $s_id;
    $Update_query = "UPDATE `std` SET `s_u_date`='$date',`s_courses`='$courses',`s_name`='$name',`f_name`='$fname',`s_cntct`='$cntct',`s_fee`='$fee',`s_address`='$address',`s_class`='$class',`s_gender`='$gender',`s_religion`='$religion',`s_city`='$city'  WHERE `s_id` =" . $_GET['Dataid'];
    $result = mysqli_query($conn, $Update_query);
    if (!$result) {
      $_SESSION["insert"] = "Something Went Wrong";
    } else {
      $_SESSION["Update"] = $name . " " . $fname;
      header("location:display.php");
    }
  } else {
    header("location:update.php?Dataid=" . $_GET['Dataid']);
    $_SESSION["warn"] = "It is Neccessary To Select atleast (1) Option From Class or Courses";
  }
}
?>
<body><br><br>
  <div class="container mt-5 mb-5" >
    <div> 
    <div style="text-align: center;margin-bottom:2%;">
    <img src="./BRILLIANCELOGO.png" alt="" height="20%">
        <h1>Student Details</h1>
        <?php
        $get = $_GET['Dataid'];
        $get_month =  $_GET['fee_month'];
        $fetch_query = "SELECT *
        FROM std T1, std_fee T2
        WHERE T1.s_id = $get AND T2.s_id = $get AND T2.s_fee_month = '$get_month'";
        $result = mysqli_query($conn, $fetch_query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <?php

        if ($_SESSION["warn"] != null) {
        ?>
          <div class="container" style="background-color:white;padding:1%">
            <div>
              <div style="text-align: center;margin-bottom:2%">
                <div class="alert alert-warning">
                  <strong>Warning!</strong> <?php echo $_SESSION["warn"] ?>.
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
                      <input disabled value="<?php echo $row["s_fee"] ?>" type="number" class="form-control" id="fee" placeholder="Enter Student Fee's" autocomplete="off" name="fee" required>
                      <div class="invalid-feedback">Student Fee's is Required.</div>
                    </div>
                    <div class="form-group form-check">
                    </div>
                  </div>
                  <!-- --------------------------------------- -->
                  <div class="input-group" style="text-align: center">
            <div class="form-group" style="width:82%;">
              <label for="advance_fees">Advance Fees</label>
              <input disabled value="<?php echo $row["std_adv_fees"]?>" type="number" class="form-control inp" id="advance_fees" placeholder="Enter Student Advance Fees" autocomplete="off" name="advance_fees" required>
              <div class="invalid-feedback">Advance Fees is Required.</div>
            </div>
                  <!-- --------------------------------------- -->
                  <div class="input-group" style="text-align: center">
                    <div class="form-group" style="width:82%;">
                      <label for="address">Address</label>
                      <input disabled value="<?php echo $row["s_address"] ?>" type="text" class="form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
                      <div class="invalid-feedback">Address is Required.</div>
                    </div>
                    <div class="input-group" style="text-align: center">
                      <div class="form-group" style="width:82%;">
                        <label for="address">Fee Status</label>
                        <?php
                        if ($row["s_fee_status"] == 1) {
                          $row["s_fee_status"] = "Paid"
                        ?>
                          <input disabled value="<?php echo $row["s_fee_status"]." (".$row["s_fee_month"].")" ?>" type="text"  class="form-control text-white  bg-success inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
                        <?php
                        } if ($row["s_fee_status"] == 0) {
                          $row["s_fee_status"] = "Not-Paid"
                        ?>
                          <input disabled value="<?php echo $row["s_fee_status"]." (".$row["s_fee_month"].")" ?>" type="text" class="bg-danger text-white form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
                        <?php
                        } ?>
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

                        <!-- <button type="submit" name="submit" onclick="trim()" class="btn btn-outline-success btn" style="width:40%">Update Record</button> -->
                        <!-- <a href="" class="btn btn-outline-primary btn-default btn-block">Update</a> -->
                        <!-- <a class="btn btn-outline-primary btn-default btn-block" href="./display.php" style="margin-left:2%;width:40%">Cancel Delete</a> -->

                      </div>
                    </center>
              </form>
              </div>
            </div>
            <center> <a class="btn btn-outline-success btn" href="display.php?fee_status=NULL&s_fee_month=August" style="width:40%">Save & Print Record</a>
            </center>
            </body>

</html>
            <script>
              function trim() {
                document.getElementsByClassName("inp")[0].value.trim();
                document.getElementsByClassName("inp")[2].value.trim();
                document.getElementsByClassName("inp")[3].value.trim();
              }
              $(document).ready(function() {
                  $(".btn").click(function() {
                    print();
                  });
                  //for Male
                  var g1 = document.getElementById("g1");
                  var g2 = document.getElementById("g2");
                  var g3 = document.getElementById("g3");
                  if (g1.value == g2.value || g1.value == g3.value) {
                    g1.hidden = "true";

                  } else if (g2.value == g1.value || g2.value == g3.value) {
                    g2.hidden = "true";
                  } else {
                    g3.hidden = "true";
                  }
                  //for courses
                  // for (index = 1; index <= 15; index++) {
                  var c1 = document.getElementById("c1");
                  var c2 = document.getElementById("c2");
                  var c3 = document.getElementById("c3");
                  var c4 = document.getElementById("c4");
                  var c5 = document.getElementById("c5");
                  var c6 = document.getElementById("c6");
                  var c7 = document.getElementById("c7");
                  var c8 = document.getElementById("c8");
                  var c9 = document.getElementById("c9");
                  var c10 = document.getElementById("c10");
                  var c11 = document.getElementById("c11");
                  var c12 = document.getElementById("c12");
                  var c13 = document.getElementById("c13");
                  var c14 = document.getElementById("c14");
                  var c15 = document.getElementById("c15");
                  if (c1.value == c2.value ||
                    c1.value == c3.value ||
                    c1.value == c4.value ||
                    c1.value == c5.value ||
                    c1.value == c6.value ||
                    c1.value == c7.value ||
                    c1.value == c8.value ||
                    c1.value == c9.value ||
                    c1.value == c10.value ||
                    c1.value == c11.value ||
                    c1.value == c12.value ||
                    c1.value == c13.value ||
                    c1.value == c14.value ||
                    c1.value == c15.value) {
                    c1.hidden = "true";
                  } else if (c2.value == c1.value ||
                    c2.value == c3.value ||
                    c2.value == c4.value ||
                    c2.value == c5.value ||
                    c2.value == c6.value ||
                    c2.value == c7.value ||
                    c2.value == c8.value ||
                    c2.value == c9.value ||
                    c2.value == c10.value ||
                    c2.value == c11.value ||
                    c2.value == c12.value ||
                    c2.value == c13.value ||
                    c2.value == c14.value ||
                    c2.value == c15.value) {

                    c2.hidden = "true";
                  } else if (c3.value == c1.value ||
                    c3.value == c2.value ||
                    c3.value == c4.value ||
                    c3.value == c5.value ||
                    c3.value == c6.value ||
                    c3.value == c7.value ||
                    c3.value == c8.value ||
                    c3.value == c9.value ||
                    c3.value == c10.value ||
                    c3.value == c11.value ||
                    c3.value == c12.value ||
                    c3.value == c13.value ||
                    c3.value == c14.value ||
                    c3.value == c15.value) {
                    c3.hidden = "true";
                  } else if (c4.value == c1.value ||
                    c4.value == c2.value ||
                    c4.value == c3.value ||
                    c4.value == c5.value ||
                    c4.value == c6.value ||
                    c4.value == c7.value ||
                    c4.value == c8.value ||
                    c4.value == c9.value ||
                    c4.value == c10.value ||
                    c4.value == c11.value ||
                    c4.value == c12.value ||
                    c4.value == c13.value ||
                    c4.value == c14.value ||
                    c4.value == c15.value) {
                    c4.hidden = "true";
                  } else if (c5.value == c1.value ||
                    c5.value == c2.value ||
                    c5.value == c3.value ||
                    c5.value == c4.value ||
                    c5.value == c6.value ||
                    c5.value == c7.value ||
                    c5.value == c8.value ||
                    c5.value == c9.value ||
                    c5.value == c10.value ||
                    c5.value == c11.value ||
                    c5.value == c12.value ||
                    c5.value == c13.value ||
                    c5.value == c14.value ||
                    c5.value == c15.value) {
                    c5.hidden = "true";
                  } else if (c6.value == c1.value ||
                    c6.value == c2.value ||
                    c6.value == c3.value ||
                    c6.value == c4.value ||
                    c6.value == c5.value ||
                    c6.value == c7.value ||
                    c6.value == c8.value ||
                    c6.value == c9.value ||
                    c6.value == c10.value ||
                    c6.value == c11.value ||
                    c6.value == c12.value ||
                    c6.value == c13.value ||
                    c6.value == c14.value ||
                    c6.value == c15.value) {
                    c6.hidden = "true";
                  } else if (c7.value == c1.value ||
                    c7.value == c2.value ||
                    c7.value == c3.value ||
                    c7.value == c4.value ||
                    c7.value == c5.value ||
                    c7.value == c6.value ||
                    c7.value == c8.value ||
                    c7.value == c9.value ||
                    c7.value == c10.value ||
                    c7.value == c11.value ||
                    c7.value == c12.value ||
                    c7.value == c13.value ||
                    c7.value == c14.value ||
                    c7.value == c15.value) {
                    c7.hidden = "true";
                  } else if (c8.value == c1.value ||
                    c8.value == c2.value ||
                    c8.value == c3.value ||
                    c8.value == c4.value ||
                    c8.value == c5.value ||
                    c8.value == c6.value ||
                    c8.value == c7.value ||
                    c8.value == c9.value ||
                    c8.value == c10.value ||
                    c8.value == c11.value ||
                    c8.value == c12.value ||
                    c8.value == c13.value ||
                    c8.value == c14.value ||
                    c8.value == c15.value) {
                    c8.hidden = "true";
                  } else if (c9.value == c1.value ||
                    c9.value == c2.value ||
                    c9.value == c3.value ||
                    c9.value == c4.value ||
                    c9.value == c5.value ||
                    c9.value == c6.value ||
                    c9.value == c7.value ||
                    c9.value == c8.value ||
                    c9.value == c10.value ||
                    c9.value == c11.value ||
                    c9.value == c12.value ||
                    c9.value == c13.value ||
                    c9.value == c14.value ||
                    c9.value == c15.value) {
                    c9.hidden = "true";
                  } else if (c10.value == c1.value ||
                    c10.value == c2.value ||
                    c10.value == c3.value ||
                    c10.value == c4.value ||
                    c10.value == c5.value ||
                    c10.value == c6.value ||
                    c10.value == c7.value ||
                    c10.value == c8.value ||
                    c10.value == c9.value ||
                    c10.value == c11.value ||
                    c10.value == c12.value ||
                    c10.value == c13.value ||
                    c10.value == c14.value ||
                    c10.value == c15.value) {
                    c10.hidden = "true";
                  } else if (c11.value == c1.value ||
                    c11.value == c2.value ||
                    c11.value == c3.value ||
                    c11.value == c4.value ||
                    c11.value == c5.value ||
                    c11.value == c6.value ||
                    c11.value == c7.value ||
                    c11.value == c8.value ||
                    c11.value == c9.value ||
                    c11.value == c10.value ||
                    c11.value == c12.value ||
                    c11.value == c13.value ||
                    c11.value == c14.value ||
                    c11.value == c15.value) {
                    c11.hidden = "true";
                  } else if (c12.value == c1.value ||
                    c12.value == c2.value ||
                    c12.value == c3.value ||
                    c12.value == c4.value ||
                    c12.value == c5.value ||
                    c12.value == c6.value ||
                    c12.value == c7.value ||
                    c12.value == c8.value ||
                    c12.value == c9.value ||
                    c12.value == c10.value ||
                    c12.value == c11.value ||
                    c12.value == c13.value ||
                    c12.value == c14.value ||
                    c12.value == c15.value) {
                    c12.hidden = "true";
                  } else if (c13.value == c1.value ||
                    c13.value == c2.value ||
                    c13.value == c3.value ||
                    c13.value == c4.value ||
                    c13.value == c5.value ||
                    c13.value == c6.value ||
                    c13.value == c7.value ||
                    c13.value == c8.value ||
                    c13.value == c9.value ||
                    c13.value == c10.value ||
                    c13.value == c11.value ||
                    c13.value == c12.value ||
                    c13.value == c14.value ||
                    c13.value == c15.value) {
                    c13.hidden = "true";
                  } else if (c14.value == c1.value ||
                    c14.value == c2.value ||
                    c14.value == c3.value ||
                    c14.value == c4.value ||
                    c14.value == c5.value ||
                    c14.value == c6.value ||
                    c14.value == c7.value ||
                    c14.value == c8.value ||
                    c14.value == c9.value ||
                    c14.value == c10.value ||
                    c14.value == c11.value ||
                    c14.value == c12.value ||
                    c14.value == c13.value ||
                    c14.value == c15.value) {
                    c14.hidden = "true";
                  } else {
                    c15.hidden = "true";
                  }
                }

              );

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

