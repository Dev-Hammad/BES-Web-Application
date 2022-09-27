<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deleted Students List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
    include "config.php";
    ?>
    <br>
    <div class="mt-5 mb-5" style="background-color:white;padding:1%">
        <h1>Deleted Students List</h1>
        <?php
        if ($_SESSION["flag"] == 0) {
        ?>
        <?php
        }
        if ($_SESSION["Update"] != "") {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="update" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Successfully Update</strong> <?php echo $_SESSION["Update"] ?>
            </div>
            <?php
            $_SESSION["Update"] = null;            
            ?>
        <?php
        } ?>
        <?php
       if ($_SESSION["info"] != "") {
        ?>
            <div class="alert alert-danger alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="delete" type="button" class="close" data-dismiss="alert">×</button>
                <strong>Successfully Delete</strong> <?php echo $_SESSION["info"] ?>
            </div>
            <?php
            $_SESSION["info"] = null;
            ?>
        <?php
        }
        if ($_SESSION["insert"] != "") {
        ?>
            <div class="alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
                <button id="insert" type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Successfully Added</strong> <?php echo $_SESSION["insert"] ?>.
            </div>
            <?php
            $_SESSION["insert"] = null;
            ?>
        <?php
        }
        ?>
        <br>
        <table style="font-size: small" class="table table-bordered table-bordered table-light table-hover table-striped text-center table-responsive-xl">
            <thead class="thead-dark">
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
                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                $fees_Total = 0;
                $Students_Count = 0;
                ?>
                <?php
                $List = "SELECT *
                          FROM std T1, std_fee T2
                          WHERE T1.s_id = T2.s_id AND T1.Active = 0 AND T2.Active = 0";
                $result = mysqli_query($conn, $List);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <?php
                    if ($row["s_id"] == $_SESSION["del_record"]) {
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
                            <td><?php echo $row["s_doa"] ?></td>
                            <td><?php echo $row["s_dou"] ?></td>
                            <td>
                                <a href="./cRecycle.php?Recycleid=<?php echo $row["s_id"] ?>" class="btn btn-success btn-default btn-block">Recycle</a>
                            </td>
                        </tr>
                    <?php
                        $Students_Count++;
                        $fees_Total = $fees_Total + $row["s_fee"];
                        $_SESSION["del_record"] = null;
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
                            <td><?php echo $row["s_doa"] ?></td>
                            <td><?php echo $row["s_dou"] ?></td>
                            <?php
                            if ($row["fee"] == 0) {
                                $row["fee"] = "Not Paid";
                            ?>
                                <td id="fee" class="text-danger">
                                        <b> 
                                            <?php 
                                                echo $row["fee"] 
                                            ?>
                                        </b>
                                </td>
                            <?php
                            } else {
                                $row["fee"] = "Paid";
                            ?>
                                <td id="fee" class="text-success">
                                        <b> 
                                            <?php 
                                                echo $row["fee"] 
                                            ?>
                                        </b>
                                </td>
                            <?php
                            }
                            ?>
                            <?php
                            $fees_Total = $fees_Total + $row["s_fee"];
                            $Students_Count++;
                            ?>
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
                        <td></td>
                        <td></td>
                        <td><b>Total Students : <?php
                                                echo  $Students_Count
                                                ?></b></td>
                                                <td>
                                                    <b>Total Fees : <?php 
                                                                        echo  $fees_Total
                                                                    ?>
                                                    </b>
                                                </td>
                        <td> <button onclick="print()" class="btn btn-outline-success">Download</button>
                        </td>
                    </tr>
                <?php
                } else {
                    $_SESSION["flag"] = 1;
                ?>
                    <tr>
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