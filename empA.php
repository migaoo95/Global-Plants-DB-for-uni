<!-- Employee access to the database  -->
<?php
require('control/admin.dbh.php');


error_reporting(E_ERROR | E_PARSE);

$test2 = "SELECT * FROM jobAllocation WHERE all_emp_id = $value"



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
                <div class="form">
                    <!-- Add and Remove employee Select  -->
                    <select name="" id="select" onchange="showDiv()">
                        <option value="" disabled selected> Add or Remove</option>
                        <option value="add">Add New Employee</option>
                        <option value="remove">Remove Employee</option>
                    </select>
                    <!--ADD Shows and hides -->
                    <form action="empA.php" method="post" name="formm">
                        <?php
                        $fName = $_POST['fName'];
                        $lName = $_POST['lName'];
                        $add1 = $_POST['add1'];
                        $add2 = $_POST['add2'];
                        $city = $_POST['city'];
                        $pCode = $_POST['pCode'];
                        $email = $_POST['email'];
                        $pNo = $_POST['pNo'];
                        $sqlInsert = "INSERT INTO employee (firstName,lastName,address1,address2,city,postCode,email,phoneNumber) VALUES
                        ('$fName','$lName','$add1','$add2','$city','$pCode','$email','$pNo');
                        ";
                        if (mysqli_query($conn, $sqlInsert)) {
                            // echo "Records added successfully.";
                        } else {
                            echo $removeName;
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                        }
                        ?>
                        <div class="show" id="show" style="display:none;">
                            <h5>New Employee Form</h5>
                            <input type="text" placeholder="First Name" name="fName">
                            <input type="text" placeholder="Last Name" name="lName">
                            <input type="text" placeholder="address1" name="add1">
                            <input type="text" placeholder="address2" name="add2">
                            <input type="text" placeholder="City" name="city">
                            <input type="text" placeholder="Post Code" name="pCode">
                            <input type="text" placeholder="email" name="email">
                            <input type="text" placeholder="Phone Number" name="pNo">
                            <input type="submit">
                        </div>
                    </form>

                    <!--Remove Shows and hides -->

                    <div class="show2" id="show2" style="display:none;">
                        <form action="empA.php" method="post">
                            <select name="emp" id="ss">
                                <option value="" disabled selected>Find your name</option>
                                <?php
                                $sql2 = "SELECT firstName, employee_id FROM employee WHERE firstName !=' ' ";
                                if (mysqli_query($conn, $sql2)) {
                                    // echo "Records added successfully.";
                                } else {

                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                }
                                $dropdown = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($dropdown) > 0) {

                                    while ($row = mysqli_fetch_assoc($dropdown)) {

                                ?>
                                        <option value=<?php echo $row['employee_id']; ?>>
                                            <?php echo $row['firstName']; ?>
                                        </option>
                                <?php
                                    }
                                }


                                ?>
                                <?php


                                $removeName = $_POST['emp'];
                                $sqlRemove = "DELETE FROM employee WHERE employee_id='$removeName'";
                                $removeJobAll = "DELETE FROM jobAllocation WHERE all_emp_id='$removeName'";
                                echo $removeName;

                                if (mysqli_query($conn, $removeJobAll)) {
                                } else {

                                    echo "CHUJjjjjj $sql. " . mysqli_error($conn);
                                }
                                if (mysqli_query($conn, $sqlRemove)) {
                                } else {

                                    echo "CHUJjjjjj $sql. " . mysqli_error($conn);
                                }


                                ?>
                                <input type="submit">


                        </form>
                    </div>
                    <!-- Display data  -->
                    <?php
                    // Employee and Job Query
                    $sql = "SELECT employee_id,CONCAT_WS(' ',firstName,lastName) AS empName,CONCAT_WS(',',address1,address2) AS address12,phoneNumber,email,postCode FROM employee 
       WHERE firstName !=' ' ORDER BY employee_id ASC";
                    $result = mysqli_query($conn, $sql);

                    // Display employee table

                    if (mysqli_num_rows($result) > 0) {


                        echo "<table>
                            <tr>
                           
                             <th>Employee Name</th>
                             <th>Address</th>
                             <th>Post Code</th>
                             <th>Phone Number</th>
                             <th>Email</th>
                             </tr>";
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr>";

                            echo "<td>" . $row["empName"] . "</td>";
                            echo "<td>" . $row["address12"] . "</td>";
                            echo "<td>" . $row["postCode"] . "</td>";
                            echo "<td>" . $row["phoneNumber"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "</tr>";
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
</body>
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

</html>