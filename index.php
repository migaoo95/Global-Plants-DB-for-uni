<?php
require('control/dbh.php');

error_reporting(E_ERROR | E_PARSE);

// Assigning POST values to variables.
$username = $_POST['name'];
$password = $_POST['pass'];
session_start();
$_SESSION['user'] = $username;
$_SESSION['pass'] = $password;
if ($_POST['name'] == 'EmpG' && $_POST['pass'] == 'EmpG') {
    header("Location: nav.php");
    die();
}
if ($_POST['name'] == 'Emp' && $_POST['pass'] == 'Emp') {
    header("Location: nav.php");
    die();
} else if ($_POST['name'] == 'Admin' && $_POST['pass'] == 'Admin') {
    header("Location: navA.php");
    die();
} else {
    echo "<script type='text/javascript'>alert('Wrong Details try again')</script>";
    //echo "Invalid Login Credentials";
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
    <div class="container-sm">
        <h1 class="h1">Global Plants</h1>
        <!-- FORM START -->
        <form action="index.php" method="post">

            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">

            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <br>
            <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
        <div class="row">
            <div class="col">
                <h5>Employee</h5>
                <p>Username: Emp / Password: Emp</p>
                <h5>New Employee</h5>
                <p>Username: EmpG / Password: EmpG</p>

            </div>
            <div class="col">
                <h5>Admin</h5>
                <p>Username: Admin Password: Admin</p>

            </div>

        </div>
    </div>
</body>

</html>