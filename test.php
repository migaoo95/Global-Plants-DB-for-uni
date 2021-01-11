<?php
require('control/emp.dbh.php');
echo "hello Green House";
$value = $_POST['id'];
$get_make = "SELECT green_house_id FROM greenHouse WHERE seeding_date IS NULL OR watering_date IS NULL OR harvest_date IS NULL;";
$getV = "SELECT seeding_date,watering_date,harvest_date FROM greenHouse WHERE green_house_id = $value";

$id = mysqli_real_escape_string($conn, $_REQUEST['id']);

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
<form action="gHouse.php" method="post" id="formm" onchange="change()">
    <!-- GET ID INFORMATUON -->

    <select name="id" id="">

        <?php
        require('control/emp.dbh.php');
        // Query to populate dropdown



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
    </select>
    <input type="submit" name="" id="" value="submit">
</form>
<?php
$drop2 = mysqli_query($conn, $getV);
if (mysqli_num_rows($drop2) > 0) {
    while ($row = mysqli_fetch_assoc($drop2)) {
        if (is_null($row['seeding_date'])) {



            echo '<input type="text" name="planting" placeholder="planting" value="NULL">';
        } else {
            echo 'Seeding NOT NULL ';
        }
        if (is_null($row['watering_date'])) {

            echo '<input type="text" name="watering" placeholder="watering"value="NULL">';
        } else {
            echo $row['watering_date'];
        }
        if (is_null($row['harvest_date'])) {

            echo '<input type="text" name="harvest" placeholder="harvesting">';
        } else {
            $harv = "2001-02-02";
            echo "Harvest NOT NULL ";
        }
    }
}

$plant = mysqli_real_escape_string($conn, $_REQUEST['planting']);
$water = mysqli_real_escape_string($conn, $_REQUEST['watering']);
$harv = mysqli_real_escape_string($conn, $_REQUEST['harvest']);


?>
<script>
    function change() {
        document.getElementById('formm').submit();
    }
</script>
<?php
// require('control/emp.dbh.php');
// // Query to populate dropdown


// $value = $_POST['id'];
// $dropdown = mysqli_query($conn, $get_make);

// if (mysqli_num_rows($dropdown) > 0) {
//     while ($row = mysqli_fetch_assoc($dropdown)) {
?>

<?php
//     }
// }
?>

<!-- <input type="text" name="planting" placeholder="planting">
        <input type="text" name="watering" placeholder="watering">
        <input type="text" name="harvest" placeholder="harvesting"> -->



<?php


// TOP ONE IS OLDER BOTTOM IS NEWER


<?php
require('control/emp.dbh.php');
echo "hello Green House";
$value = $_POST['id'];


session_start();
$_SESSION['id'] = $_POST['id'];
// session_reset();
echo  $_SESSION['id'] . "<<<<<<<<";
if ($_SESSION['id'] == "0") {
    $man = $_SESSION['id'];

    echo $man . "******THIS ONE****";
    session_reset();
}

$getV = "SELECT seeding_date FROM greenHouse WHERE green_house_id = '$value'";
// continue from here i need to show and hide boxes accordingly to the ID if null or not
$drop2 = mysqli_query($conn, $getV);
if (mysqli_num_rows($drop2) > 0) {
    while ($row = mysqli_fetch_assoc($drop2)) {
        if (is_null($row['seeding_date'])) {
            echo $row['seeding_date'] . "it is working";
            $dupa = $row['seeding_date'];
            echo '<input type="text" id="input" name="planting" placeholder="planting" value="' . $dupa . '">';
        } else {
            echo $row['seeding_date'] . "it is working";
            $dupa = $row['seeding_date'];
            echo $dupa . "this is dupa";
        }
    }
}



?>
<form action="gHouse.php" method="post" id="formm">
    <!-- GET ID INFORMATUON -->

    <select name="id" id="id" onchange="change()" method="get">
        <option value="0"></option>
        <?php
        // session_start();
        require('control/emp.dbh.php');
        // Query to populate dropdown
        $get_make = "SELECT green_house_id FROM greenHouse WHERE seeding_date IS NULL OR watering_date IS NULL OR harvest_date IS NULL;";

        $value = $_POST['id'];


        $dropdown = mysqli_query($conn, $get_make);

        if (mysqli_num_rows($dropdown) > 0) {
            // $_SESSION['id'] = $row['green_house_id'];
            while ($row = mysqli_fetch_assoc($dropdown)) {

        ?>
                <option value=<?php echo $row['green_house_id']; ?>>
                    <?php echo $row['green_house_id']; ?>
                </option>
        <?php
            }
        }

        ?>
        <?php

        ?>


        <!-- type=" text" name="planting" placeholder="planting" -->
        <?php echo '<input type="text" name="planting" placeholder="planting" value="' . $dupa . '">' ?>
        <input type="text" name="watering" placeholder="watering">
        <input type="text" name="harvest" placeholder="harvesting">
        <input type="submit" name="" id="" value="submit">


        <?php
        $plant = mysqli_real_escape_string($conn, $_REQUEST['planting']);
        $water = mysqli_real_escape_string($conn, $_REQUEST['watering']);
        $harv = mysqli_real_escape_string($conn, $_REQUEST['planting']);







        ?>
</form>

<form action="gHouse.php" method="post">

    <?php

    $sesia = $_SESSION['id'];
    // $id = mysqli_real_escape_string($conn, $_REQUEST['id']);

    $sql = "UPDATE greenHouse SET 
seeding_date = '$plant', watering_date='$water',harvest_date = '$harv'
 WHERE green_house_id = '$sesia' ";
    if (mysqli_query($conn, $sql)) {
        echo "Records added successfully.";


        echo  $_SESSION['id'] . "<<<<this is session";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }


    // Close connection
    mysqli_close($conn);

    ?>
</form>
<script>
    function change() {
        document.getElementById('formm').submit();
        var out = document.getElementById('store');
        var value = document.getElementById('id').value;
        localStorage.setItem("jeden", value);
        out.textContent = localStorage.getItem("jeden", value);

    }
</script>
<p id="store">storestorestorestorestore</p>






?>
</form>