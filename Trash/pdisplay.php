<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search Student</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    </style>
</head>

<body>
    <?php
    include "config.php";
    $_SESSION["warn"] = null;
    // $_SESSION["dflag"] = 0;
    ?>
    <br>
    <div class="mt-5 mb-5" style="background-color:white;padding:1%;">
        <h1>Paid Students List</h1>
        
        <?php
        link_std();
        //Update Message
        if ($_SESSION["Update"] != "") {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="update" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Successfully Update</strong> <?php echo $_SESSION["Update"] ?>
            </div>
            <?php
            $_SESSION["Update"] = null;
            //    $_SESSION["insert"] =null;
            // $_SESSION["info"] =null;                            
            ?>
        <?php
        } ?>
        <?php
        //Delete Message
        if ($_SESSION["info"] != "") {
        ?>
            <div class="alert alert-danger alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="delete" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Successfully Delete</strong> <?php echo $_SESSION["info"] ?>
            </div>

            <?php
            $_SESSION["info"] = null;
            //  $_SESSION["Update"] =null;                            
            ?>
        <?php
            //Added Message

        }
        if ($_SESSION["insert"] != "") {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="insert" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Successfully Added</strong> <?php echo $_SESSION["insert"] ?>.
            </div>
            <?php
            $_SESSION["insert"] = null;
            //   $_SESSION["Update"] =null;
            //    $_SESSION["info"] =null;   
            ?>
        <?php
        }
        ?>
        <?php
        if ($_SESSION["recycle"] != null) {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="insert" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Successfully Recycled</strong> <?php echo $_SESSION["recycle"] ?>.
            </div>
            <?php
            $_SESSION["recycle"] = null;
            //   $_SESSION["Update"] =null;
            //    $_SESSION["info"] =null;   
            ?>
        <?php
        }
        ?>
        <br>
        <table style="font-size: small;width:100%" id="example" class="text-nowrap row-border hover order-column table table-bordered table-bordered table-light table-hover table-striped text-center table-responsive-sm  table-responsive-md  table-responsive-lg table-fixed">
            <thead class="thead-dark ">
                <tr>
                    <th>S.Name</th>
                    <th>F.Name</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th>Courses</th>
                    <th>Gender</th>
                    <th>Religion</th>
                    <th>City</th>
                    <th>Fees</th>
                    <th>DOA</th>
                    <th>DOU</th>
                    <th>Fee Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                $fees_Total = 0;
                $Students_Count = 0;
                ?>
                <?php
                $List = "SELECT * FROM `std` WHERE Active = 1 AND fee = 1";
                $result = mysqli_query($conn, $List);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <?php
                    if ($row["s_id"] == $_SESSION["insert_record"]) {
                    ?>
                        <tr class="bg-info text-white">
                            <td><?php echo $row["s_name"] ?></td>
                            <td><?php echo $row["f_name"] ?></td>
                            <td><?php echo $row["s_address"] ?></td>
                            <td><?php echo $row["s_class"] ?></td>
                            <td><?php echo $row["s_courses"] ?></td>
                            <td><?php echo $row["s_gender"] ?></td>
                            <td><?php echo $row["s_religion"] ?></td>
                            <td><?php echo $row["s_city"] ?></td>
                            <td><?php echo $row["s_fee"] ?></td>
                            <td><?php echo $row["s_date"] ?></td>
                            <td><?php echo $row["s_u_date"] ?></td>
                            <td>
                                <a href="./Delete_record.php?deleteid=<?php echo $row["s_id"] ?>" class="btn btn-danger btn-default btn-block">Delete</a>
                                <a href="./update.php?updateid=<?php echo $row["s_id"] ?>" class="btn btn-primary btn-default btn-block">Update</a>
                                <!-- <button class="btn btn-outline-danger btn-default btn-block">Delete</button> -->
                                <!-- <button  class="btn btn-outline-primary btn-default btn-block">Edit</button> -->

                            </td>
                        </tr>
                    <?php
                        $_SESSION["insert_record"] = null;
                        $Students_Count++;
                        $fees_Total = $fees_Total + $row["s_fee"];
                    } else  if ($row["s_id"] == $_SESSION["s_id"] || $_SESSION["recycle_record"] == $row["s_id"]) {
                    ?>
                        <tr class="bg-info text-white">
                            <td><?php echo $row["s_name"] ?></td>
                            <td><?php echo $row["f_name"] ?></td>
                            <td><?php echo $row["s_address"] ?></td>
                            <td><?php echo $row["s_class"] ?></td>
                            <td><?php echo $row["s_courses"] ?></td>
                            <td><?php echo $row["s_gender"] ?></td>
                            <td><?php echo $row["s_religion"] ?></td>
                            <td><?php echo $row["s_city"] ?></td>
                            <td><?php echo $row["s_fee"] ?></td>
                            <td><?php echo $row["s_date"] ?></td>
                            <td><?php echo $row["s_u_date"] ?></td>
                            <?php
                            if ($row["fee"] == 0) {
                                $row["fee"] = "Not Paid";
                            } else {
                                $row["fee"] = "Paid";
                            }
                            ?>
                            <td id="fee"><?php echo $row["fee"] ?></td>
                            <td>
                                <div class="row p-2">

                                    <a href="./Delete_record.php?deleteid=<?php echo $row["s_id"] ?>" class="btn btn-danger btn-default btn-block">Delete</a>
                                    <a href="./update.php?updateid=<?php echo $row["s_id"] ?>" class=" btn btn-primary btn-default btn-block">Update</a>



                                    <?php
                                    if ($row["fee"] == "Paid") {
                                    ?>
                                        <a id="fee_btn" href="./std_fee.php?stdid=<?php echo $row["s_id"] ?>" class="btn btn-success disabled  btn-default btn-block">Paid</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a id="fee_btn" href="./std_fee.php?stdid=<?php echo $row["s_id"] ?>" class="btn btn-success btn-default btn-block">Fee Pay</a>

                                    <?php
                                    }
                                    ?>
                                    <a href="./View_std_details.php?Dataid=<?php echo $row["s_id"] ?>" class="btn btn-warning btn-default btn-block">Details</a>

                                </div>

                                <!-- <button class="btn btn-outline-danger btn-default btn-block">Delete</button> -->
                                <!-- <button  class="btn btn-outline-primary btn-default btn-block">Edit</button> -->

                            </td>
                        </tr>
                    <?php
                        $Students_Count++;
                        $fees_Total = $fees_Total + $row["s_fee"];
                        $_SESSION["s_id"] = null;
                        $_SESSION["recycle_record"] = null;
                    } else {
                    ?>
                        <tr>
                            <td><?php echo $row["s_name"] ?></td>
                            <td><?php echo $row["f_name"] ?></td>
                            <td><?php echo $row["s_address"] ?></td>
                            <td><?php echo $row["s_class"] ?></td>
                            <td><?php echo $row["s_courses"] ?></td>
                            <td><?php echo $row["s_gender"] ?></td>
                            <td><?php echo $row["s_religion"] ?></td>
                            <td><?php echo $row["s_city"] ?></td>
                            <td><?php echo $row["s_fee"] ?></td>
                            <td><?php echo $row["s_date"] ?></td>
                            <td><?php echo $row["s_u_date"] ?></td>
                            <?php
                            if ($row["fee"] == 0) {
                                $row["fee"] = "Not Paid";
                            ?>
                                <td id="fee" class="text-danger"><b> <?php echo $row["fee"] ?></b></td>

                            <?php
                            } else {
                                $row["fee"] = "Paid";
                            ?>
                                <td id="fee" class="text-success"><b> <?php echo $row["fee"] ?></b></td>

                            <?php
                            }
                            ?>

                            <?php
                            $fees_Total = $fees_Total + $row["s_fee"];
                            $Students_Count++;
                            $_SESSION["Insert_Highlight"] = $row["s_id"] + 1;
                            ?> <td>
                                <div class="container">
                                    <div class="row  pl-2">

                                        <a href="./Delete_record.php?deleteid=<?php echo $row["s_id"] ?>" class="btn-sm p-2 btn btn-outline-danger btn-default btn-block">Delete</a>
                                        <a href="./update.php?updateid=<?php echo $row["s_id"] ?>" class="btn-sm btn btn-outline-primary btn-default btn-block">Update</a>


                                        <?php
                                        if ($row["fee"] == "Paid") {
                                        ?>
                                            <a id="fee_btn" href="./std_fee.php?stdid=<?php echo $row["s_id"] ?>" class="btn-sm p-2 btn btn-success disabled btn-default btn-block">Paid</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a id="fee_btn" href="./std_fee.php?stdid=<?php echo $row["s_id"] ?>" class="btn-sm p-2 btn btn-outline-success btn-default btn-block">Fee Pay</a>

                                        <?php
                                        }
                                        ?>
                                        <a href="./View_std_details.php?Dataid=<?php echo $row["s_id"] ?>" class=" btn-sm btn btn-outline-warning btn-default btn-block">Details</a>




                                    </div>
                                </div>
                                <!-- <button class="btn btn-outline-danger btn-default btn-block">Delete</button> -->
                                <!-- <button  class="btn btn-outline-primary btn-default btn-block">Edit</button> -->

                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
                <?php
                if ($Students_Count > 0) {



                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php
                            /*$date =  date("d")."-".date("M")."-". date("o");
                    echo $date*/
                            ?></td>

                        <td colspan="2"><b>Total Students : <?php
                                                            echo  $Students_Count
                                                            ?></b></td>
                        <td colspan="2"><b>Total Fees : RS. <?php
                                                            echo  $fees_Total
                                                            ?></b></td>
                        <td> <a href="./preview.php" class="btn btn-outline-success btn-block pl-2 ml-2 ">Preview</a>
                        </td>
                    </tr>
                <?php
                } else {
                    // $_SESSION["dflag"] = 1;


                ?>
                    <tr>
                        <td></td>
                        <td colspan="12" style="font-size:2em" class="text-danger">
                            <b>
                                No Record Found in List
                            </b>
                        </td>

                    </tr>

                <?php

                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {


            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>


</html>