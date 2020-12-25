<?php
require('control/emp.dbh.php');
echo "hello Green House";
$getV = "SELECT seeding_date FROM greenHouse WHERE green_house_id = 6";
// continue from here i need to show and hide boxes accordingly to the ID if null or not
$drop2 = mysqli_query($conn, $getV);
if (mysqli_num_rows($drop2) > 0) {
    while ($row = mysqli_fetch_assoc($drop2)) {
        if (is_null($row['seeding_date'])) {
            echo $row['seeding_date'] . "it is working";
            echo '<input type="text" name="planting" placeholder="planting">';
        } else {
            echo $row['seeding_date'] . "it is working";
        }
    }
}



?>
<form action="gHouse.php" method="post">
    <!-- GET ID INFORMATUON -->

    <select name="id" id="">
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
        $harv = mysqli_real_escape_string($conn, $_REQUEST['planting']);


        // $id = mysqli_real_escape_string($conn, $_REQUEST['id']);

        $sql = "UPDATE greenHouse SET 
seeding_date = '$plant', watering_date='$water',harvest_date = '$harv'
 WHERE green_house_id = '$value' ";
        if (mysqli_query($conn, $sql)) {
            echo "Records added successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }


        // Close connection
        mysqli_close($conn);




        ?>
</form>