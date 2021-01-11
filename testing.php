<?php
require('control/admin.dbh.php');
// Employee and Job Query
$sql = "SELECT employee.employee_id,CONCAT_WS(' ',employee.firstName,employee.lastName) AS empName,employee.phoneNumber,employee.email FROM employee 
            ORDER BY employee.employee_id ASC";
$result = mysqli_query($conn, $sql);

// Display employee table

if (mysqli_num_rows($result) > 0) {
    echo "<table>
                            <tr>
                            <th>Emp No</th>
                             <th>Employee Name</th>
                             <th>Current Job</th>
                             <th>Phone Number</th>
                             <th>Email</th>
                             </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["employee_id"] . "</td>";
        echo "<td>" . $row["empName"] . "</td>";
        echo "<td>" . $row["empName"] . "</td>";
        echo "<td>" . $row["phoneNumber"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No results";
}

mysqli_close($conn);
