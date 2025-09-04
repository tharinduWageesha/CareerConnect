<?php 
// Connect to database
include 'db.php'; 

// Check if there's a success/error message to show
$message = '';
$message_type = '';
if (isset($_GET['success'])) {
    $message = "Action completed successfully!";
    $message_type = "success";
} elseif (isset($_GET['error'])) {
    $message = "Something went wrong. Please try again.";
    $message_type = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees - CareerConnect</title>
    <link rel="stylesheet" href="adminhomepage.css">
    <style>
        /* Simple message styling */
        .message {
            padding: 10px;
            margin: 10px auto;
            max-width: 800px;
            border-radius: 5px;
            text-align: center;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .add-button {
            background-color: #28a745 !important;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            margin: 20px 0;
        }
        .add-button:hover {
            background-color: #218838 !important;
        }
    </style>
</head>
<body>
    <!-- Navigation (same as before) -->
    <header>
        <nav>
            <div class="logo">
                <img src="../assets/images/logo2.png" height="50" width="50">
                <div>
                    <strong>CareerConnect</strong>
                    <div class="tagline">Connecting Careers, Building Futures.</div>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="adminhomepage.php">Home</a></li>
                <li><a href="manage_employees.php">Manage Employees</a></li>
                <li><a href="manage_companies.php">Manage Companies</a></li>
                <li><a href="help.html">Help</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2 style="text-align:center; margin:20px 0;">Manage Employees</h2>
        
        <!-- Show success/error messages -->
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <!-- Employee Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Joined Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get all employees from database
                $sql = "SELECT id, name, email, phone, created_at FROM users ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Show each employee in a table row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['phone'] ?? 'Not provided') . "</td>
                            <td>" . date('M d, Y', strtotime($row['created_at'])) . "</td>
                            <td>
                                <a href='edit_employee.php?id=" . $row['id'] . "'>
                                    <button class='edit'>Edit</button>
                                </a>
                                <button class='delete' onclick=\"confirmDelete('employee', " . $row['id'] . ")\">
                                    Delete
                                </button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; color: #666;'>No employees found</td></tr>";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
        
        <!-- Add New Employee Button -->
        <div style="text-align:center; margin:20px;">
            <button class="add-button" onclick="window.location.href='add_employee.php'">
                ➕ Add New Employee
            </button>
        </div>
    </main>

    <!-- Include JavaScript for delete confirmations -->
    <script src="confirm_delete.js"></script>
</body>
</html>