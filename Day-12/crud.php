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
    if (isset($_POST['user_id']) && isset($_POST['delete_user'])) {
        $id = intval($_POST['user_id']); // Ensure integer
        $stmt = $conn->prepare("DELETE FROM users WHERE User_ID = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo "User deleted successfully!";
        } else {
            echo "Error: User not found or already deleted.";
        }
    
        $stmt->close();
        exit(); // Stop further execution
    }
    
    // Handle User Insertion and Editing
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {
        $name = htmlspecialchars(trim($_POST["name"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $city = htmlspecialchars(trim($_POST["city"]));
        $user_id = isset($_POST["user_id"]) ? intval($_POST["user_id"]) : null;
        $errors = [];
    
        // Validation
        if (empty($name) || strlen($name) < 4) {
            $errors["name"] = "Name is required and must be at least 4 characters.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Valid email is required.";
        } else {
            $stmt = $conn->prepare("SELECT Email FROM users WHERE Email = ? AND User_ID != ?");
            $stmt->bind_param("si", $email, $user_id);
            $stmt->execute();
            $stmt->store_result();
    
            if ($stmt->num_rows > 0) {
                $errors["email"] = "This email is already registered.";
            }
            $stmt->close();
        }
    
        if (empty($errors)) {
            if ($user_id) {
                // Update User
                $stmt = $conn->prepare("UPDATE users SET Name = ?, Email = ?, City = ? WHERE User_ID = ?");
                $stmt->bind_param("sssi", $name, $email, $city, $user_id);
                $msg = "User updated successfully!";
            } else {
                // Insert New User
                $stmt = $conn->prepare("INSERT INTO users (Name, Email, City) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, $city);
                $msg = "User added successfully!";
            }
    
            if ($stmt->execute()) {
                echo "<p style='color: green;'>$msg</p>";
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

            .modal {
                background: white;
                padding: 20px;
                border-radius: 8px;
                text-align: center;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            }

            #modalTitle {
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
            <div class="modal">
                <h2 id="modalTitle">Add User</h2>
                <form id="userForm" method="POST">
                    <input type="hidden" id="userId" name="user_id">
                    <label>Name:</label> <input type="text" id="name" name="name"><br>
                    <label>Email:</label> <input type="email" id="email" name="email"><br>
                    <label>City:</label> <input type="text" id="city" name="city"><br>
                    <button type="submit">Submit</button>
                    <button type="button" id="closeModal">Close</button>
                </form>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th> 
                <th>Name</th> 
                <th>Email</th> 
                <th>City</th> 
                <th>Actions</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM users");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['User_ID']}</td>";
                echo "<td>{$row['Name']}</td>";
                echo "<td>{$row['Email']}</td>";
                echo "<td>{$row['City']}</td>";
                echo "<td>";
                echo "<button class='btn-edit' data-id='{$row['User_ID']}' data-name='{$row['Name']}' data-email='{$row['Email']}' data-city='{$row['City']}'>Edit</button>";
                echo "<button class='btn-delete' data-id='{$row['User_ID']}'>Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <script>
             $(document).ready(function () {
                $("#addUserBtn").click(function () {
                    $("#userForm")[0].reset();
                    $("#modalTitle").text("Add User");
                    $("#userId").val("");
                    $(".overlay").fadeIn();
                });

                $("#closeModal").click(function () {
                    $(".overlay").fadeOut();
                });

                $(".btn-edit").click(function () {
                    $("#modalTitle").text("Edit User");
                    $("#userId").val($(this).data("id"));
                    $("#name").val($(this).data("name"));
                    $("#email").val($(this).data("email"));
                    $("#city").val($(this).data("city"));
                    $(".overlay").fadeIn();
                });

                $(".btn-delete").click(function () {
                    let userId = $(this).data("id");
                    if (confirm("Are you sure you want to delete this user?")) {
                        $.post("", { user_id: userId, delete_user: true }, function (response) {
                            location.reload();
                        });
                    }
                });

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
                        }
                    },
                    submitHandler: function (form) {
                        form.submit();
                    }
                });

                
            });

        </script>
    </body>
</html>        