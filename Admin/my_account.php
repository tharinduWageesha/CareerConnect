<?php
require_once '../includes/config.php';

$role = "admin"; 

$sql = "SELECT * FROM users WHERE role = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $role);
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
  <link rel="stylesheet" href="../includes/navfooter.css">
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
            <li><a href="my_account.php" class="active">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>
  <main>
    <h2 style="text-align:center; margin:20px 0;">My Account</h2>
    
    <div class="account-card">
      <div class="account-avatar">
        👤
      </div>
      <div class="account-detail">
        <strong>Admin Name:</strong> <?php echo htmlspecialchars($admin['full_name'] ?? 'N/A'); ?>
      </div>
      <div class="account-detail">
        <strong>Email:</strong> <?php echo htmlspecialchars($admin['email'] ?? 'N/A'); ?>
      </div>
      <div class="account-detail">
        <strong>Role:</strong> <?php echo htmlspecialchars(ucfirst($admin['role'] ?? 'N/A')); ?>
      </div>
      <div class="account-detail">
        <strong>Account Created :</strong> <?php echo htmlspecialchars($admin['created_at'] ?? 'N/A'); ?>
      </div>
      <div style="margin-top:20px;">
        <button onclick="window.location.href='edit_my_account.php'">Edit Profile</button>
        <button onclick="window.location.href='edit_my_account.php'">Change Password</button>
      </div>
    </div>
  </main>
  <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About CareerConnect</h3>
                    <p>We help people find great jobs and help companies find great employees. Join thousands of successful job seekers who found their dream careers with us.</p>
                    <div class="social-links">
                        <a href="#" title="Facebook">📘</a>
                        <a href="#" title="Twitter">🐦</a>
                        <a href="#" title="LinkedIn">💼</a>
                        <a href="#" title="Instagram">📷</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="companyhomepage.php">Home</a></li>
                        <li><a href="postajob.php">Post Jobs</a></li>
                        <li><a href="viewapplications.php">Applications</a></li>
                        <li><a href="helpcom.php">Help</a></li>
                        <li><a href="myaccountpage.php">My Account</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p>📧 Email: info@careerconnect.com</p>
                    <p>📞 Phone: +94 81 233 3233</p>
                    <p>📍 Address: CareerCon, Cross Street, Colombo, Srilanka<br>Job City, JC 12345</p>
                    <p>🕒 Mon - Fri: 9:00 AM - 6:00 PM</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 CareerConnect. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </div>
    </footer>
</body>
</html>