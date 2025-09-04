<?php
// 1. Include database connection
include 'db.php';

// In a real application, you would get the admin ID from a session
// For now, we'll just fetch the admin with ID = 1 as an example
$admin_id = 1; 

$sql = "SELECT name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account - CareerConnect</title>
  <link rel="stylesheet" href="adminhomepage.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            <li><a href="manage_companies.php">Manage Companies</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>
  <main>
    <h2 style="text-align:center; margin:20px 0;">My Account</h2>
    
    <div class="account-card">
      <div class="account-avatar">
        <i class="fas fa-user"></i>
      </div>
      <div class="account-detail">
        <strong>Admin Name:</strong> <?php echo htmlspecialchars($admin['name'] ?? 'N/A'); ?>
      </div>
      <div class="account-detail">
        <strong>Email:</strong> <?php echo htmlspecialchars($admin['email'] ?? 'N/A'); ?>
      </div>
      <div class="account-detail">
        <strong>Role:</strong> Administrator
      </div>
      <div class="account-detail">
        <strong>Last Login:</strong> Today at 10:30 AM
      </div>
      <div style="margin-top:20px;">
        <button>Edit Profile</button>
        <button>Change Password</button>
      </div>
    </div>
  </main>
</body>
</html>