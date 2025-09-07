<?php
require_once '../includes/config.php';

$company = null;

// Part 1: Fetch company data for the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $company = $result->fetch_assoc();
    } else {
        echo "Company not found.";
        exit();
    }
    $stmt->close();
}

// Part 2: Handle form submission for updating data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);


    if (!empty($password)) {
        $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $full_name, $email, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $full_name, $email, $id);
    }

    if ($stmt->execute()) {
        header("Location: manage_companies.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Company</title>
    <link rel="stylesheet" href="adminhomepage.css">
    <link rel="stylesheet" href="../includes/navfooter.css">
</head>
<body>
    <!-- Navigation -->
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

    <h2 style="text-align:center; margin:20px 0;">Edit Company</h2>
    <form action="edit_company.php" method="post" style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #000000ff; border-radius: 8px;">
        <input type="hidden" name="id" value="<?php echo $company['user_id']; ?>">
        <div class="form-group">
            <label for="full_name">Company Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $company['full_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $company['email']; ?>" required>
        </div>
        <div class="form-group">employees
            <label for="password">New Password (optional):</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <button type="submit">Update Company</button>
        </div>
    </form>

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
