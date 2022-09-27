<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search Student</title>
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
            <input class="form-control" value="" id="myInput" type="text" placeholder="Search Student">
        <?php
            //Update Message
        }

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
                    <th>Month Date</th>
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
                               $List = "SELECT *
                               FROM std T1, std_fee T2
                               WHERE T1.s_id = T2.s_id AND T1.Active = 0 AND T2.Active = 0 ORDER BY T1.s_name DESC";
                               $result = mysqli_query($conn, $List);
                $result = mysqli_query($conn, $List);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <?php
                    if ($row["s_id"] == $_SESSION["del_record"]) {
                    ?>
                        <tr class="bg-info text-white">
<?php
                }else{
?>
                        <tr>
                    <?php
                    }  
                    ?>
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
                            <td><?php echo $row["s_fee_pay_date"] ?></td>
                            <?php
                            if ($row["s_fee_status"] == 0) {
                                $row["s_fee_status"] = "Not Paid";
                            ?>
                                <td id="fee" class="bg-danger text-white"><b> <?php echo $row["s_fee_status"] ?></b></td>

                            <?php
                            } else {
                                $row["s_fee_status"] = "Paid";
                            ?>
                                <td id="fee" class="bg-success text-white"><b> <?php echo $row["s_fee_status"] ?></b></td>
                            <?php
                            }
                            ?>
                            <?php
                            $Students_Count++;
                            ?> <td>
                                <a href="./cRecycle.php?Recycleid=<?php echo $row["s_id"] ?>" class="btn btn-outline-success btn-default btn-block">Recycle</a>
                            </td>
                        </tr>
                <?php
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
                        <td></td>
                        <td></td>
                        <td><b>Total Students : <?php echo  $Students_Count?></b></td>
                        <td> 
                        </td>
                    </tr>
                <?php
                } else {
                    $_SESSION["flag"] = 0;
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
                $_SESSION["del_record"] = null;

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