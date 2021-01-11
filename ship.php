<!-- Employee access to the database  -->
<?php
error_reporting(E_ERROR | E_PARSE);

use function PHPSTORM_META\elementType;

require('control/emp.dbh.php');
echo "hello emp";
// error_reporting(E_ERROR | E_PARSE);
// Get the form value

//Clean any special characters 

//SQL query
// $sql = "SELECT * FROM employee WHERE firstName LIKE '$employee%';";
// CREATE VIEW orders_shippment_emp_view AS 
// SELECT orders.order_id AS orderNumber,CONCAT_WS(' ', customer.firstName,customer.lastName) AS customerName,
// orders.order_date,orders.order_time , shipment.ship_status,shipment.ship_date,
// shipment.ship_time, shipment.shipment_id FROM company INNER JOIN customer ON company.company_id = customer.customer_company_id
// INNER JOIN orders ON customer.customer_id = orders.order_customer_id INNER JOIN shipment ON orders.order_shippment_id = shipment.shipment_id
$sql = "SELECT * FROM orders_shippment_emp_view  ";
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
                    <form action="ship.php" method="post" name="formm">
                        <select name="id" id="ss">
                            <?php
                            //  SAME VIEW 
                            $sql2 = "SELECT * FROM orders_shippment_emp_view WHERE ship_status IS NULL AND ship_date IS NULL";
                            $dropdown = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($dropdown) > 0) {
                                while ($row = mysqli_fetch_assoc($dropdown)) {
                            ?>
                                    <option value=<?php echo $row['shipment_id']; ?>>
                                        <?php echo $row['shipment_id']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>

                        Double click to confirm
                        <input type="submit">
                    </form>
                    <!-- Display data  -->
                    <?php



                    if (isset($_POST['id'])) {
                        $value = $_POST['id'];
                        $date = date("Y-m-d");
                        $time = date("H:i:s");
                        $date = mysqli_real_escape_string($conn, $date);
                        $sql3 = "UPDATE shipment SET ship_status='shipped',
        ship_date='$date',ship_time = '$time'
        WHERE shipment_id = '$value'";
                        mysqli_query($conn, $sql3);
                        mysqli_close($conn);
                    }


                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
                        <tr>
                            <th>Order No.</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Order Time</th>
                            <th>Shippment Status</th>
                            <th>Shippment Date</th>
                            <th>Shippment Time</th>
                            ";

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "
                        <tr>";
                            echo "<td>" . $row["orderNumber"] . "</td>";
                            echo "<td>" . $row["customerName"] . "</td>";
                            echo "<td>" . $row["order_date"] . "</td>";
                            echo "<td>" . $row["order_time"] . "</td>";
                            echo "<td>" . $row["ship_status"] . "</td>";
                            echo "<td>" . $row["ship_date"] . "</td>";
                            echo "<td>" . $row["ship_time"] . "</td>";
                            echo "</tr>";
                        }
                        echo "
                    </table>";
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