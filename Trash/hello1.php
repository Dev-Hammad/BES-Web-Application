<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include "config.php";
?>

   <br>
   <br>
   <br>
<div class="container">
  <h2>Multi-Level Dropdowns</h2>
  <p>In this example, we have created a .dropdown-submenu class for multi-level dropdowns (see style section above).</p>
  <p>Note that we have added jQuery to open the multi-level dropdown on click (see script section below).</p>                                        
  <div class="dropdown  dropleft">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li class="dropdown-submenu">
        <a class="test btn btn-block btn-default dropdown-toggle" tabindex="-1" href="#">All Student <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=January">January</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=February">February</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=March">March</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=April">April</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=May">May</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=June">June</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=June">July</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=August">August</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=September">September</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=October">October</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=November">November</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=NULL&s_fee_month=December">December</a></li>
        </ul>
      </li>
      <li class="dropdown-submenu">
        <a class="test btn btn-block btn-default dropdown-toggle" tabindex="-1" href="#">Paid Students <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=January">January</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=February">February</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=March">March</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=April">April</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=May">May</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=June">June</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=July">July</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=August">August</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=September">September</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=October">October</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=November">November</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=1&s_fee_month=December">December</a></li>
        </ul>
      </li>

   <li class="dropdown-submenu">
        <a class="test btn btn-block btn-default dropdown-toggle" tabindex="-1" href="#">Unpaid Students <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=January">January</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=February">February</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=March">March</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=April">April</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=May">May</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=June">June</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=July">July</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=August">August</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=September">September</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=October">October</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=November">November</a></li>
          <li ><a tabindex="-1"  class="dropdown-item" href="display.php?fee_status=0&s_fee_month=December">December</a></li>
        </ul>
      </li>

    </ul>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

