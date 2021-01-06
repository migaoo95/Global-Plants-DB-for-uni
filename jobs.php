<!-- Employee access to the database  -->
<?php
require('control/emp.dbh.php');
echo "hello emp";
error_reporting(E_ERROR | E_PARSE);
// Get the form value
$employee = $_POST["name"];
$jobs = $_POST['jobs'];
$emp = $_POST['emp'];
$note = $_POST['notes'];
if (isset($_POST['emp'])) {
    $getId = "SELECT firstName from employee WHERE employee_id='$emp'";
    $results = mysqli_query($conn, $getId);
    $value = mysqli_fetch_field($results);
}
//Clean any special characters 
$employee = mysqli_real_escape_string($conn, $employee);
//SQL query
// JOB LOCATION VIEW
// CREATE VIEW job_location_view AS
// SELECT job.job_id,job.job_name,job.job_descryption,workLocation.location_name FROM job 
// INNER JOIN jobAllocation ON job.job_id = jobAllocation.all_job_id
// INNER JOIN workLocation ON jobAllocation.all_location_id = workLocation.location_id
// WHERE jobAllocation.all_emp_id IS NULL
$sql = "SELECT * FROM job_location_view;
;";
// Store my results
$result = mysqli_query($conn, $sql);
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
        <a href="nav.php"><input type="button" value="Go back" style="float:right; color:red;"></a>
        <h1 class="h1">Global Plants</h1>
        <h5>Create a Application Request</h5>
        <!-- Row One -->
        <div class="row">
            <!-- collumn one -->
            <div class="col-xl">
                <div class="form">
                    <form action="jobs.php" method="post" name="name">
                        <!-- Jobs dropdown -->
                        <select name="jobs" id="ss">
                            <option value="" disabled selected>Select a Job</option>
                            <?php
                            $dropdown = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($dropdown) > 0) {
                                while ($row = mysqli_fetch_assoc($dropdown)) {
                                    $jobid = $row['job_id'];
                            ?>
                                    <option value=<?php echo $row['job_name']; ?>>
                                        <?php echo $row['job_name']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <!-- employee dropdown -->
                        <select name="emp" id="ss">
                            <option value="" disabled selected>Find your name</option>
                            <?php

                            // CREATE VIEW emp_job_alloc_view AS 
                            // SELECT firstName,employee_id,jobAllocation.all_job_id FROM employee INNER JOIN jobAllocation ON employee.employee_id = jobAllocation.all_emp_id
                            $sql2 = "SELECT * FROM  emp_job_alloc_view  WHERE all_job_id IS NULL";
                            $dropdown = mysqli_query($conn, $sql2);

                            if (mysqli_num_rows($dropdown) > 0) {
                                while ($row = mysqli_fetch_assoc($dropdown)) {
                                    $idd = $row['employee_id'];
                            ?>
                                    <option value=<?php echo $row['employee_id']; ?>>
                                        <?php echo $row['firstName']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <!-- Note text input -->
                        <input type="text" name="notes" id="" placeholder="Notes for employer">
                        <input type="submit">
                        <!-- <input type="text" name="name" class="form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Employee name">
                        <input type="submit" value="Submit / Refresh"></input></br> -->

                    </form>

                    <?php
                    $submit = "INSERT INTO jobTransfer(request_date,descryption,tr_emp_id,tr_job_id) VALUES ('2000-10-10','$note',$emp,$jobid)";
                    if (mysqli_query($conn, $submit)) {
                        // echo "Records added successfully.";
                    } else {

                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
                    $result2 = mysqli_query($conn, $sql2);

                    if (isset($jobs)) {


                        echo "<div style='border:solid; margin-bottom:10px;background-color:#2faabd;'>" . "Thank you " . "<span style='font-weight:bold;'>" . "</span>" . " your application for position " . "<span style='font-weight:bold;'>" . $jobs . "</span>"  . " it have been sent to your employer <br>" . "</div>";
                    }
                    ?>
                    <!-- Display data  -->
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
    <tr>
    <th>Jobs</th>
    <th>Location</th>
    <th>Descryption</th>   
     </tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["job_name"] . "</td>";
                            echo "<td>" . $row["location_name"] . "</td>";
                            echo "<td>" . $row["job_descryption"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No results";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>