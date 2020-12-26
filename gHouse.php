<?php
require('control/emp.dbh.php');
echo "hello Green House";

?>
<form action="gHouse.php" method="post">
    <!-- GET ID INFORMATUON -->

    <select name="id" id="ss">
        <?php
        require('control/emp.dbh.php');
        // Query to populate dropdown
        $get_make = "SELECT green_house_id FROM greenHouse WHERE seeding_date IS NULL OR watering_date IS NULL OR harvest_date IS NULL;";

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

        <input type="text" name="planting" placeholder="planting">
        <input type="text" name="watering" placeholder="watering">
        <input type="text" name="harvest" placeholder="harvesting">
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
            echo "Records added successfully.";
        } else {

            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }


        // Close connection
        // mysqli_close($conn);




        ?>
</form>
<!-- OUTPUT DATA***************************** -->
<?php
//Procedural myqli

// Sql query 
$query = "SELECT * FROM greenHouse";
// Run query
$result2 = mysqli_query($conn, $query);
//Output result
if (mysqli_num_rows($result2) > 0) {
    // Define Table 
    echo "<table>
          <tr>
          <td>ID </td>
          <td>Seeding Date</td>
          <td>Watering Date</td>
          <td>Harvest Date</td>

          </tr>";
    while ($roww = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>" . $roww["green_house_id"] . "</td>";
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
