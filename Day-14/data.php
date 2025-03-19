<?php
include "dbconnect.php";
$sql = "SELECT * FROM employee";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
            <td>" .$row['Employee_ID'] . "</td>
            <td>" .$row['Name'] . "</td>
           <td>" .$row['Age'] . "</td>
            <td>" .$row['City'] . "</td>
            <td><button class='edit' data-id='{$row["Employee_ID"]}' data-name='{$row["Name"]}' data-age='{$row["Age"]}' data-city='{$row["City"]}'>EDIT</button> 
            <button class='delete' data-id='{$row["Employee_ID"]}'>DELETE</button>
            </td>
         </tr>";
}
} else {
    echo "<tr><td colspan='3'>No data found</td></tr>";
}
?>
    