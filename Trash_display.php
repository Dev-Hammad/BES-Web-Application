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
    ?>
    <br>
    <div class="mt-5 mb-5" style="background-color:white;padding:1%;">
        <h1>All Students List</h1>
        <?php
        link_std()
        ?>
        <?php
        if ($_SESSION["Update"] != "") {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="update" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Successfully Update</strong> <?php echo $_SESSION["Update"] ?>
            </div>
            <?php
            ?>
        <?php
        } else if ($_SESSION["info"] != "") {
        ?>
            <div class="alert alert-danger alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="delete" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Successfully Delete</strong> <?php echo $_SESSION["info"] ?>
            </div>
            <?php
            $_SESSION["info"] = null;
            ?>
        <?php
        } else if ($_SESSION["insert"] != "") {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="insert" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Successfully Added</strong> <?php echo $_SESSION["insert"] ?>.
            </div>
        <?php
            $_SESSION["insert"] = null;
        } else if ($_SESSION["recycle"] != null) {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="insert" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Successfully Recycled</strong> <?php echo $_SESSION["recycle"] ?>.
            </div>
            <?php
            $_SESSION["recycle"] = null;
            ?>
        <?php
        } else if ($_SESSION["fee"] != null) {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="fp" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Successfully Fees Paid From</strong> <?php echo $_SESSION["fee"] ?>.
            </div>
        <?php
            $_SESSION["fee"] = null;
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
            <tbody>
                <?php
                $fees_Total = 0;
                $Students_Count = 0;
                $Get_Data = $_GET["s_fee_month"];
                ?>
                <?php
                if ($_GET["fee_status"] == 0) {
                    $List = "SELECT *
                    FROM std T1, std_fee T2
                    WHERE  T2.s_fee_month= '$Get_Data'  AND  T1.s_id = T2.s_id AND T1.Active = 1 AND ( T2.Active = 1 AND T2.s_fee_status = 0 )";
                } else if ($_GET["fee_status"] == 1) {
                    $List = "SELECT *
                    FROM std T1, std_fee T2
                    WHERE  T2.s_fee_month= '$Get_Data'  AND  T1.s_id = T2.s_id AND T1.Active = 1 AND  ( T2.Active = 1 AND T2.s_fee_status = 1 )";
                }
                if ($_GET["fee_status"] == "NULL") {
                    $List = "SELECT *
                    FROM std T1, std_fee T2
                    WHERE  T2.s_fee_month= '$Get_Data'  AND  T1.s_id = T2.s_id AND T1.Active = 1 AND  ( T2.Active = 1 OR T2.s_fee_status = 0 )";
                }
                $result = mysqli_query($conn, $List);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <?php
                    if (
                        $row["s_id"] == $_SESSION["insert_record"] ||
                        $row["s_id"] == $_SESSION["s_id"]          ||
                        $_SESSION["recycle_record"] == $row["s_id"]
                    ) {
                    ?>
                        <tr class="bg-info text-white">
                        <?php
                    } else {
                        ?>
                        <tr>
                        <?php
                    } ?>
                        <td><?php echo $row["s_name"] ?></td>
                        <td><?php echo $row["f_name"] ?></td>
                        <td><?php echo $row["s_address"] ?></td>
                        <td><?php echo $row["s_class"] ?></td>
                        <td><?php echo $row["s_courses"] ?></td>
                        <td><?php echo $row["s_gender"] ?></td>
                        <td><?php echo $row["s_religion"] ?></td>
                        <td><?php echo $row["s_city"] ?></td>
                        <td><?php echo $row["s_fee"] ?></td>
                        <td><?php echo $row["s_doa"] ?></td>
                        <td><?php echo $row["s_dou"] ?></td>
                        
                        <?php
                            if ($row["s_fee_status"] == 0) {
                                $row["s_fee_status"] = "Not Paid";
                            ?>
                                <td id="fee" style="font-size: medium" class="bg-danger text-white"><b> <?php echo $row["s_fee_status"]."( ".$row["s_fee_month"]." )" ?></b></td>

                            <?php
                            } else {
                                $row["s_fee_status"] = "Paid";
                            ?>
                                <td id="fee" style="font-size:medium;" class="bg-success text-white"><b> <?php echo $row["s_fee_status"]."( ".$row["s_fee_month"]." )" ?></b></td>
                            <?php
                            }
                            ?>
                     <td>
                                <div class="container">
                                    <div class="row  pl-2">
                                        <a href="./Delete_record.php?deleteid=<?php echo $row["s_id"] ?>" class="btn-sm p-2 btn btn-outline-danger btn-default btn-block">Delete</a>
                                        <a href="./update.php?updateid=<?php echo $row["s_id"] ?>" class="btn-sm btn btn-outline-primary btn-default btn-block">Update</a>
                                        <?php
                                        if ($row["s_fee_status"] == "Paid") {
                                        ?>
                                        <a id="fee_btn" href="./std_fee.php?stdid=<?php echo $row["s_id"] ?>" class="btn btn-outline-success btn-default btn-block">Fee Pay</a>
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
                            </td>
                        </tr>
                    <?php
                    $_SESSION["insert_record"] = null;
                    $Students_Count++;
                    $fees_Total = $fees_Total + $row["s_fee"];
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
                            <td></td>
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
                        $_SESSION["dflag"] = 0;
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