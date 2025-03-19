<?php
    include '../Day-14/dbconnect.php';
    if (isset($_POST['id']) && isset($_POST['delete_user'])) {
        $id = intval($_POST['id']); // Ensure integer
        $stmt = $conn->prepare("DELETE FROM employee WHERE Employee_ID = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo "User deleted successfully!";
        } else {
            echo "Error: User not found or already deleted.";
        }
    
        $stmt->close();
        exit(); // Stop further execution
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['name'], $_POST['age'], $_POST['city'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $city = $_POST['city'];

        $sql1 = "UPDATE employee SET Name=?, Age=?, City=? WHERE Employee_ID=?";
        $stmt = $conn->prepare($sql1);
        $stmt->bind_param("sisi", $name, $age, $city, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <style>
            /* General Styles */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 20px;
                text-align: center;
            }

            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
                background: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            th, td {
                padding: 12px;
                border: 1px solid #ddd;
                text-align: center;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }

            td {
                background-color: #fff;
            }

            button {
                padding: 8px 12px;
                margin: 5px;
                border: none;
                cursor: pointer;
                font-size: 14px;
                border-radius: 5px;
            }

            .edit {
                background-color: #ffc107;
                color: black;
            }

            .delete {
                background-color: #dc3545;
                color: white;
            }

            /* Modal Styles */
            #modal {           
                position: fixed;               
                display: none; /* Add this */
                justify-content: center;
                align-items: center;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
            }

            #modal-content {
                background: white;
                padding: 20px;
                border-radius: 10px;
                width: 300px;
                text-align: left;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                margin: auto;
                position: relative;
            }

            input {
                width: 100%;
                padding: 8px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            #submit {
                background-color: #28a745;
                color: white;
                width: 100%;
            }

            #close {
                background-color: #6c757d;
                color: white;
                width: 100%;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql= "SELECT * FROM employee";
                $res = mysqli_query($conn, $sql);
                if($res->num_rows > 0){
                    foreach($res as $row){
                        echo "<tr>
                        <td>" . $row['Employee_ID'] . "</td>
                        <td>" . $row['Name'] . "</td>
                        <td>" . $row['Age'] . "</td>
                        <td>" . $row['City'] . "</td>
                        <td>
                        <button class=edit data-id='{$row["Employee_ID"]}' data-name='{$row["Name"]}' data-age='{$row["Age"]}' data-city='{$row["City"]}'>Update</button>
                        <button class=delete data-id='{$row["Employee_ID"]}'>Delete</button>
                        </td>
                        </tr>";
                    }
                }else{
                    echo "<strong>No Data Found</strong>";
                }
                $conn->close();
            ?>
        </table>
        <div id="modal">
            <div id="modal-content">
                <input type="hidden" id="id" name="id">
                Name: <input type="text" id="name" name="name"><br>
                Name: <input type="number" id="age" name="age"><br>
                City: <input type="text" id="city" name="city"><br>
                <button id=submit type="button">Submit</button>
                <button type="button" id="close">Close</button>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $(document).on('click', '.edit', function(){
                    // $("#modal").css("display", "flex");                
                    $("#modal").show();
                    
                    var id = $(this).data('id'); //extract the value from DB on click of update button using ID as unique
                    var name = $(this).data('name'); // 
                    var age = $(this).data('age');
                    var city = $(this).data('city');

                    $("#id").val(id);   //sets the value to the modal that is extracted from the DB using Update button.
                    $("#name").val(name); 
                    $("#age").val(age);
                    $("#city").val(city);

                });

                $(document).on('click', '#submit', function (e) {
                        e.preventDefault();

                        var id = $("#id").val();          // It is use to get the data from #modal-id and to store into variable id.
                        var name = $("#name").val();     // It is use to get the data from #modal-name and to store into variable name.
                        var age = $("#age").val();      // It is use to get the data from #modal-age and to store into variable age.
                        var city = $("#city").val();
                });

                $(document).on('click', '.delete', function(){
                    var id = $(this).data('id');
                    $.post("", { id: id, delete_user: true }, function (response) {
                            location.reload();
                            alert("The User Deleted Successfully");
                        });
                })

                $(document).on('click', '#close', function(){
                    $("#modal").hide();
                });
            });

        </script>

    </body>
    </html>