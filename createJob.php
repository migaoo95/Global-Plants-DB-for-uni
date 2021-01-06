<!-- Employee access to the database  -->
<?php
require('control/admin.dbh.php');
error_reporting(E_ERROR | E_PARSE);
$jName = $_POST['jName'];
$jDes = $_POST['jDes'];
$delJob = $_POST['delJob'];
// DELIMITER // 
// CREATE PROCEDURE insertData(
// IN job_name varchar(20),
//    IN job_descryption varchar(200)
// )
// BEGIN 
// INSERT INTO job(job_name,job_descryption) VALUES  (job_name,job_descryption);
// END //
// DELIMITER ;
// CREATE PROCEDURE insertJobName(job_name varchar(20),job_descryption varchar(200)) BEGIN INSERT INTO job(job_name,job_descryption)
if (isset($_POST['jName'])) {
    // VIEW
    // jobs_admin_view REPLACE job
    $sqlCreate = "INSERT INTO jobs_admin_view(job_name,job_descryption) VALUES ('$jName', '$jDes')";
    mysqli_query($conn, $sqlCreate);
}
if (isset($_POST['delJob'])) {
    $sqlDeleteJobAll = "DELETE FROM joball_admin_view WHERE all_job_id='$delJob' ";
    $sqlDeleteJob = "DELETE FROM jobs_admin_view WHERE job_id='$delJob'";
    mysqli_query($conn, $sqlDeleteJobAll);
    mysqli_query($conn, $sqlDeleteJob);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleemp.css">
    <title>Document</title>
</head>

<body>
    <div id="container" class="container-sm">
        <a href="navA.php"><input type="button" value="Go back" style="float:right; color:red;"></a>
        <h1 class="h1">Global Plants</h1>
        <h4>Create or Delete Jobs</h4>
        <!-- Row One -->
        <div class="row">
            <!-- collumn one -->
            <div class="col-xl">
                <div class="form">
                    <!-- hide and show div -->
                    <form action="createJob.php" method="post" name="formm">
                        <select name="" id="select" onchange="showDiv()">
                            <option value="" disabled selected> Enter New Job Details</option>
                            <option value="add">Create New Job</option>
                            <option value="remove">Delete Job</option>
                        </select>
                        <div class="show" id="show" style="display:none;">
                            <h5>New Employee Form</h5>
                            <input type="text" placeholder="Job Name" name="jName">
                            <input type="text" placeholder="Job Descryption" name="jDes">


                            <!-- <input type="text" placeholder="Job Location" name="loc"> -->
                            <input type="submit">
                        </div>
                        <!-- delete records hide show -->
                        <div id="show2" style="display:none;">
                            <h4>Select Job To Delete</h4>
                            <form action="createJob.php" method="post">
                                <select name="delJob" id="ss">
                                    <option value="" disabled selected>Select Job</option>
                                    <?php
                                    // CREATE VIEW jobs_admin_view AS 
                                    // SELECT * FROM job WHERE job_name != ' ';

                                    $sql2 = "SELECT * FROM jobs_admin_view";
                                    mysqli_query($conn, $sql2);
                                    $dropdown = mysqli_query($conn, $sql2);
                                    if (mysqli_num_rows($dropdown) > 0) {

                                        while ($row = mysqli_fetch_assoc($dropdown)) {

                                    ?>
                                            <option value=<?php echo $row['job_id']; ?>>
                                                <?php echo $row['job_name']; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="submit">
                            </form>
                        </div>

                        <?php

                        // Employee and Job Query
                        $sql = "SELECT * FROM jobs_admin_view";
                        $result = mysqli_query($conn, $sql);
                        // Display employee table

                        if (mysqli_num_rows($result) > 0) {


                            echo "<table>
                            <tr>
                             <th>Job Name</th>
                             <th>Descryption</th>                           
                             </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo "<tr>";
                                echo "<td>" . $row["job_name"] . "</td>";
                                echo "<td>" . $row["job_descryption"] . "</td>";
                                echo "</tr>";

                                if (mysqli_query($conn, $sqlInsert2)) {
                                } else {

                                    // echo "SOme Error $sql. " . mysqli_error($conn);
                                }
                            }
                            echo "</table>";
                        } else {
                            echo "No results";
                        }




                        mysqli_close($conn);
                        ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showDiv() {
            var select = document.getElementById('select').value;
            var div = document.getElementById('show');
            var div2 = document.getElementById('show2');

            if (select === "add") {
                if (div.style.display === "none") {
                    div.style.display = "block";
                    div2.style.display = "none";
                } else if (div.style.display === "block") {
                    div.style.display = "none";
                }
            } else if (select === "remove") {
                div2.style.display = "block";
                div.style.display = "none";
            }
        }
    </script>
</body>

</html>