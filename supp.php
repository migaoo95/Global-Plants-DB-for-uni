<!-- Employee access to the database  -->
<?php
require('control/admin.dbh.php');

error_reporting(E_ERROR | E_PARSE);
$check1 = $_POST['check1'];
$check2 = $_POST['check2'];
$check3 = $_POST['check3'];
$check4 = $_POST['check4'];
$check5 = $_POST['check5'];
$check6 = $_POST['check6'];
$check7 = $_POST['check7'];
$check8 = $_POST['check8'];
$sID = $_POST['sID'];
$select = $_POST['select'];

$lessMore = $_POST['lessMore'];
$amount = $_POST['amount'];
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
                    <!-- DROPDOWN SUPPLIER NAMES -->
                    <form action="supp.php" method="post" name="formm">
                        <h4>Choose what supplier information to display</h4>
                        <select name="sID" id="">
                            <option value="" disabled selected>Select all or single Supplier</option>
                            <option value="all">SHOW ALL SUPPLIERS</option>
                            <?php
                            $sql2 = "SELECT * FROM supplier WHERE supplier_id ";
                            mysqli_query($conn, $sql2);
                            $dropdown = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($dropdown) > 0) {

                                while ($row = mysqli_fetch_assoc($dropdown)) {

                            ?>
                                    <option value=<?php echo $row['supplier_id']; ?>>
                                        <?php echo $row['sup_name']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <input type="checkbox" name="check1" value="supplier.address1,">
                        <label for="check1"> Addres1</label>
                        <input type="checkbox" name="check2" value="supplier.country,">
                        <label for="check2"> Country</label>
                        <input type="checkbox" name="check3" value="supplier.city,">
                        <label for="check3"> City</label>
                        <input type="checkbox" name="check4" value="supplier.postCode,">
                        <label for="check4"> Post Code</label>
                        <input type="checkbox" name="check5" value="supplier.email,">
                        <label for="check5"> Email</label>
                        <input type="checkbox" name="check6" value="supplier.website,">
                        <label for="check6"> Website</label>
                        <input type="checkbox" name="check7" value="plants.plant_name,">
                        <label for="check7"> Products</label>
                        <input type="checkbox" name="check8" value="stockDepo.quantity,">
                        <label for="check8"> Quantity</label>
                        <input type="submit">
                        <br>
                        <hr>
                    </form>
                </div>
                <form action="supp.php" method="post">
                    <h4>Select suppliers by how much product they provide</h4>
                    <select name="lessMore" id="">
                        <option value=">">More Than</option>
                        <option value="<">Less Than</option>
                    </select>
                    <input type="text" name="amount" placeholder="Your amount">
                    <input type="submit">


            </div>
            </form>
            <?php

            if (isset($_POST['lessMore'])) {
                // CREATE VIEW supp_prod_view AS 
                // SELECT supplier.sup_name, plants.plant_name, stockDepo.quantity FROM supplier
                // INNER JOIN plants ON supplier.supplier_id = plants.plant_sup_id
                // INNER JOIN stockDepo ON plants.plant_id = stockDepo.stockDepo_id
                $sql2 = "SELECT * FROM supp_prod_view
                         WHERE quantity $lessMore= '$amount' ";
                $result = mysqli_query($conn, $sql2);
                // Display employee table

                if (mysqli_num_rows($result) > 0) {


                    echo "<table>
                                <tr>                             
                                 <th>Supplier</th>
                                 <th>Product</th>
                                 <th>Quantity</th>                             
                                 </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>";
                        echo "<td>" . $row["sup_name"] . "</td>";
                        echo "<td>" . $row["plant_name"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "</tr>";

                        if (mysqli_query($conn, $sqlInsert2)) {
                        } else {

                            // echo "SOme Error $sql. " . mysqli_error($conn);
                        }
                    }
                    echo "</table>";
                }
            }



            if (isset($_POST['sID'])) {
                $sql = "SELECT $check1 $check2 $check3 $check4 $check5 $check6 $check7 $check8 supplier.sup_name, supplier.supplier_id FROM supplier
                        INNER JOIN plants ON supplier.supplier_id = plants.plant_sup_id
                        INNER JOIN stockDepo ON plants.plant_id = stockDepo.stockDepo_id
                         WHERE supplier_id = '$sID'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>
                            <tr>
                            <th>Employee Name</th>
                           " . (isset($_POST['check1']) ? "<th>Address</th>" : "") . "
                           " . (isset($_POST['check2']) ? "<th>Country</th>" : "") . " 
                           " . (isset($_POST['check3']) ? "<th>City</th>" : "") . " 
                           " . (isset($_POST['check4']) ? "<th>Post Code</th>" : "") . " 
                           
                           " . (isset($_POST['check5']) ? "<th>Email</th>" : "") . " 
                           " . (isset($_POST['check6']) ? "<th>Website</th>" : "") . "    
                           " . (isset($_POST['check7']) ? "<th>Product</th>" : "") . "    
                           " . (isset($_POST['check8']) ? "<th>Quantity</th>" : "") . "                     
                             </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>" .
                            "<td>" . $row["sup_name"] . "</td>" .
                            (isset($_POST['check1']) ? "<td>" . $row["address1"] . "</td>" : "") .
                            (isset($_POST['check2']) ? "<td>" . $row["country"] . "</td>" : "") .
                            (isset($_POST['check3']) ? "<td>" . $row["city"] . "</td>" : "") .
                            (isset($_POST['check4']) ? "<td>" . $row["postCode"] . "</td>" : "") .
                            (isset($_POST['check5']) ? "<td>" . $row["email"] . "</td>" : "") .
                            (isset($_POST['check6']) ? "<td>" . $row["website"] . "</td>" : "") .
                            (isset($_POST['check7']) ? "<td>" . $row["plant_name"] . "</td>" : "") .
                            (isset($_POST['check8']) ? "<td>" . $row["quantity"] . "</td>" : "");
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            if ($sID === 'all') {

                $sql = "SELECT $check1 $check2 $check3 $check4 $check5 $check6 $check7 $check8 supplier.sup_name, supplier.supplier_id FROM supplier
                        INNER JOIN plants ON supplier.supplier_id = plants.plant_sup_id
                        INNER JOIN stockDepo ON plants.plant_id = stockDepo.stockDepo_id";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>
                            <tr>
                            <th>Employee Name</th>
                           " . (isset($_POST['check1']) ? "<th>Address</th>" : "") . "
                           " . (isset($_POST['check2']) ? "<th>Country</th>" : "") . " 
                           " . (isset($_POST['check3']) ? "<th>City</th>" : "") . " 
                           " . (isset($_POST['check4']) ? "<th>Post Code</th>" : "") . "                           
                           " . (isset($_POST['check5']) ? "<th>Email</th>" : "") . " 
                           " . (isset($_POST['check6']) ? "<th>Website</th>" : "") . "    
                           " . (isset($_POST['check7']) ? "<th>Product</th>" : "") . "    
                           " . (isset($_POST['check8']) ? "<th>Quantity</th>" : "") . "                     
                             </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>" .
                            "<td>" . $row["sup_name"] . "</td>" .
                            (isset($_POST['check1']) ? "<td>" . $row["address1"] . "</td>" : "") .
                            (isset($_POST['check2']) ? "<td>" . $row["country"] . "</td>" : "") .
                            (isset($_POST['check3']) ? "<td>" . $row["city"] . "</td>" : "") .
                            (isset($_POST['check4']) ? "<td>" . $row["postCode"] . "</td>" : "") .
                            (isset($_POST['check5']) ? "<td>" . $row["email"] . "</td>" : "") .
                            (isset($_POST['check6']) ? "<td>" . $row["website"] . "</td>" : "") .
                            (isset($_POST['check7']) ? "<td>" . $row["plant_name"] . "</td>" : "") .
                            (isset($_POST['check8']) ? "<td>" . $row["quantity"] . "</td>" : "");
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                mysqli_close($conn);
            }

            ?>


        </div>






    </div>
    </div>
    </div>
    </div>

</body>