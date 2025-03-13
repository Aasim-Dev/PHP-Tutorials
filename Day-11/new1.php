<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$db = "paymentapp";
$conn = new mysqli($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}


// Create Users table
// $conn->query("CREATE TABLE IF NOT EXISTS Users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//     city VARCHAR(100) NOT NULL,
//     status TINYINT DEFAULT 1,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// )");

// Create Wallet table
// $conn->query("CREATE TABLE IF NOT EXISTS Wallet (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT NOT NULL,
//     total DECIMAL(10,2) DEFAULT 0.00,
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
// )");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    
    if (!empty($name) && !empty($email) && !empty($city)) {
        $stmt = $conn->prepare("INSERT INTO users (Name, Email, City) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $city);
        $stmt->execute();
        $stmt->close();
        echo "User added successfully";
    } else {
        echo "All fields are required";
    }
    exit;
}

$sql1 = "SELECT Name, Email, City FROM users";
$result = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>User Management</title>
    <style>
        body{
            align-items: center;
            justify-content: center;
        }
        table {
            justify-content: center;
            border-collapse: collapse;
            margin: auto;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, Add Yourself by clicking below.</h2>
        <button class="btn btn-primary" id="openModal">Add User</button>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" method="POST" action = ""> 
                        <div >
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" >
                        </div>
                        <div >
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" >
                        </div>
                        <div >
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" >
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveUser">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
        </tr>
        <?php 
            if($result->num_rows > 0) {
                foreach($result as $row) {
                    echo "
                        <tr>
                            <td>" . $row['Name'] . "</td>
                            <td>" . $row['Email'] . "</td>
                            <td>" . $row['City'] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan=3><strong>No DATA FOUND</strong></td></tr>";
            }
        ?>
    </table>

    <script>
        $(document).ready(function() {
            const userModal = new bootstrap.Modal(document.getElementById('userModal'));
            
            $('#openModal').click(function() {
                $('#userForm')[0].reset();
                userModal.show();
            });

            $('#saveUser').click(function() {
                if ($('#userForm')[0].checkValidity()) {
                    alert('User saved successfully!');
                    userModal.hide();
                } else {
                    $('#userForm')[0].reportValidity();
                }
            });
        });
    </script>
</body>
</html>
