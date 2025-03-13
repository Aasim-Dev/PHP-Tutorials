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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Form</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .overlay-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .popup-box {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            width: 320px;
            text-align: center;
            opacity: 0;
            transform: scale(0.8);
            animation: fadeInUp 0.5s ease-out forwards;
        }

        #addform {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            margin-bottom: 10px;
            font-size: 16px;
            color: #444;
            text-align: left;
        }

        .form-input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-close-popup {
            margin-top: 12px;
            background-color: #e74c3c;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-close-popup:hover {
            background-color: #c0392b;
        }

        /* Animation for popup */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .overlay-container.show {
            display: flex;
            opacity: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
</head>

<body>
    <button class="btn-open-popup" onclick="togglePopup()">
       Click Here to Add Yourself
      </button>

    <div id="popupOverlay"  class="overlay-container">
        <div class="popup-box">
            <h2 style="color: grey;">Add Yourself Here</h2>
            <form id="addform" action=" " method="POST">
                <label class="form-label" for="name">Username: </label>
                <input class="form-input" type="text" placeholder="Enter Your Username" id="name" name="name" >
                <?php if(isset($error["name"])){
                    echo "<span style='color:red;'>".$error["name"]."</span>"; }
                ?>
                <label class="form-label" for="email">Email:</label>
                <input class="form-input" type="email" placeholder="Enter Your Email" id="email" name="email" >
                <label class="form-label" for="email">City:</label>
                <input class="form-input" type="text" placeholder="Enter Your City" id="city" name="city" >
                <button class="btn-submit" type="submit" > Submit </button>
            </form>
            <button class="btn-close-popup" onclick="togglePopup()"> Close </button>
        </div>
        <div id="editPopup" style="display: none;">
            <form id="editForm" method="POST" action="update_user.php">
                <input type="hidden" id="editUserId" name="id">
                <label>Name:</label>
                <input type="text" id="editName" name="name" required>
                <label>Email:</label>
                <input type="email" id="editEmail" name="email" required>
                <label>City:</label>
                <input type="text" id="editCity" name="city" required>
                <button type="submit">Update</button>
                <button type="button" class="close-popup">Cancel</button>
            </form>
        </div> 
    </div>
    
    <script>
        function togglePopup() {
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('show');
        }
        $(document).ready(function () {
            console.log("jQuery version:", $.fn.jquery);
            console.log("Validation plugin loaded:", typeof $.fn.validate);

            if (typeof $.fn.validate !== "function") {
                console.error("jQuery Validation Plugin is not loaded properly. Check script order.");
                return;
            }

            // Custom validation rule for letters only (for name and city)
            $.validator.addMethod("validString", function (value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
            }, "The field must contain only letters");
            
            $(document).on("click", ".edit-user", function () {
                    let row = $(this).closest("tr"); // Get the row where the button was clicked
                    let userId = $(this).data("User_ID");
                    let Name = row.find("td:nth-child(2)").text();
                    let Email = row.find("td:nth-child(3)").text();
                    let City = row.find("td:nth-child(4)").text();

                    // Populate form fields with existing values
                    $("#editName").val(Name);
                    $("#editEmail").val(Email);
                    $("#editCity").val(City);

                    // Show Edit Popup
                    $("#editPopup").fadeIn();
                });

                // Close Edit Popup
                $(".close-popup").on("click", function () {
                    $("#editPopup").fadeOut();
                });

                // Handle Delete Button Click
                $(document).on("click", ".delete-user", function () {
                    let row = $(this).closest("tr");

                    if (confirm("Are you sure you want to delete this user?")) {
                        row.remove(); // Remove the row from the table
                    }
            });

            // Initialize form validation
            $("#addform").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 4,
                        validString: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    city: {
                        required: true,
                        validString: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must be at least 4 characters long"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    city: {
                        required: "Please enter your city"
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element); // Show error message below the input field
                },
                submitHandler: function (form) {
                    form.submit(); // Submit only if validation passes
                }
            });

            // Handle form submission button click
            $(".btn-submit").click(function (event) {
                event.preventDefault(); // Prevent default form submission

                if ($("#addform").valid()) { 
                    $("#popupOverlay").removeClass("show"); // Close popup only if form is valid
                    $("#addform").submit(); // Submit the form
                }
            });
        });
     
    </script>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = htmlspecialchars(trim($_POST["name"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $city = htmlspecialchars(trim($_POST["city"]));
            $error = [];

            if (empty($name) || strlen($name) < 4){
                $error["name"] = "Name is required minimum of 4 char";
            }
    
            //Email Validation
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error["email"] = "Email is required";
            } 
            else {
                // Check if email already exists
                $stmt  = $conn->prepare("SELECT Email FROM users WHERE Email = ? " );
                $stmt -> bind_param("s", $email);
                $stmt -> execute();
                $stmt -> store_result(); 
        
                if($stmt->num_rows > 0 ){
                    $error["email"] = "this email is already registered";
                }
                $stmt->close();
            }
        

            //City Validation
            if (empty($city)){
                $error["city"] = "City is required";
            } 
            if ($error){
                echo "<span style='color:red';>You Made some error in the form</span>";
            }

            if (empty($error)){
                $sql = "INSERT INTO users (`Name`, `Email`, `City`) VALUES ('$name', '$email', '$city')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "The data is inserted successfully";
                }else{
                    echo "The data is not inserted successfully" . mysqli_error($conn);
                }
            }
        }
        function test_input($data){
            $data = trim($data);
        }    
    ?>
    <table>
        <tr>
            <th>Created At</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th colspan = 2>Status</th>
            <th>Action</th>
        </tr>
        <?php 
            $sql1 = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql1);
            
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            
            // Fetch and print all rows as an associative array
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["City"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "<td>" . ($row["status"] ?? "Active") . "</td>"; // Assuming 'status' column exists; default "Active" if not available
                echo "<td class='user-actions'>";
                echo "    <button class='btn btn-sm btn-info edit-user' data-id='" . $row["User_ID"] . "'>";
                echo "        <i class='fas fa-edit'></i> Edit";
                echo "    </button>";
                echo "    <button class='btn btn-sm btn-danger delete-user' data-id='" . $row["User_ID"] . "'>";
                echo "        <i class='fas fa-trash'></i> Delete";
                echo "    </button>";
                echo "</td>";
                echo "</tr>";
            }
            
            $conn->close();
        ?>
    </table>

</body>

</html>
