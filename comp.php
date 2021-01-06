<?php
require('control/admin.dbh.php');

error_reporting(E_ERROR | E_PARSE);
$order = $_POST['check8'];
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

                    <form action="comp.php" method="post">
                        <select name="custA" id="">
                            <option value="" disabled selected>Managment Options</option>
                            <option value="allC">Show All Companies</option>
                            <option value="allCust">Show All Customers</option>
                            <option value="allS">Companie Sales</option>

                        </select>
                        <input type="submit">
                        <br>
                        <h7>Select when companies sales selected :</h7>
                        <input type="checkbox" name="check8" value="ORDER BY order_total DESC">
                        <label for="check8">Highest Sales</label>
                        <input type="checkbox" name="check8" value="ORDER BY order_total ASC">
                        <label for="check8">Lowest Sales</label>

                    </form>

                    <?php
                    if ($_POST['custA'] == 'allCust') {
                        // CREATE VIEW customer_view AS 
                        // SELECT CONCAT_WS(',',firstName,lastName) AS nameee, CONCAT_WS(' ', address1,address2) AS addresss, city,postCode,email, phoneNumber FROM customer
                        $sql = "SELECT * FROM customer_view";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
<tr>
 <th>Customer Name</th>
 <th>Address</th>
 <th>City</th>
 <th>PostCode</th>
 <th>Email</th>
 <th>Phone Number</th>


                     
 </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["nameee"] . "</td>";
                                echo "<td>" . $row["addresss"] . "</td>";
                                echo "<td>" . $row["city"] . "</td>";
                                echo "<td>" . $row["postCode"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["phoneNumber"] . "</td>";

                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($conn);
                        }
                    }


                    if ($_POST['custA'] == 'allC') {
                        $sql = "SELECT company.comapnyName,CONCAT_WS(' ',company.address1,company.address2) AS addresss, company.postCode,company.email,company.phoneNumber FROM company
                        ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                <tr>
                 <th>Company Name</th>
                 <th>Address</th>
                 <th>PostCode</th>
                 <th>email</th>
                 <th>Phone Number</th>
               
                                     
                 </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["comapnyName"] . "</td>";
                                echo "<td>" . $row["addresss"] . "</td>";
                                echo "<td>" . $row["postCode"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["phoneNumber"] . "</td>";

                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($conn);
                        }
                    }
                    if ($_POST['custA'] == 'allS') {
                        // CREATE VIEW comp_sales_view AS 
                        // SELECT company.comapnyName,CONCAT_WS(' ',company.address1,company.address2) AS addresss, company.postCode,company.email,company.phoneNumber,orders.order_total FROM company
                        // INNER JOIN customer ON company.company_id = customer.customer_company_id
                        // INNER JOIN orders ON customer.customer_id = orders.order_customer_id
                        $sql = "SELECT * FROM comp_sales_view $order ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                <tr>
                 <th>Company Name</th>
                 <th>Address</th>
                 <th>PostCode</th>
                 <th>email</th>
                 <th>Phone Number</th>
                 <th>Orders</th>
                                     
                 </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["comapnyName"] . "</td>";
                                echo "<td>" . $row["addresss"] . "</td>";
                                echo "<td>" . $row["postCode"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["phoneNumber"] . "</td>";
                                echo "<td>" . $row["order_total"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($conn);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>