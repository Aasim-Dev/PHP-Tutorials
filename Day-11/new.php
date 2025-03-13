<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_wallet_system";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create Users table if not exists
$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating Users table: " . $conn->error);
}

// Create Wallet table if not exists
$sql = "CREATE TABLE IF NOT EXISTS Wallet (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    total DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === FALSE) {
    die("Error creating Wallet table: " . $conn->error);
}

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = [];
    
    // Add/Update user
    if (isset($_POST['action']) && $_POST['action'] == 'saveUser') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $id = $_POST['userId'] ?? null;
        
        if ($id) {
            // Update existing user
            $stmt = $conn->prepare("UPDATE Users SET name = ?, email = ?, city = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $email, $city, $id);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "User updated successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Error updating user: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Add new user
            $stmt = $conn->prepare("INSERT INTO Users (name, email, city) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $city);
            
            if ($stmt->execute()) {
                $userId = $stmt->insert_id;
                
                // Create wallet entry for new user
                $stmt2 = $conn->prepare("INSERT INTO Wallet (user_id) VALUES (?)");
                $stmt2->bind_param("i", $userId);
                $stmt2->execute();
                $stmt2->close();
                
                $response['success'] = true;
                $response['message'] = "User added successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Error adding user: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    
    // Get user by ID
    if (isset($_POST['action']) && $_POST['action'] == 'getUser') {
        $id = $_POST['userId'];
        
        $stmt = $conn->prepare("SELECT id, name, email, city FROM Users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['success'] = true;
            $response['user'] = $result->fetch_assoc();
        } else {
            $response['success'] = false;
            $response['message'] = "User not found";
        }
        $stmt->close();
    }
    
    // Delete user
    if (isset($_POST['action']) && $_POST['action'] == 'deleteUser') {
        $id = $_POST['userId'];
        
        // Soft delete - update deleted_at timestamp
        $stmt = $conn->prepare("UPDATE Users SET deleted_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "User deleted successfully!";
        } else {
            $response['success'] = false;
            $response['message'] = "Error deleting user: " . $stmt->error;
        }
        $stmt->close();
    }
    
    // Toggle user status
    if (isset($_POST['action']) && $_POST['action'] == 'toggleStatus') {
        $id = $_POST['userId'];
        $status = $_POST['status'];
        $newStatus = $status == 1 ? 0 : 1;
        
        $stmt = $conn->prepare("UPDATE Users SET status = ? WHERE id = ?");
        $stmt->bind_param("ii", $newStatus, $id);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Status updated successfully!";
            $response['newStatus'] = $newStatus;
        } else {
            $response['success'] = false;
            $response['message'] = "Error updating status: " . $stmt->error;
        }
        $stmt->close();
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Get all active users (not deleted)
$sql = "SELECT id, name, email, city, status, created_at FROM Users WHERE deleted_at IS NULL ORDER BY created_at DESC";
$result = $conn->query($sql);
$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Wallet Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-active {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .status-inactive {
            background-color: #f8d7da;
            color: #842029;
        }
        .btn-toggle {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        .user-actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">User-Wallet Management System</h2>
        
        <!-- Add User Button -->
        <div class="mb-4">
            <button type="button" class="btn btn-primary" id="addUserBtn">
                <i class="fas fa-plus me-2"></i>Add User
            </button>
        </div>
        
        <!-- Users Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Users</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="usersTable">
                        <thead>
                            <tr>
                                <th>Created At</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr data-id="<?php echo $user['id']; ?>">
                                <td><?php echo date('M d, Y H:i', strtotime($user['created_at'])); ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['city']); ?></td>
                                <td>
                                    <span class="status-badge <?php echo $user['status'] == 1 ? 'status-active' : 'status-inactive'; ?>">
                                        <?php echo $user['status'] == 1 ? 'Active' : 'Inactive'; ?>
                                    </span>
                                    <button class="btn btn-sm btn-toggle ms-2 btn-outline-secondary toggle-status" 
                                            data-id="<?php echo $user['id']; ?>"
                                            data-status="<?php echo $user['status']; ?>">
                                        <?php echo $user['status'] == 1 ? 'Deactivate' : 'Activate'; ?>
                                    </button>
                                </td>
                                <td class="user-actions">
                                    <button class="btn btn-sm btn-info edit-user" data-id="<?php echo $user['id']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-user" data-id="<?php echo $user['id']; ?>">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        <input type="hidden" id="userId" name="userId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveUserBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.all.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#usersTable').DataTable({
                order: [[0, 'desc']],
                columns: [
                    null,
                    null,
                    null,
                    null,
                    null,
                    { orderable: false }
                ]
            });
            
            // Modal instance
            const userModal = new bootstrap.Modal(document.getElementById('userModal'));
            
            // Open modal for adding new user
            $('#addUserBtn').click(function() {
                $('#modalTitle').text('Add New User');
                $('#userForm')[0].reset();
                $('#userId').val('');
                userModal.show();
            });
            
            // Open modal for editing user
            $(document).on('click', '.edit-user', function() {
                const userId = $(this).data('id');
                $('#modalTitle').text('Edit User');
                
                // Get user data
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: {
                        action: 'getUser',
                        userId: userId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#userId').val(response.user.id);
                            $('#name').val(response.user.name);
                            $('#email').val(response.user.email);
                            $('#city').val(response.user.city);
                            userModal.show();
                        } else {
                            showAlert('error', response.message);
                        }
                    },
                    error: function() {
                        showAlert('error', 'Failed to fetch user data');
                    }
                });
            });
            
            // Save user (Add or Update)
            $('#saveUserBtn').click(function() {
                if (!$('#userForm')[0].checkValidity()) {
                    $('#userForm')[0].reportValidity();
                    return;
                }
                
                const userId = $('#userId').val();
                const name = $('#name').val();
                const email = $('#email').val();
                const city = $('#city').val();
                
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: {
                        action: 'saveUser',
                        userId: userId,
                        name: name,
                        email: email,
                        city: city
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            userModal.hide();
                            showAlert('success', response.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showAlert('error', response.message);
                        }
                    },
                    error: function() {
                        showAlert('error', 'Failed to save user');
                    }
                });
            });
            
            // Delete user
            $(document).on('click', '.delete-user', function() {
                const userId = $(this).data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '',
                            type: 'POST',
                            data: {
                                action: 'deleteUser',
                                userId: userId
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    showAlert('success', response.message);
                                    setTimeout(() => location.reload(), 1500);
                                } else {
                                    showAlert('error', response.message);
                                }
                            },
                            error: function() {
                                showAlert('error', 'Failed to delete user');
                            }
                        });
                    }
                });
            });
            
            // Toggle user status
            $(document).on('click', '.toggle-status', function() {
                const userId = $(this).data('id');
                const currentStatus = $(this).data('status');
                const statusText = currentStatus == 1 ? 'deactivate' : 'activate';
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you want to ${statusText} this user?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, proceed!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '',
                            type: 'POST',
                            data: {
                                action: 'toggleStatus',
                                userId: userId,
                                status: currentStatus
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    showAlert('success', response.message);
                                    setTimeout(() => location.reload(), 1500);
                                } else {
                                    showAlert('error', response.message);
                                }
                            },
                            error: function() {
                                showAlert('error', 'Failed to update status');
                            }
                        });
                    }
                });
            });
            
            // Helper function to show alerts
            function showAlert(type, message) {
                Swal.fire({
                    icon: type,
                    title: type === 'success' ? 'Success!' : 'Error!',
                    text: message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    </script>
</body>
</html>