<?php 
require_once '../includes/config.php';

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
    <title>Manage Companies - CareerConnect</title>
    <link rel="stylesheet" href="adminhomepage.css">
    <link rel="stylesheet" href="../includes/navfooter.css">
    <style>
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
            background-color: #007bff !important;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            margin: 20px 0;
        }
        .add-button:hover {
            background-color: #0069d9 !important;
        }
    </style>
</head>
<body>
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
            <li><a href="manage_companies.php" class="active">Manage Companies</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>

<main>
    <h2 style="text-align:center; margin:20px 0;">Manage Companies</h2>

    <!-- Show success/error messages -->
    <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Joined Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users WHERE role = 'company' ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['user_id'] . "</td>
                        <td>" . htmlspecialchars($row['full_name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['username'] ?? 'Not provided') . "</td>
                        <td>" . date('M d, Y', strtotime($row['created_at'])) . "</td>
                        <td>
                            <a href='edit_company.php?id=" . $row['user_id'] . "'>
                                <button class='edit'>Edit</button>
                            </a>
                            <button class='delete' onclick=\"confirmDelete('company', " . $row['user_id'] . ")\">
                                Delete
                            </button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center; color: #666;'>No companies found</td></tr>";
            }
            
            $conn->close();
            ?>
        </tbody>
    </table>

    <div style="text-align:center; margin:20px;">
        <button class="add-button" onclick="window.location.href='add_company.php'">
            ➕ Add New Company
        </button>
    </div>
</main>

<footer>
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About CareerConnect</h3>
                <p>We help people find great jobs and help companies find great employees. Join thousands of successful job seekers who found their dream careers with us.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="adminhomepage.php">Home</a></li>
                    <li><a href="manage_employees.php">Manage Employees</a></li>
                    <li><a href="manage_companies.php">Manage Companies</a></li>
                    <li><a href="help.html">Help</a></li>
                    <li><a href="my_account.php">My Account</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>📧 Email: info@careerconnect.com</p>
                <p>📞 Phone: +94 81 233 3233</p>
                <p>📍 Address: CareerCon, Cross Street, Colombo, Sri Lanka</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 CareerConnect. All rights reserved. | Privacy Policy | Terms of Service</p>
        </div>
    </div>
</footer>

<!-- JS for delete confirmation -->
<script>
    function confirmDelete(type, user_id) {
    if (confirm("Are you sure you want to delete this " + type + "?")) {
        window.location.href = "manage_companies.php?user_id=" + user_id;
    }
    function showMessage(message, type) {
            var messageDiv = document.createElement('div');
            messageDiv.className = 'message ' + type;
            messageDiv.textContent = message;
    
            // Add to top of main content
            var main = document.querySelector('main');
            main.insertBefore(messageDiv, main.firstChild);
    
            // Remove message after 3 seconds
            setTimeout(function() {
                messageDiv.remove();
            }, 3000);
        }
}
</script>
</body>
</html>
