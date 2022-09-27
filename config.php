<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "bes_acd";
$conn = mysqli_connect($servername, $username, $password, $db_name);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
 <?php
//Duplication Restriction For Fees
function duplicate($s_id, $month, $conn)
{
  $fetch_query =  "SELECT *
  FROM std T1, std_fee T2
  WHERE T1.s_id = $s_id AND   T2.s_id = $s_id  AND T2.s_fee_month = '$month'
";
  $result = mysqli_query($conn, $fetch_query);
  $row =  mysqli_fetch_assoc($result);
  $_SESSION["test"] = $row['s_fee_month']."Test";
  if ($row['s_name'] != null) {
    return 1;
    $_SESSION["test"] = 1;
  } else {
    $_SESSION["test"] = 0;
    return 0;
  }
}
?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<!--
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> --> -->
   <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>  -->
  <script src="./js/jquery.slim.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <style>
    td.highlight {
      background-color: whitesmoke !important;
    }
  </style>

</head>

<body>

  <nav style="font-size: large" class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <ul class="navbar-nav">

      <li class="nav-item active">
        <a class="nav-link" href="./index.php">
          BES
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./reg_std.php">Register Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./display.php?fee_status=NULL&s_fee_month=August">List Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./recycle.php">Recycle Student</a>
      </li>
    </ul>
  </nav>
  <?php
  function  link_std()
  {
  ?>
    <?php
    if ($_SESSION["dflag"] == 0) {
    ?>
      <center>
        <div style="width: 100%" class="row">
          <div style="width: 90%">

            <input class="form-control" id="myInput" type="text" placeholder="Search Student">

          </div>
          <div style="width: 10%" class="pl-2">
            <div class="dropdown  dropleft">
              <button type="form-control" class=" form-control dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="view">
                View Lists
              </button>
              <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <a class="test btn btn-block btn-default dropdown-toggle" tabindex="-1" href="#">All Student <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=January">January</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=February">February</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=March">March</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=April">April</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=May">May</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=June">June</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=July">July</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=August">August</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=September">September</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=October">October</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=November">November</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=December">December</a></li>
                  </ul>
                </li>
                <li class="dropdown-submenu">
                  <a class="test btn btn-block btn-default dropdown-toggle" tabindex="-1" href="#">Paid Students <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=January">January</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=February">February</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=March">March</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=April">April</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=May">May</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=June">June</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=July">July</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=August">August</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=September">September</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=October">October</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=November">November</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=1&s_fee_month=December">December</a></li>
                  </ul>
                </li>

                <li class="dropdown-submenu">
                  <a class="test btn btn-block btn-default dropdown-toggle" tabindex="-1" href="#">Unpaid Students <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=January">January</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=February">February</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=March">March</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=April">April</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=May">May</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=June">June</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=July">July</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=August">August</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=September">September</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=October">October</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=November">November</a></li>
                    <li><a tabindex="-1" class="dropdown-item" href="display.php?fee_status=0&s_fee_month=December">December</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </div>



      <?php

    }
      ?>
    <?php
  }
    ?> <div class="bg-dark fixed-bottom" style="text-align: center">
      <b class="text-light"> Developed By Hammad Ansari</b>
    </div>
</body>

</html>
<script>

  $(document).ready(function() {
    $('.dropdown-submenu a.test').on("click", function(e) {
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
    $('#tbl').dataTable({
      dom: 'Bfrtip',
        buttons: [
          'excel'
        ],
        buttons: {
        buttons: [
            { extend: 'excel', className: 'btn btn-success xsl' }
        ]
    }
      ,searching: false,
      paging:false,
    aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: -1
});

    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>