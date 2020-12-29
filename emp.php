<!-- Employee access to the database  -->
<?php
require('control/emp.dbh.php');
echo "hello emp";
// error_reporting(E_ERROR | E_PARSE);
// Get the form value
$employee = $_POST["name"];
//Clean any special characters 
$employee = mysqli_real_escape_string($conn, $employee);
//SQL query
// $sql = "SELECT * FROM employee WHERE firstName LIKE '$employee%';";
$sql = "SELECT employee.firstName,employee.lastName,job.job_name,workLocation.location_name FROM employee 
   INNER JOIN jobAllocation ON employee.employee_id = jobAllocation.all_emp_id
   INNER JOIN job ON jobAllocation.all_job_id = job.job_id
   INNER JOIN workLocation ON jobAllocation.all_location_id = workLocation.location_id WHERE employee.firstName LIKE '$employee%';";
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
        <!-- Row One -->
        <div class="row">
            <!-- collumn one -->
            <div class="col-xl">
                <div class="form">
                    <form action="emp.php" method="post">
                        <input type="text" name="name" class="form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Employee name">
                        <input type="submit" value="Submit / Refresh"></input></br>
                    </form>
                    <!-- Display data  -->
                    <?php
                    // if post is sent
                    if (isset($_POST['name'])) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                            <tr>
                             <th>First Name</th>
                             <th>Last Name</th>
                             <th>Current Job</th>
                             <th>Location</th>
                             </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["firstName"] . "</td>";
                                echo "<td>" . $row["lastName"] . "</td>";
                                echo "<td>" . $row["job_name"] . "</td>";
                                echo "<td>" . $row["location_name"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No results";
                        }
                        mysqli_close($conn);
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
    <tr>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Current Job</th>
     <th>Location</th>
     </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["firstName"] . "</td>";
                                echo "<td>" . $row["lastName"] . "</td>";
                                echo "<td>" . $row["job_name"] . "</td>";
                                echo "<td>" . $row["location_name"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "No results";
                        }
                        mysqli_close($conn);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>