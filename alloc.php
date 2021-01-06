<!-- Employee access to the database  -->
<?php
require('control/admin.dbh.php');
error_reporting(E_ERROR | E_PARSE);
$empID = $_POST['emp'];
$empID2 = $_POST['emp2'];
$jobID = $_POST['job'];
$locID = $_POST['loc'];
if (isset($_POST['emp'])) {
    $sqlInsertJob = "UPDATE joball_admin_view SET all_job_id ='$jobID',all_location_id='$locID'  WHERE all_emp_id = '$empID'; ";
    mysqli_query($conn, $sqlInsertJob);
    $sqlDeleteMsg = "DELETE FROM jobTransfer WHERE tr_emp_id = '$empID'";
    mysqli_query($conn, $sqlDeleteMsg);
}
if (isset($_POST['emp2'])) {
    $sqlInsertJob = "UPDATE jobAllocation SET all_job_id = NULL, all_location_id= NULL  WHERE all_emp_id = '$empID2'; ";
    mysqli_query($conn, $sqlInsertJob);
    // $sqlDeleteMsg = "DELETE FROM jobTransfer WHERE tr_emp_id = '$empID'";
    // mysqli_query($conn, $sqlDeleteMsg);
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
        <!-- Row One -->
        <div class="row">
            <!-- collumn one -->
            <div class="col-xl">

                <select name="" id="select" onchange="showDiv()">
                    <option value="" disabled selected>Managment Options</option>
                    <option value="assing">Assing Job To Employee</option>
                    <option value="remove">Remove Jobs From Employee</option>
                </select>

                <!-- Assing job to employees -->
                <div class="show" id="show" style="display:none;">
                    <form action="alloc.php" method="post">
                        <h4>Add Job To Employee</h4>
                        <select name="emp" id="ss">
                            <option value="" disabled selected>Employee Names</option>
                            <?php
                            // CREATE VIEW jobAll_emp_job_view AS
                            // SELECT CONCAT_WS('  ',employee.firstName, employee.lastName) AS nameee, employee.employee_id, job.job_name, job.job_id FROM employee 
                            // LEFT JOIN jobAllocation ON employee.employee_id = jobAllocation.all_emp_id
                            // LEFT JOIN job ON  jobAllocation.all_job_id = job.job_id
                            // WHERE firstName !=' ' 
                            $sql2 = "SELECT * FROM jobAll_emp_job_view";
                            $dropdown = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($dropdown) > 0) {

                                while ($row = mysqli_fetch_assoc($dropdown)) {
                            ?>
                                    <option value=<?php echo $row['employee_id']; ?>>
                                        <?php echo $row['nameee']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <!-- Select a job -->
                        <select name="job" id="ss">
                            <option value="" disabled selected>Job Name</option>
                            <?php
                            $sql3 = "SELECT * FROM jobAll_emp_job_view WHERE job_name != ' '";
                            $dropdown2 = mysqli_query($conn, $sql3);
                            if (mysqli_num_rows($dropdown2) > 0) {

                                while ($row = mysqli_fetch_assoc($dropdown2)) {
                            ?>
                                    <option value=<?php echo $row['job_id']; ?>>
                                        <?php echo $row['job_name']; ?>
                                    </option>
                            <?php
                                }
                            }

                            ?>
                        </select>
                        <!-- location dropdown  -->
                        <select name="loc" id="ss">
                            <option value="" disabled selected>Assing Location</option>
                            <?php
                            $sql3 = "SELECT * FROM workLocation";
                            $dropdown2 = mysqli_query($conn, $sql3);
                            if (mysqli_num_rows($dropdown2) > 0) {

                                while ($row = mysqli_fetch_assoc($dropdown2)) {
                            ?>
                                    <option value=<?php echo $row['location_id']; ?>>
                                        <?php echo $row['location_name']; ?>
                                    </option>
                            <?php
                                }
                            }

                            ?>
                        </select>

                        <input type="submit">
                    </form>
                </div>
                <!-- Remove work from Employees -->
                <div class="show" id="show2" style="display:none;">

                    <form action="alloc.php" method="post">
                        <h4>Remove Job From Employee</h4>
                        <select name="emp2" id="ss">
                            <option value="" disabled selected>Employee Names</option>
                            <?php
                            $sql2 = "SELECT * FROM jobAll_emp_job_view";
                            $dropdown = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($dropdown) > 0) {

                                while ($row = mysqli_fetch_assoc($dropdown)) {
                            ?>
                                    <option value=<?php echo $row['employee_id']; ?>>
                                        <?php echo $row['nameee']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        <input type="submit">
                    </form>



                </div>
                <h3 style=" text-align: center;">Employee Requested Positions</h3>

                <?php
                // Employee and Job Query
                // CREATE VIEW job_tra_view AS
                // SELECT CONCAT_WS(' ',employee.firstName,employee.lastName) AS empName, jobTransfer.request_date, jobTransfer.descryption, job.job_name FROM employee 
                //     INNER JOIN jobTransfer ON employee.employee_id = jobTransfer.tr_emp_id
                //     INNER JOIN job ON jobTransfer.tr_job_id = job.job_id 
                $sql = "SELECT * FROM job_tra_view";
                $result = mysqli_query($conn, $sql);
                // Display employee table

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>
                            <tr>
                             <th style='background-color:#02AA91;'>Employee Name</th>
                             <th style='background-color:#02AA91;'>Submition Date</th>
                             <th style='background-color:#02AA91;'>Job Name</th>
                             <th style='background-color:#02AA91;'>Additional Notes</th>
                             </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td style='background-color:#04ADCE;'>" . $row["empName"] . "</td>";
                        echo "<td style='background-color:#04ADCE;'>" . $row["request_date"] . "</td>";
                        echo "<td style='background-color:#04ADCE;'>" . $row["job_name"] . "</td>";
                        echo "<td style='background-color:#04ADCE;'>" . $row["descryption"] . "</td>";

                        echo "</tr>";
                    }
                }


                // Employee and Job Query
                //                 CREATE VIEW work_loca_job_all_view AS 
                // SELECT CONCAT_WS(' ',employee.firstName,employee.lastName) AS empName,job.job_name,workLocation.location_name FROM employee
                // LEFT JOIN jobAllocation ON employee.employee_id = jobAllocation.all_emp_id 
                // LEFT JOIN job ON jobAllocation.all_job_id = job.job_id
                // LEFT JOIN workLocation ON jobAllocation.all_location_id = workLocation.location_id
                // WHERE firstName !=' '
                $sql = "SELECT * FROM work_loca_job_all_view";
                $result = mysqli_query($conn, $sql);
                // Display employee table

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>
                            <tr>
                             <th>Employee Name</th>
                             <th>Job Name</th>
                             <th>Job Location</th>
                             </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["empName"] . "</td>";
                        echo "<td>" . $row["job_name"] . "</td>";
                        echo "<td>" . $row["location_name"] . "</td>";
                        echo "</tr>";
                    }
                }


                mysqli_close($conn); ?>
                <h3 style="text-align: center;">All Employees</h3>

            </div>

        </div>

    </div>
    <script>
        function showDiv() {
            var show = document.getElementById('show');
            var show2 = document.getElementById('show2');
            var value = document.getElementById('select').value;
            if (value === 'assing') {
                show.style.display = 'block';
                show2.style.display = 'none';
            } else if (value === 'remove') {
                show.style.display = 'none';
                show2.style.display = 'block';
            }
        }
    </script>
</body>

</html>