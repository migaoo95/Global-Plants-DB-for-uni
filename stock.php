<!-- Employee access to the database  -->
<?php
require('control/emp.dbh.php');
echo "hello emp";
error_reporting(E_ERROR | E_PARSE);
// Get the form value
$plant = $_POST["name"];
//Clean any special characters 
$plant = mysqli_real_escape_string($conn, $plant);
//SQL query
// $sql = "SELECT * FROM employee WHERE firstName LIKE '$employee%';";
$sql = "SELECT plants.plant_name,stockDepo.quantity,stockDepo.unit_retail_price FROM plants
INNER JOIN stockDepo ON plants.plant_id = stockDepo.stockDepo_id WHERE plants.plant_name LIKE '$plant%'";
$sql2 = "SELECT SUM(stockDepo.quantity) AS quantityy FROM stockDepo";
// Store my results
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
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
        <!-- <button  class="" id="btn" style="float: right;">Menu</button> -->


        <!-- Row One -->
        <div class=" row">
            <!-- collumn one -->
            <div class="col-xl">
                <div class="form">
                    <form action="stock.php" method="post">
                        <input type="text" name="name" class="form" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter plant name">
                        <input type="submit" value="Submit / Refresh"></br>
                    </form>
                    <!-- Display data  -->
                    <?php
                    // if post is sent
                    if (isset($_POST['name'])) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<table>
                            <tr>
                             <th>Plant Name</th>
                             <th>Quantity</th>
                             <th>Retail Price</th>
                             </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["plant_name"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["unit_retail_price"] . "</td>";
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
     <th>Plant Name</th>
     <th>Quantity</th>
     <th>Retail Price</th>
     </tr>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["plant_name"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["unit_retail_price"] . "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo "No results";
                        }
                        if (mysqli_num_rows($result2) > 0) {

                            while ($roww = mysqli_fetch_assoc($result2)) {
                                echo "<div style='border:solid;width:200px;height:30px;background-color:#32a0a8;margin:10px;'>" . "<p> Total Plants in Stock " .
                                    $roww["quantityy"] . "</p>" . "</div>";
                            }
                        }
                        mysqli_close($conn);
                    }


                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>