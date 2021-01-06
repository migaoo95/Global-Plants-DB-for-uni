<?php
require('control/admin.dbh.php');

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
                    <form action="stockA.php" method="post">
                        <select name="stockA" id="">
                            <option value="" disabled selected>Managment Options</option>
                            <option value="all">Show All Stock</option>
                            <option value="totalV">Total Stock Value</option>
                            <option value="supP">Supplier Pricing</option>
                            <option value="gHouse">Green House Procuts</option>
                        </select>

                        <input type="submit">
                    </form>
                    <?php
                    if ($_POST['stockA'] == 'gHouse') {
                        $sql = "SELECT plants.plant_name, plants.plant_unit_price,greenHouse.harvest_date FROM  greenHouse
                        INNER JOIN plants ON greenHouse.green_house_id = plants.plant_gHouse_id
                        ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                <tr>
                 <th>Plant Name</th>
                 <th>Unit Price</th>
                 <th>Harvest Date</th>                                    
                 </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["plant_name"] . "</td>";
                                echo "<td>" . $row["plant_unit_price"] . "</td>";
                                echo "<td>" . $row["harvest_date"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($conn);
                        }
                    }
                    if ($_POST['stockA'] == 'supP') {
                        // $sql = "SELECT plant_name,plant_unit_price FROM plants";
                        // CREATE VIEW plant_supp_view AS 
                        // SELECT plants.plant_name,plants.plant_unit_price,supplier.sup_name AS supps FROM stockDepo
                        // LEFT JOIN plants ON stockDepo.stock_plant_id = plants.plant_id
                        // LEFT JOIN supplier ON plants.plant_sup_id = supplier.supplier_id WHERE sup_name IS NOT NULL
                        $sql = "SELECT * FROM plant_supp_view";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                <tr>
                 <th>Plant Name</th>
                 <th>Unit Price</th>
                 <th>Supplied By</th>
                                     
                 </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["plant_name"] . "</td>";
                                echo "<td>" . $row["plant_unit_price"] . "</td>";
                                echo "<td>" . $row["supps"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($conn);
                        }
                    }
                    if ($_POST['stockA'] == 'all') {
                        $sql = "SELECT plants.plant_name, stockDepo.quantity,COALESCE(supplier.sup_name, 'GreenHouse') AS supps  FROM stockDepo
                        LEFT JOIN plants ON stockDepo.stock_plant_id = plants.plant_id
                        LEFT JOIN supplier ON plants.plant_sup_id = supplier.supplier_id";
                    }
                    if ($_POST['stockA'] == 'totalV') {
                        // CREATE VIEW complex_view_stock AS
                        // SELECT SUM(stockDepo.quantity* stockDepo.unit_retail_price) AS price FROM stockDepo 
                        // INNER JOIN plants ON stockDepo.stock_plant_id = plants.plant_id
                        $sql = "SELECT * FROM complex_view_stock";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                    <tr>
                     <th>Stock Value</th>             
                     </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($conn);
                        } else {
                            echo "No results";
                        }
                    }

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<table>
                <tr>
                 <th>Plant Name</th>
                 <th>Quantity</th>
                 <th>Supplier By</th>                       
                 </tr>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["plant_name"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["supps"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>