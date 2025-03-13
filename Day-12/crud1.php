<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "paymentapp";

    $conn = mysqli_connect($servername, $username, $password, $db);
    if($conn){
        echo "The DB is connected Successfully<br>";
    }else{
        echo "The DB is not connected successfully<br>" . $mysqli_connect_error();
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Management</title>
        <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <style>
            /* General Styling */
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                background: linear-gradient(135deg, #74ebd5, #acb6e5);
                margin: 0;
                padding: 20px;
            }

            /* Title */
            h1 {
                color: #333;
                font-size: 28px;
                margin-bottom: 20px;
            }

            /* Buttons */
            button {
                padding: 10px 20px;
                margin: 10px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: 0.3s ease-in-out;
            }

            #addUserBtn {
                background: #28a745;
                color: white;
            }

            #addUserBtn:hover {
                background: #218838;
            }

            .btn-edit {
                background: #ffc107;
                color: black;
            }

            .btn-edit:hover {
                background: #e0a800;
            }

            .btn-delete {
                background: #dc3545;
                color: white;
            }

            .btn-delete:hover {
                background: #c82333;
            }

            /* Table Styling */
            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
                background: white;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            th, td {
                padding: 12px;
                text-align: center;
                border-bottom: 1px solid #ddd;
            }

            th {
                background: #007bff;
                color: white;
            }

            tr:hover {
                background: #f1f1f1;
            }

            /* Popup Modal */
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }

            .pop {
                background: white;
                padding: 20px;
                border-radius: 8px;
                text-align: center;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            }

            #popup {
                font-size: 22px;
                margin-bottom: 10px;
            }

            input[type="text"], input[type="email"] {
                width: 90%;
                padding: 8px;
                margin: 10px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            #closeModal {
                background: #dc3545;
                color: white;
            }

            #closeModal:hover {
                background: #c82333;
            }
        </style>
    </head>
    <body>
        <h1> Welcome To User Management System</h1>
        <button id="addUserBtn">Add Yourself From Here</button>
        <div class="overlay"> 
            <div class="pop" id="userpop">
                <h2 id="popup">Add Your Details</h2>
                <form id="userForm" method="POST" action="">
                    <input type="hidden" id="userId">
                    <label>Name:</label>
                    <input type="text" id="name" name="name" ><br>
                    <label>Email:</label>
                    <input type="email" id="email" name="email" ><br>
                    <label>City:</label>
                    <input type="text" id="city" name="city" ><br>
                    <button type="submit">Submit</button>
                    <button type="button" id="closeModal">Close</button>
                </form>
            </div>
        </div>
        <script>
             $(document).ready(function () {
                // Custom Validation Rules
                $.validator.addMethod("validString", function (value, element) {
                    return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
                }, "The field must contain only letters.");

                $.validator.addMethod("validEmail", function (value, element) {
                    return this.optional(element) || /^\S+@\S+\.\S+$/.test(value);
                }, "Enter a valid email address.");

                $.validator.addMethod("validCity", function (value, element) {
                    return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
                }, "City name should contain only letters.");

                // Form Validation
                $("#userForm").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 4,
                            validString: true
                        },
                        email: {
                            required: true,
                            validEmail: true
                        },
                        city: {
                            required: true,
                            minlength: 2,
                            validCity: true
                        }
                    },
                    messages: {
                        name: {
                            required: "Name is required",
                            minlength: "It should be a minimum of 4 characters"
                        },
                        email: {
                            required: "Email is required",
                            validEmail: "Enter a valid email address"
                        },
                        city: {
                            required: "City is required",
                            minlength: "It should be a minimum of 2 characters",
                            validCity: "City should contain only letters"
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });

                // Show modal on "Add User" button click
                $("#addUserBtn").click(function () {
                    $(".overlay").fadeIn();
                    $("#popup").text("Add Your Details");
                    $("#userForm")[0].reset();
                    $("#userId").val(""); // Clear hidden ID field (for new user)
                });

                // Close modal on "Close" button click
                $("#closeModal").click(function () {
                    $(".overlay").fadeOut();
                });

                // Edit Button Functionality
                $(document).on("click", ".btn-edit", function () {
                    let row = $(this).closest("tr");
                    let userId = $(this).data("id");

                    // Populate the form fields
                    $("#userId").val(userId);
                    $("#name").val(row.find("td:eq(1)").text());
                    $("#email").val(row.find("td:eq(2)").text());
                    $("#city").val(row.find("td:eq(3)").text());

                    // Update modal title
                    $("#popup").text("Edit Your Details");

                    // Show modal
                    $(".overlay").fadeIn();
                });

                // Delete Button Functionality
                $(document).on("click", ".btn-delete", function () {
                    let userId = $(this).data("id");
                    if (confirm("Are you sure you want to delete this user?")) {
                        // Create a hidden form to submit the delete request
                        let form = $('<form method="POST"></form>');
                        form.append('<input type="hidden" name="user_id" value="' + userId + '">');
                        form.append('<input type="hidden" name="delete_user" value="true">');
                        $('body').append(form);
                        form.submit();
                    }
                });
            });

        </script>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = htmlspecialchars(trim($_POST["name"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $city = htmlspecialchars(trim($_POST["city"]));
                $userId = isset($_POST["user_id"]) ? intval($_POST["user_id"]) : null;
                $errors = [];
    
            if (empty($name) || strlen($name) < 4){
                $errors["name"] = "Name is required minimum of 4 char";
            }
    
            //Email Validation
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errosr["email"] = "Email is required";
            } 
            else {
                // Check if email already exists
                if($userId == 0) {
                    $stmt = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        $errors["email"] = "This email is already registered";
                    }
                    $stmt->close();
                }
            }
            if (empty($errors)) {
                if ($userId > 0) {
                    // **Update Existing User**
                    $stmt = $conn->prepare("UPDATE users SET Name=?, Email=?, City=? WHERE User_ID=?");
                    $stmt->bind_param("sssi", $name, $email, $city, $userId);
                } else {
                    // **Insert New User**
                    $stmt = $conn->prepare("INSERT INTO users (Name, Email, City) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $name, $email, $city);
                }
        
                if ($stmt->execute()) {
                    echo "<p style='color: green;'>Operation successful!</p>";
                } else {
                    echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
                }
                $stmt->close();
            } else {
                foreach ($errors as $error) {
                    echo "<p style='color: red;'>$error</p>";
                }
            }
        }
            //For Deleting the user
            if(isset($_POST['user_id'])) {
                $id = $_POST['user_id'];
                
                // Secure the query
                $stmt = $conn->prepare("DELETE FROM users WHERE User_ID = ?");
                $stmt->bind_param("i", $id);
            
                if($stmt->execute()){
                    echo "User deleted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                
                $stmt->close();
                $conn->close();
            }
        ?>
        <table>
            <tr>
                <th>Created At</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tbody id="userTableBody"></tbody>
        
        <?php
            $sql1 = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "<td>";
                    echo "<button class='btn btn-edit' data-id='" . $row['User_ID'] . "'>Edit</button>";
                    echo "<button class='btn btn-delete' data-id='" . $row['User_ID'] . "'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }else{
                echo "No records found";
            }
            $conn->close();
        ?>
        </table>
    </body>
</html>        