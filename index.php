<?php
require('control/dbh.php');

if (isset($_POST['name']) && isset($_POST['pass'])) {

    // Assigning POST values to variables.
    $username = $_POST['name'];
    $password = $_POST['pass'];


    // CHECK FOR THE RECORD FROM TABLE
    $query = "SELECT * FROM mysql.user WHERE User='$username' and Password='$password'";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
    $hash = '*4AF6A605951EFE46702538F86F7611FBC34EAA43';


    if ($_POST['name'] == 'Emp' && $_POST['pass'] == 'Emp123') {
        header("Location: nav.php");
        die();
    } else if ($_POST['name'] == 'Admin' && $_POST['pass'] == 'Admin123') {
        header("Location: navA.php");
        die();
    } else {
        echo "<script type='text/javascript'>alert('Wrong Details try again')</script>";
        //echo "Invalid Login Credentials";
    }
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
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

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
                <p>Username: Emp Password: Emp123</p>

            </div>
            <div class="col">
                <h5>Admin</h5>
                <p>Username: Admin Password: Admin123</p>

            </div>
        </div>
    </div>
</body>

</html>