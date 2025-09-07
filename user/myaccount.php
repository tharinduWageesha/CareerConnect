<?php
require_once '../includes/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM emp_details WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

if (!$employee) {
    $conn->query("INSERT INTO emp_details (username, full_name, email_address) 
                  SELECT username, email FROM users WHERE username = '$username'");
    $employee = $conn->query("SELECT * FROM emp_details WHERE username = '$username'")->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $education = $_POST['education'];
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];
    $location = $_POST['location'];
    $website = $_POST['website'];

    $stmt = $conn->prepare("
        UPDATE emp_details 
        SET full_name=?, email_address=?, phone_number=?, education=?, skills=?, experience=?, location=?, website=?
        WHERE username=?
    ");
    $stmt->bind_param("sssssssss", $full_name, $email_address, $phone_number, $education, $skills, $experience, $location, $website, $username);

    if ($stmt->execute()) {
        header("Location: myaccount.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - CareerConnect</title>
    <link rel="stylesheet" href="../includes/navfooter.css">
    <link rel="stylesheet" href="myaccount.css">
    <style></style>
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
        <li><a href="userhomepage.php">Home</a></li>
        <li><a href="findajob.php">Find a Job</a></li>
        <li><a href="myapplications.php">My Applications</a></li>
        <li><a href="help.php">Help</a></li>
        <li><a href="myaccount.php" class="active">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>
    </nav>
  </header>

  <div class="main-container">
    <div class="page-title">
      <h1>My Account</h1>
      <p>Manage your company profile and account settings</p>
    </div>

    <div id="successMessage" class="message success-message"></div>
    <div id="errorMessage" class="message error-message"></div>

    <div class="account-layout">
      <div class="profile-summary">
        <div class="profile-avatar">👤</div>
        <div class="company-name"><?= htmlspecialchars($username); ?></div>
      </div>

      <div class="account-details">
        <div class="section-header">User Information</div>
        <div class="details-content">
          <form method="POST">
            <div class="details-grid">
              <div class="detail-group">
                <div class="detail-label">Full Name</div>
                <div class="detail-value">
                  <input type="text" name="full_name" value="<?= htmlspecialchars($employee['full_name']); ?>">
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Email Address</div>
                <div class="detail-value">
                  <input type="email" name="email_address" value="<?= htmlspecialchars($employee['email_address']); ?>">
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Phone Number</div>
                <div class="detail-value">
                  <input type="text" name="phone_number" value="<?= htmlspecialchars($employee['phone_number']); ?>">
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Education</div>
                <div class="detail-value">
                  <textarea name="education"><?= htmlspecialchars($employee['education']); ?></textarea>
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Skills</div>
                <div class="detail-value">
                  <textarea name="skills"><?= htmlspecialchars($employee['skills']); ?></textarea>
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Experience</div>
                <div class="detail-value">
                  <textarea name="experience"><?= htmlspecialchars($employee['experience']); ?></textarea>
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Location</div>
                <div class="detail-value">
                  <input type="text" name="location" value="<?= htmlspecialchars($employee['location']); ?>">
                </div>
              </div>

              <div class="detail-group">
                <div class="detail-label">Website (Portfolio/LinkedIn)</div>
                <div class="detail-value">
                  <input type="text" name="website" value="<?= htmlspecialchars($employee['website']); ?>">
                </div>
              </div>
            </div>
            <button type="submit" class="btn-edit">Save</button>
          </form>
        </div>
      </div>
    </div>
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
