<?php
require_once '../includes/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); 
    $role = 'user'; // Default role for employees

    $stmt = $conn->prepare("INSERT INTO users (full_name,email,username,password,role) VALUES (?, ?, ?,?,?)");
    $stmt->bind_param("sssss", $name, $email, $username, $password, $role);

    if ($stmt->execute()) {
        header("Location: manage_employees.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="adminhomepage.css">
    <link rel="stylesheet" href="../includes/navfooter.css">
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
            <li><a href="manage_employees.php" class="active">Manage Employees</a></li>
            <li><a href="manage_companies.php">Manage Companies</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>

<main>
    <h2 style="text-align:center; margin:20px 0;">Add a New Employee</h2>
    
    <form action="add_employee.php" method="post" style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #000000ff; border-radius: 8px;">
        <div class="form-group">
            <label for="full_name">Full name:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div style="text-align:center;">
            <button type="submit">Save Employee</button>
        </div>
    </form>
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