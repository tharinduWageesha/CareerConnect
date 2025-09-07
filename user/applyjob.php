<?php
require '../includes/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

$jobId = $_GET['job_id'] ?? 0;
$jobQuery = mysqli_query($conn, "SELECT * FROM jobs WHERE id='$jobId'");
$job = mysqli_fetch_assoc($jobQuery);

if (!$job) {
    die("Job not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coverLetter = mysqli_real_escape_string($conn, $_POST['cover_letter']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $resumePath = mysqli_real_escape_string($conn, $_POST['resume']);
    $comName = $job['company'];
    $Empname = mysqli_real_escape_string($conn, $_POST['username']);

    $sql = "INSERT INTO applications 
        (job_id, cover_letter, resume_path, username, email, phone, experience, location, salary, Empname) 
        VALUES ('$jobId', '$coverLetter', '$resumePath', '$comName', '$email', '$phone', '$experience', '$location', '$salary', '$Empname')";

    if (mysqli_query($conn, $sql)) {
        $success = "Application submitted successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply - CareerConnect</title>
    <link rel="stylesheet" href="../includes/navfooter.css">
    <link rel="stylesheet" href="applyjob.css">
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
                <li><a href="findajob.php" class="active">Find a Job</a></li>
                <li><a href="myapplications.php">My Applications</a></li>
                <li><a href="help.php">Help</a></li>
                <li><a href="myaccount.php">My Account</a></li>
                <button onclick="window.location.href='../login.php'">Log Out</button>
            </ul>
        </nav>
    </header>

    <div class="apply-container">
        <h2>Apply for <?= htmlspecialchars($job['jobTitle']) ?> at <?= htmlspecialchars($job['company']) ?></h2>

        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" name="username" required value="<?php echo htmlspecialchars($username); ?>" readonly>

            <label for="cover_letter">Cover Letter</label>
            <textarea name="cover_letter" id="cover_letter" rows="6" required></textarea>

            <label for="resume">Resume Link</label>
            <input type="text" name="resume" required>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="phone">Phone</label>
            <input type="text" name="phone" required>

            <label for="experience">Experience</label>
            <textarea name="experience" rows="4"></textarea>

            <label for="location">Location</label>
            <input type="text" name="location">

            <label for="salary">Expected Salary</label>
            <input type="number" step="0.01" name="salary">

            <button type="submit">Submit Application</button>
            <button type="button" onclick="window.history.back()">Cancel</button>
        </form>
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