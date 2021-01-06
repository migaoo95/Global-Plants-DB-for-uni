<?php
require('control/admin.dbh.php');
$sql = "SELECT CONCAT_WS(', ', customer.firstName,customer.lastName) AS nameee,company.comapnyName, orders.order_total, orders.order_date, COALESCE(shipment.ship_status, 'Not Shipped') AS statuss
FROM shipment 
INNER JOIN orders ON shipment.shipment_id = orders.order_shippment_id
INNER JOIN customer ON orders.order_customer_id = customer.customer_id
INNER JOIN company ON customer.customer_company_id = company.company_id";

error_reporting(E_ERROR | E_PARSE);
$order = $_POST['quarter'];
$by = $_POST['by'];
$comapnies = $_POST['companies'];
?>
<!DOCTYPE html>
<html lang="en">

<!-- *********** -->
<!-- CREATE INDEX person_first_name_idx ON customer (firstName); -->
<!-- CREATE INDEX person_first_name_idx ON customer (firstName, lastName); -->
<!-- SELECT CONCAT_WS(' ',employee.firstName,employee.lastName) AS empName, jobTransfer.request_date, jobTransfer.descryption, job.job_name FROM employee 
                    INNER JOIN jobTransfer ON employee.employee_id = jobTransfer.tr_emp_id
                    INNER JOIN job ON jobTransfer.tr_job_id = job.job_id -->

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
                    <form action="estimate.php" method="post">
                        <label for="check8">Select Quarter</label>
                        <select name="quarter" id="">

                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <label for="check8">Order By</label>
                        <select name="by" id="">
                            <option value=" ORDER BY orders.order_total ASC">Minumum Value</option>
                            <option value=" ORDER BY orders.order_total DESC">Maximum Value</option>
                        </select>
                        <label for="check8">Company Name</label>
                        <select name="companies" id="ss">
                            <option value="all">All Companies</option>
                            <?php
                            $sql2 = "SELECT * FROM company";
                            mysqli_query($conn, $sql2);
                            $dropdown = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($dropdown) > 0) {
                                while ($row = mysqli_fetch_assoc($dropdown)) {
                            ?>
                                    <option value=<?php echo  $row['company_id']; ?>>
                                        <?php echo $row['comapnyName']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <input type="submit">
                    </form>
                    <?php
                    if (isset($_POST['quarter'])) {
                        // CREATE VIEW cust_comp_order_ship_complex_view AS 
                        // SELECT CONCAT_WS(', ', customer.firstName,customer.lastName) AS nameee,
                        // company.comapnyName, orders.order_total, orders.order_date,
                        // COALESCE(shipment.ship_status, 'Not Shipped') AS statuss                
                        // FROM shipment 
                        // INNER JOIN orders ON shipment.shipment_id = orders.order_shippment_id
                        // INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                        // INNER JOIN company ON customer.customer_company_id = company.company_id
                        $sql = "SELECT CONCAT_WS(', ', customer.firstName,customer.lastName) AS nameee,
                        company.comapnyName, orders.order_total, orders.order_date,
                        COALESCE(shipment.ship_status, 'Not Shipped') AS statuss                
                        FROM shipment 
                        INNER JOIN orders ON shipment.shipment_id = orders.order_shippment_id
                        INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                        INNER JOIN company ON customer.customer_company_id = company.company_id
                        WHERE QUARTER(orders.order_date) = $order  AND company.company_id = $comapnies $by";

                        $sql2 = "SELECT ROUND(AVG(order_total),2) AS avgTotal, company.comapnyName FROM orders
                        INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                        INNER JOIN company ON customer.customer_company_id = company.company_id WHERE company.company_id = $comapnies";
                        $resultt = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($resultt) > 0) {
                            while ($roww = mysqli_fetch_assoc($resultt)) {
                                echo "<h1>" . "Average sales from this quarter are " . $roww["avgTotal"] . "</h1>";
                            }
                        }
                    }
                    //                     SELECT ROUND(AVG(order_total),2) AS avgTotal, company.company_id FROM orders 
                    // INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                    // INNER JOIN company ON customer.customer_company_id = comapny.company_id
                    // WHERE  company.company_id = 5
                    if (isset($_POST['quarter']) && $comapnies == 'all') {
                        $sql = "SELECT CONCAT_WS(', ', customer.firstName,customer.lastName) AS nameee,company.comapnyName, orders.order_total, orders.order_date, COALESCE(shipment.ship_status, 'Not Shipped') AS statuss
                        FROM shipment 
                        INNER JOIN orders ON shipment.shipment_id = orders.order_shippment_id
                        INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                        INNER JOIN company ON customer.customer_company_id = company.company_id
                         WHERE QUARTER(orders.order_date) = $order  $by";
                    }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
<tr>
<th>Customer Name</th>
<th>Company Name</th>
<th>Order Total</th>
<th>Order Date</th>
<th>Shippment Status</th>                
</tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["nameee"] . "</td>";
                            echo "<td>" . $row["comapnyName"] . "</td>";
                            echo "<td>" . $row["order_total"] . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td>" . $row["statuss"] . "</td>";

                            echo "</tr>";
                        }
                        echo "</table>";
                        // echo "<h1>" . $row["avgg"] . "</h1>";
                        // mysqli_close($conn);
                    }


                    ?>

                </div>
            </div>
        </div>
</body>

</html>