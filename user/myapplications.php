<?php
require_once '../includes/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM applications WHERE Empname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications - CareerConnect</title>
    <link rel="stylesheet" href="../includes/navfooter.css">
    <link rel="stylesheet" href="myapplications.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../assets/images/logo2.png" height="70" width="70">
                <div>
                    <strong>CareerConnect</strong>
                    <div class="tagline">Connecting Careers, Building Futures.</div>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="userhomepage.php">Home</a></li>
                <li><a href="findajob.php">Find a Job</a></li>
                <li><a href="myapplications.php" class="active">My Applications</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="myaccount.php">My Account</a></li>
                <button onclick="window.location.href='../login.php'">Log Out</button>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Applications Submitted</h2>

        <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Applied On</th>
                    <th>Status</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['job_id']) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars(date("d-m-Y", strtotime($row['applied_at']))) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <div class="no-applications">You haven't applied to any jobs yet.</div>
        <?php } ?>

        <a href="findajob.php" class="back-btn">Back to Find Jobs</a>
    </div>

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
                        <li><a href="homepage.php">Home</a></li>
                        <li><a href="findajob.php">Find Jobs</a></li>
                        <li><a href="myapplications.php">My Applications</a></li>
                        <li><a href="help.php">Help</a></li>
                        <li><a href="myaccount.php">My Account</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <p>📧 Email: info@careerconnect.com</p>
                    <p>📞 Phone: +94 81 233 3233</p>
                    <p>📍 Address: CareerCon, Cross Street, Colombo, Sri Lanka<br>Job City, JC 12345</p>
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
