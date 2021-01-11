<?php
require('control/emp.dbh.php');
error_reporting(E_ERROR | E_PARSE);
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
                    <!-- hide and show div -->
                    <!-- <select name="select" id="select" onchange="showDiv()">
                        <option value="" disabled selected>Manament Options</option>
                        <option value="add">Profit & Estimation</option>
                        <option value="remove">Shippments & Orders</option>

                    </select> -->

                    <form action="os.php" method="post">
                        <select name="ship" id="">

                            <option value="all">Show All</option>
                            <option value="shipped">Shipped</option>
                            <option value="null">Not Shipped</option>
                            <option value="avg">Orders Above Average</option>
                            <option value="total">Show Total Profit</option>

                            <!-- <option value="total">Profit Estimation</option> -->
                        </select>

                        <input type="submit">
                    </form>
                </div>
                <div class="show2" id="show2" style="display:none;">2</div>





                <!-- ALL ORDERS -->
                <?php
                //             CREATE VIEW cust_ord_ship_comp_view AS 
                //             SELECT CONCAT_WS(' ',customer.firstName,customer.lastName) AS namee,company.comapnyName,CONCAT_WS(' | ', orders.order_date,orders.order_time) AS dnt, shipment.ship_status, orders.order_total FROM shipment
                // INNER JOIN orders ON shipment.shipment_id = orders.order_shippment_id
                // INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                // INNER JOIN company ON customer.customer_company_id = company.company_id
                if ($_POST['ship'] == 'shipped') {
                    $sql = "SELECT * FROM cust_ord_ship_comp_view WHERE ship_status IS NOT NULL";
                } else if ($_POST['ship'] == 'null') {
                    $sql = "SELECT * FROM cust_ord_ship_comp_view WHERE ship_status IS NULL;";
                } else if ($_POST['ship'] == 'all') {
                    $sql = "SELECT * FROM cust_ord_ship_comp_view";
                }
                // SUBGYERY AND COMPLEX VIEW
                // CREATE VIEW sub_q_complex_view AS
                // SELECT CONCAT_WS(' ',customer.firstName,customer.lastName) AS namee,company.comapnyName,CONCAT_WS(' | ', orders.order_date,orders.order_time) AS dnt, shipment.ship_status, orders.order_total FROM shipment
                //     INNER JOIN orders ON shipment.shipment_id = orders.order_shippment_id
                //     INNER JOIN customer ON orders.order_customer_id = customer.customer_id
                //     INNER JOIN company ON customer.customer_company_id = company.company_id
                //     WHERE orders.order_total > (
                //     SELECT AVG(order_total) AS avgTotal FROM orders
                //     ) ORDER BY order_total DESC
                else if ($_POST['ship'] == 'avg') {
                    $sql = "SELECT * FROM sub_q_complex_view";
                }
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<table>
                            <tr>
                             <th>Customer Name</th>
                             <th>Company Name</th>
                             <th>Order Time & Date</th>
                             <th>Shippment Status</th>   
                             <th>Order Total</th>          
                             </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["namee"] . "</td>";
                        echo "<td>" . $row["comapnyName"] . "</td>";
                        echo "<td>" . $row["dnt"] . "</td>";
                        echo "<td>" . $row["ship_status"] . "</td>";
                        echo "<td>" . $row["order_total"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No results";
                }
                if ($_POST['ship'] == 'total') {
                    $sql = "SELECT SUM(order_total) AS totall FROM orders";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
                                <tr>
                                 <th>Total Profit</th>                                       
                                 </tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["totall"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No results";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>