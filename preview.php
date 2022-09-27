<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php
    include "config.php";
    ?>
    <br>
    <div class="mt-5 mb-5" style="background-color:white;padding:1%">
        <h1>Students List</h1>
        <?php
        if ($_SESSION["flag"] == 0) {
        ?>
        <?php
        }
        if ($_SESSION["Update"] != "") {
        ?>
            <div class=" alert alert-success alert-dismissible mt-2" style="margin-bottom: 0px;margin-top: 10px;">
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
        link_std();
        ?>
        <br>
        <table id="tbl" style="font-size: small" class="display table table-bordered table-bordered table-light table-hover table-striped text-center table-responsive-xl">
            <thead class="thead-dark">
                <tr>
                    <th>S.Name</th>
                    <th>F.Name</th>
                    <th class="d-none">Contact No</th>
                    <th class="d-none">Address</th>
                    <th class="d-none">Gender</th>
                    <th class="d-none">Religion</th>
                    <th class="d-none">City</th>
                    <th>Class</th>
                    <th>Courses</th>
                    <th>Fee Pay Date</th>
                    <th class="d-none">Fees Pay Month</th>
                    <th class="d-none">Student Year</th>
                    <th>Monthly Fees</th>
                    <th>Advance Fees</th>
                    <th>Month</th>
                    <th class="d-none">DOA</th>
                    <th class="d-none">DOU</th>
                    <th>Record Status</th>
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
                WHERE T1.s_id = T2.s_id ORDER BY T1.s_name DESC";
                $result = mysqli_query($conn, $List);
                while ($row = mysqli_fetch_assoc($result)) {
                    $flag = 0;
                    if ($row["Active"] == 1) {
                        $flag = 1;
                        $row["Active"] = "Record Saved";
                    }
                    else {
                        $flag = 0;
                        $row["Active"] = "Record Deleted";
                    }
                ?>
                    <tr>
                        <td><?php echo $row["s_name"] ?></td>
                        <td><?php echo $row["f_name"] ?></td>
                        <td class="d-none"><?php echo $row["s_cntct"] ?></td>
                        <td class="d-none"><?php echo $row["s_address"] ?></td>
                        <td class="d-none"><?php echo $row["s_gender"] ?></td>
                        <td class="d-none"><?php echo $row["s_religion"] ?></td>
                        <td class="d-none"><?php echo $row["s_city"] ?></td>
                        <td><?php echo $row["s_class"] ?></td>
                        <td><?php echo $row["s_courses"] ?></td>
                        <td><?php echo $row["s_fee_pay_date"] ?></td>
                        <td class="d-none"><?php echo $row["s_fee_month"] ?></td>
                        <td class="d-none"><?php echo $row["s_fee_year"] ?></td>
                        <td><?php echo $row["s_fee"] ?></td>
                        <td><?php echo $row["std_adv_fees"] ?></td>                        <td><?php echo $row["s_fee_month"] ?></td>
                        <td class="d-none"><?php echo $row["s_doa"] ?></td>
                        <td class="d-none"><?php echo $row["s_dou"] ?></td>
                        <?php if ($flag == 0) {
                        ?>
                            <td class=" bg-danger text-white">
                            <?php
                        } else { ?>
                            <td class=" bg-success text-white">
                            <?php
                        } ?>
                            <b><?php echo $row["Active"] ?></b></td>
                            <?php
                            if ($row["s_fee_status"] == 0) {
                                $row["s_fee_status"] = "Not Paid";
                            ?>
                                <td id="fee" class="bg-danger text-white">
                                    <b>
                                        <?php
                                        echo $row["s_fee_status"]
                                        ?>
                                    </b>
                                </td>
                            <?php
                            } else {
                                $row["s_fee_status"] = "Paid";
                            ?>
                                <td id="fee" class="bg-success text-white">
                                    <b>
                                        <?php
                                        echo $row["s_fee_status"]
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
                ?>
                <?php
                if ($Students_Count > 0) {
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td><td></td>
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
            </tfoot>
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
<script>
$(document).ready(function(){
     document.getElementsByTagName("button")[0].disabled = true;
});
</script>