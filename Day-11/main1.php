<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "paymentapp";

$conn = mysqli_connect($servername, $username, $password, $db);

if(!$conn){
    die("There is some error in connecting" . mysqli_connect_error());
}else{
    echo "The database is connected";
}

// ADD USER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addUser"])) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $city = htmlspecialchars(trim($_POST["city"]));

    // Validate fields
    if (empty($name) || strlen($name) < 4) {
        echo "Name must be at least 4 characters";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email";
    } elseif (empty($city)) {
        echo "City is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (Name, Email, City) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $city);
        $stmt->execute();
        $stmt->close();
        
    }
}

// EDIT USER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editUser"])) {
    $id = intval($_POST["id"]);
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $city = htmlspecialchars(trim($_POST["city"]));

    $stmt = $conn->prepare("UPDATE users SET Name = ?, Email = ?, City = ?, updated_at = NOW() WHERE User_ID = ?");
    $stmt->bind_param("sssi", $name, $email, $city, $id);

    if ($stmt->execute()) {
        header("Location: main1.php");
        exit();
    } else {
        echo "Error updating user";
    }
}

// DELETE USER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteUser"])) {
    $id = intval($_POST["id"]);

    $stmt = $conn->prepare("UPDATE users SET deleted_at = NOW() WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting user";
    }
}

// FETCH USERS
$users = $conn->query("SELECT * FROM users WHERE deleted_at IS NULL ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>

    <h2>User Management</h2>
    
    <!-- Add User Form -->
    <button onclick="document.getElementById('addUserModal').style.display='block'">Add User</button>
    <div id="addUserModal" style="display:none;">
        <form method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="city" placeholder="City" required>
            <button type="submit" name="addUser">Submit</button>
            <button type="button" onclick="document.getElementById('addUserModal').style.display='none'">Close</button>
        </form>
    </div>

    <br><br>

    <!-- Users Table -->
    <table>
        <tr>
            <th>Created At</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($user = $users->fetch_assoc()): ?>
        <tr>
            <td><?= $user['created_at'] ?></td>
            <td><?= $user['Name'] ?></td>
            <td><?= $user['Email'] ?></td>
            <td><?= $user['City'] ?></td>
            <td><?= $user['Status'] == 1 ? "Active" : "Deactivated" ?></td>
            <td>
                <!-- Edit User -->
                <button onclick="editUser('<?= $user['Name'] ?>', '<?= $user['Email'] ?>', '<?= $user['City'] ?>')">Edit</button>
                
                <!-- Delete User -->
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['Name'] ?>">
                    <button type="submit" name="deleteUser">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Edit User Modal -->
    <div id="editUserModal" style="display:none;">
        <form method="post">
            <input type="hidden" id="editUserId" name="id">
            <input type="text" id="editUserName" name="name" required>
            <input type="email" id="editUserEmail" name="email" required>
            <input type="text" id="editUserCity" name="city" required>
            <button type="submit" name="editUser">Update</button>
            <button type="button" onclick="document.getElementById('editUserModal').style.display='none'">Close</button>
        </form>
    </div>

    <script>
        function editUser(id, name, email, city) {
            document.getElementById('editUserId').value = id;
            document.getElementById('editUserName').value = name;
            document.getElementById('editUserEmail').value = email;
            document.getElementById('editUserCity').value = city;
            document.getElementById('editUserModal').style.display = 'block';
        }
    </script>

</body>
</html>
