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
  <title>Student Registration</title>

</head>
<?php
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
  $std_fee = $_POST['s_fee'];
  $fee_status = $_POST["fee_status"];
  $fee_month = $_POST['fee_month'];
  $fee_year = $_POST['fee_year'];
  $advance_fees = $_POST['advance_fees'];
  $Active = 1;
  $Get_Data = $_GET["updateid"];
  $dou =  date("d") . "-" . date("M") . "-" . date("o");
  if ($class != "No-Selection"  || $courses != "No-Selection") {
    $Update_std = "UPDATE `std` SET `s_name`='$name',`f_name`='$fname',`s_cntct`='$cntct',`s_address`='$address',`s_gender`='$gender',`s_religion`='$religion',`s_city`='$city',`s_class`='$class',`s_courses`='$courses',`s_dou`='$dou',`Active`='$Active' WHERE s_id = $Get_Data";
    $Update_std_fee = "UPDATE `std_fee` SET  `std_adv_fees`='$advance_fees',`s_fee_pay_date`='$fee_pay_date',`s_fee`='$std_fee',`s_fee_status`='$fee_status',`s_fee_month`='$fee_month',`s_fee_year`='$fee_year',`Active`='$Active' WHERE s_id = $Get_Data AND s_fee_month = '$fee_month' ";
    $result_std = mysqli_query($conn, $Update_std);
    $result_std_fee = mysqli_query($conn, $Update_std_fee);
    if (!$result_std || !$result_std_fee) {
      $_SESSION["Update"] = "Something Went Wrong";
    } else {
      $_SESSION["Update"] = $name;
      $get_month = $_GET['fee_month'];
      header("location:display.php?fee_status=NULL&s_fee_month=$get_month");
    }
  } else {
    header("location:update.php?updateid=" . $_GET['updateid']);
    $_SESSION["warn"] = "It is Neccessary To Select atleast (1) Option From Class or Courses";
  }
}
?>

<body><br><br>
  <div class="container mt-5 mb-5" style="background-color:white;padding:1%">
    <div>
      <div style="text-align: center;margin-bottom:2%">
        <h1>Update Student Record</h1>
        <?php
        $get = $_GET['updateid'];
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
                      <input hidden value="<?php echo $row["s_id"] ?>" type="text" class="form-control inp" id="s_id" placeholder="Enter Student Name" autocomplete="off" name="s_id" required>
                      <input value="<?php echo $row["s_name"] ?>" type="text" class="form-control inp" id="sname" placeholder="Enter Student Name" autocomplete="off" name="sname" required>
                      <div class="invalid-feedback">Student Name is Required.</div>
                    </div>
                    <div class="form-group inp" style="margin-left:20px;width:40%">
                      <label for="fname">Father Name</label>
                      <input value="<?php echo $row["f_name"] ?>" type="text" class="form-control inp" id="fname" placeholder="Enter Father Name" autocomplete="off" name="fname" required>
                      <div class="invalid-feedback">Father Name is Required.</div>
                    </div>
                    <div class="form-group form-check">
                    </div>
                  </div>
                  <div class="input-group " style="text-align: center">
                    <div class="form-group" style="width:40%;">
                      <label for="contact">Student Contact Number</label>
                      <input value="<?php echo $row["s_cntct"] ?>" type="number" class="form-control" id="contact" placeholder="Enter Student Contact Number" autocomplete="off" name="contact" required>
                      <div class="invalid-feedback">Student Contact is Required.</div>
                    </div>
                    <div class="form-group inp" style="margin-left:20px;width:40%">
                      <label for="s_fee">Student Fee's</label>
                      <input value="<?php echo $row["s_fee"] ?>" type="number" class="form-control inp" id="s_fee" placeholder="Enter Father Name" autocomplete="off" name="s_fee" required>
                      <div class="invalid-feedback">Student Fees is Required.</div>
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <div class="form-group" style="width:82%;">
              <label for="advance_fees">Advance Fees</label>
              <input value="<?php echo $row["std_adv_fees"] ?>" type="number" class="form-control inp" id="advance_fees" placeholder="Enter Student Advance Fees" autocomplete="off" name="advance_fees" required>
              <div class="invalid-feedback">Advance Fees is Required.</div>
            </div>
                  </div>
                  <div class="input-group" style="text-align: center">
                    <div class="form-group" style="width:82%;">
                      <label for="address">Address</label>
                      <input value="<?php echo $row["s_address"] ?>" type="text" class="form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="address" required>
                      <div class="invalid-feedback">Address is Required.</div>
                    </div>
                    <div class="form-group" style="width:82%;">
                      <label for="fee_date">Fees Date</label>
                      <input value="<?php echo $row["s_fee_pay_date"] ?>" type="date" class="form-control inp" id="address" placeholder="Enter Student Address" autocomplete="off" name="fee_date" required>
                      <div class="invalid-feedback">Fees Date is Required.</div>
                    </div>
                    <div class="form-group" style="width:82%;">
                      <label for="address">Fee Status</label>
                      <?php
                      if ($row["s_fee_status"] == 1) {
                        $row["s_fee_status"] = "Paid"
                      ?>
                        <select name="fee_status" class="form-control text-white  bg-success custom-select form-control" id="fee_status" required="">
                          <option value="1" selected=""><?php echo $row["s_fee_status"] . " (" . $row["s_fee_month"] . ")" ?></option>
                          <option value="1">Paid</option>
                          <option value="0">Not-Paid</option>
                        </select>
                      <?php
                      } else {
                        $row["s_fee_status"] = "Not-Paid"
                      ?>
                        <select name="fee_status" class="bg-danger text-white form-control  custom-select " id="fee_status" required="">
                          <option value="0" selected=""><?php echo $row["s_fee_status"] . " (" . $row["s_fee_month"] . ")" ?></option>
                          <option value="1">Paid</option>
                          <option value="0">Not-Paid</option>
                        </select>
                      <?php
                      } ?>
                      <div class="invalid-feedback">Fees Status is Required.</div>
                    </div>
                    <div class="form-group" style="width:40%">
                      <label for="gender">Gender</label>
                      <?php
                      for ($i = 1; $i <= 1; $i++) {
                      ?>
                        <select name="gender" id="gender" class="custom-select form-control" required>
                          <option selected id="<?php echo "g" . $i ?>"><?php echo $row["s_gender"] ?></option>
                          <option value="Male" id="<?php echo "g" . ++$i ?>">Male</option>
                          <option value="Female" id="<?php echo "g" . ++$i ?>">Female</option>
                        <?php
                      }
                        ?>
                        </select>
                        <div class="invalid-feedback">Gender is Required.</div>
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <div class="form-group" style="width:40%">
                      <label for="courses">Courses</label>
                      <select name="courses" id="courses" class="custom-select form-control" required>
                        <?php
                        for ($i = 1; $i <= 1; $i++) {
                        ?>
                          <option id="<?php echo "c" . $i ?>" selected><?php echo $row["s_courses"] ?></option>
                          <option id="<?php echo "c" . ++$i ?>" value="CIT">CIT</option>
                          <option id="<?php echo "c" . ++$i ?>" value="ACIT">ACIT</option>
                          <option id="<?php echo "c" . ++$i ?>" value="DIT">DIT</option>
                          <option id="<?php echo "c" . ++$i ?>" value="DCBM">DCBM</option>
                          <option id="<?php echo "c" . ++$i ?>" value="Web Development">Web Development</option>
                          <option id="<?php echo "c" . ++$i ?>" value="C Programming">C Programming</option>
                          <option id="<?php echo "c" . ++$i ?>" value="C++ Programming">C++ Programming</option>
                          <option id="<?php echo "c" . ++$i ?>" value="C Sharp Programming">C Sharp Programming</option>
                          <option id="<?php echo "c" . ++$i ?>" value="Java Programming">Java Programming</option>
                          <option id="<?php echo "c" . ++$i ?>" value="JavaScript Programming">JavaScript Programming</option>
                          <option id="<?php echo "c" . ++$i ?>" value="ASP.net MVC Programming">ASP.net MVC Programming</option>
                          <option id="<?php echo "c" . ++$i ?>" value="Basic English Language">Basic English Language</option>
                          <option id="<?php echo "c" . ++$i ?>" value="Advance English Language">Advance English Language</option>
                          <option id="<?php echo "c" . ++$i ?>" value="No-Selection">No-Selection</option>
                        <?php
                        }
                        ?>
                      </select>
                      <div class="invalid-feedback">Course is Required.</div>
                      <div class="form-group form-check">
                      </div>
                    </div>
                    <div class="input-group" style="text-align: center">
                      <div class="form-group" style="width:40%;">
                        <label for="fee_month">Fees Month</label>
                        <select name="fee_month" id="fee_month" class="custom-select form-control" required="">
                          <option value="<?php echo $row["s_fee_month"] ?>"><?php echo $row["s_fee_month"] ?></option>
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
                        <select name="fee_year" id="fee_year" class="custom-select form-control" required="">
                          <option selected="" value="<?php echo $row["s_fee_year"] ?>"><?php echo $row["s_fee_year"] ?></option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                        </select>
                        <div class="invalid-feedback">Fee Year is Required.</div>
                      </div>
                      <div class="form-group form-check">
                      </div>
                    </div>
                  </div>
                  <div class="input-group " style="text-align: center">
                    <div class="form-group" style="width:82%">
                      <label for="class">Class</label>
                      <script>
                        $(document).ready(function() {
                          function Remove_Repeat(total_fields, id) {
                            for (let i = 1; i <= total_fields; i++) {
                              $("#" + id + i).val() == $("#" + id + (i + 1)).val() && $("#" + id + i).hide();
                              console.log(id + total_fields)
                              break;
                            }
                          }
                          Remove_Repeat(5, "r");
                          Remove_Repeat(7, "_c");
                          Remove_Repeat(13, "C");
                        });
                      </script>
                      <select id="class" name="class" id="class" class="custom-select form-control" required>
                        <?php
                        for ($i = 1; $i <= 1; $i++) {
                        ?>
                          <option id="<?php echo "C" . $i ?>" hidden selected><?php echo $row["s_class"] ?></option>
                          <option id="<?php echo "C" . ++$i ?>" value="IX (Computer Science)">IX (Computer Science)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="IX (Biology)">IX (Biology)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="X (Computer Science)">X (Computer Science)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="X (Biology)">X (Biology)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="XI (Computer Science)">XI (Computer Science)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="XI (Biology)">XI (Biology)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="XI (Pre-Enginieering)">XI (Pre-Enginieering)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="XII (Computer Science)">XII (Computer Science)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="XII (Biology)">XII (Biology)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="XII (Pre-Enginieering)">XII (Pre-Enginieering)</option>
                          <option id="<?php echo "C" . ++$i ?>" value="Middle">Middle</option>
                          <option id="<?php echo "C" . ++$i ?>" value="No-Selection">No-Selection</option>
                        <?php } ?>
                      </select>
                      <div class="invalid-feedback">Class is Required.</div>
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <div class="input-group" style="text-align: center">
                      <div class="form-group" style="width:40%;">
                        <label for="religion">Religion</label>
                        <select name="religion" id="religion" class="custom-select form-control" required>
                          <?php
                          for ($i = 1; $i <= 4; $i++) {
                          ?>
                            <option id="<?php echo "r" . $i ?>" selected><?php echo $row["s_religion"] ?></option>
                            <option id="<?php echo "r" . ++$i ?>" value="Islam">Islam</option>
                            <option id="<?php echo "r" . ++$i ?>" value=" Hindu">Hindu</option>
                            <option id="<?php echo "r" . ++$i ?>" value="Cristian">Cristian</option>
                            <option id="<?php echo "r" . ++$i ?>" value=" Sikh">Sikh</option>
                          <?php
                          }
                          ?>
                        </select>
                        <div class="invalid-feedback">Religion is Required.</div>
                      </div>
                      <div class="form-group form-check">
                      </div>
                      <div class="form-group" style="width:40%">
                        <label for="city">City</label>
                        <select name="city" id="city" class="custom-select form-control" required>
                          <?php
                          for ($i = 1; $i <= 1; $i++) {
                          ?>
                            <option id="<?php echo "_c" . $i ?>" selected><?php echo $row["s_city"] ?></option>
                            <option id="<?php echo "_c" . ++$i ?>" value="Hyderabad">Hyderabad</option>
                            <option id="<?php echo "_c" . ++$i ?>" value="Karachi">Karachi</option>
                            <option id="<?php echo "_c" . ++$i ?>" value="Peshawar">Peshawar</option>
                            <option id="<?php echo "_c" . ++$i ?>" value="Balochistan">Balochistan</option>
                            <option id="<?php echo "_c" . ++$i ?>" value="Khyber-PakhtunKhwa">Khyber-Pakhtunkhwa</option>
                            <option id="<?php echo "_c" . ++$i ?>" value="Lahore">Lahore</option>
                          <?php
                          } ?>
                        </select>
                        <div class="invalid-feedback">City is Required.</div>
                      </div>
                      <div class="form-group form-check">
                      </div>
                    </div>
                  </div>
                  <center>
                    <div class="row container">
                      <button type="submit" name="submit" onclick="trim()" class="btn btn-outline-success btn" style="width:40%">Update Record</button>
                      <a class="btn btn-outline-primary btn-default btn-block" href="./display.php?fee_status=NULL&s_fee_month=August" style="margin-left:2%;width:40%">Cancel Delete</a>
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
              $(document).ready(function() {
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
                )
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