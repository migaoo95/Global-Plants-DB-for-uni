<?php
require('control/emp.dbh.php');
echo "hello Green House";
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
        <a href="nav.php"><input type="button" value="Go back" style="float:right; color:red;"></a>
        <h1 class="h1">Global Plants</h1>
        <h6>Please select a plant id and insert details of complete shift</h6>
        <div class="span">
            <span style="padding-right: 120px; padding-left:35px;">Seeding</span><span style="display: inline;padding-right:110px;">Watering</span><span>Harvesting</span>
        </div>

        <div class="row">
            <div class="col-xl">
                <div class="form">
                    <form action="gHouse.php" method="post">
                        <!-- GET ID INFORMATUON -->

                        <select name="id" id="ss">
                            <?php
                            require('control/emp.dbh.php');
                            // Query to populate dropdown
                            // VIEWS
                            // CREATE VIEWS g_house_id_view AS 
                            // SELECT green_house_id FROM greenHouse WHERE seeding_date IS NULL OR watering_date IS NULL OR harvest_date IS NULL;
                            $get_make = "SELECT * FROM g_house_id_view;";

                            $value = $_POST['id'];
                            $dropdown = mysqli_query($conn, $get_make);

                            if (mysqli_num_rows($dropdown) > 0) {
                                while ($row = mysqli_fetch_assoc($dropdown)) {
                            ?>
                                    <option value=<?php echo $row['green_house_id']; ?>>
                                        <?php echo $row['green_house_id']; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>

                            <input type="date" name="planting" id="planting" placeholder="planting">
                            <input type="date" name="watering" placeholder="watering">
                            <input type="date" name="harvest" placeholder="harvesting">
                            <input type="submit" name="" id="" value="submit">


                            <?php
                            $plant = mysqli_real_escape_string($conn, $_REQUEST['planting']);
                            $water = mysqli_real_escape_string($conn, $_REQUEST['watering']);
                            $harv = mysqli_real_escape_string($conn, $_REQUEST['harvest']);
                            // $plant = !empty($_REQUEST['planting']) ? "'" . $mysqli->real_escape_string($_REQUEST['planting']) . "'" : NULL;


                            // $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
                            if (empty($plant)) {
                                $sql = "UPDATE greenHouse SET 
         watering_date='$water',harvest_date = '$harv'
         WHERE green_house_id = '$value' ";
                            }
                            if (empty($water)) {
                                $sql = "UPDATE greenHouse SET 
            seeding_date = '$plant',harvest_date = '$harv'
            WHERE green_house_id = '$value' ";
                            }
                            if (empty($harv)) {
                                $sql = "UPDATE greenHouse SET 
         seeding_date = '$plant',watering_date='$water'
         WHERE green_house_id = '$value' ";
                            }
                            if (empty($water) && empty($plant)) {
                                $sql = "UPDATE greenHouse SET 
         harvest_date = '$harv'
         WHERE green_house_id = '$value' ";
                            }
                            if (empty($water) && empty($harv)) {
                                $sql = "UPDATE greenHouse SET 
          seeding_date = '$plant'
         WHERE green_house_id = '$value' ";
                            }
                            if (empty($plant) && empty($harv)) {
                                $sql = "UPDATE greenHouse SET 
          watering_date='$water'
         WHERE green_house_id = '$value' ";
                            }
                            if (mysqli_query($conn, $sql)) {
                                // echo "Records added successfully.";
                            } else {

                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                            }


                            // Close connection
                            // mysqli_close($conn);




                            ?>
                    </form>
                    <!-- OUTPUT DATA***************************** -->
                    <?php
                    //G HOUSE VIEW ALL
                    // CREATE VIEW gHouse_all_view AS
                    // SELECT greenHouse.green_house_id,greenHouse.seeding_date,greenHouse.watering_date,greenHouse.harvest_date, plants.plant_name FROM greenHouse
                    // INNER JOIN plants ON greenHouse.green_house_id = plants.plant_gHouse_id ORDER BY greenHouse.green_house_id ASC
                    // Sql query 
                    $query = "SELECT * FROM gHouse_all_view";
                    // Run query
                    $result2 = mysqli_query($conn, $query);
                    //Output result
                    if (mysqli_num_rows($result2) > 0) {
                        // Define Table 
                        echo "<table>
          <tr>
          <th>Plant ID</th>
          <th>Plant Name </th>
          <th>Seeding Date</th>
          <th>Watering Date</th>
          <th>Harvest Date</th>

          </tr>";
                        while ($roww = mysqli_fetch_assoc($result2)) {
                            echo "<tr>";
                            echo "<td>" . $roww["green_house_id"] . "</td>";
                            echo "<td>" . $roww["plant_name"] . "</td>";
                            echo "<td>" . $roww["seeding_date"] . "</td>";
                            echo "<td>" . $roww["watering_date"] . "</td>";
                            echo "<td>" . $roww["harvest_date"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No results found!";
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>