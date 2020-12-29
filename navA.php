<!-- Employee access to the database  -->
<?php
require('control/admin.dbh.php');
echo "hello Admin";
error_reporting(E_ERROR | E_PARSE);
if ($_POST["select"] == "employee") {
    header("Location: empA.php");
    die();
} else if ($_POST["select"] == "stock") {
    header("Location: stock.php");
    die();
} else if ($_POST["select"] == "gHouse") {
    header("Location: gHouse.php");
    die();
} else if ($_POST["select"] == "jobs") {
    header("Location: jobs.php");
    die();
} else if ($_POST["select"] == "ship") {
    header("Location: ship.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div id="container" class="container-sm">
        <h1 class="h1">Global Plants</h1>
        <!-- Row One -->
        <div class="row">
            <!-- collumn one -->
            <div class="col-xl">
                <form action="navA.php" method="post">
                    <select name="select" id="">
                        <option value="employee">Employee</option>
                        <option value="stock">Stock Depo</option>
                        <option value="gHouse">Greeh House</option>
                        <option value="jobs">Jobs</option>
                        <option value="ship">Shippment</option>

                    </select>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                </form>
                <!-- <div class="d-grid">
                    <button class="btn btn-info" onclick="location.href='emp.php';">Employees</button><br>
                    <button class="btn btn-info" onclick="location.href='stock.php';">Stock Depo</button><br>
                    <button class="btn btn-info" onclick="location.href='emp.php';">Green House</button><br>
                    <button class="btn btn-info" onclick="location.href='emp.php';">Jobs</button><br>
                    <button class="btn btn-info" onclick="location.href='emp.php';">Shippments</button>
                </div> -->
                <!-- Display data  -->

            </div>
        </div>
    </div>
    </div>
</body>

</html>