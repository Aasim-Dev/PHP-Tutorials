<?php
include "dbconnect.php";
$sql = "SELECT * FROM employee";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
            <td>" .$row['Name'] . "</td>
           <td>" .$row['Age'] . "</td>
            <td>" .$row['City'] . "</td>
         </tr>";
}
} else {
    echo "<tr><td colspan='3'>No data found</td></tr>";
}
?>
    