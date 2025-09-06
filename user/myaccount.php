<?php
require_once '../includes/config.php';

// Check if user logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch employee details
$sql = "SELECT * FROM emp_details WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

// If not found, create a blank row for new users
if (!$employee) {
    $conn->query("INSERT INTO emp_details (username, full_name, email_address) 
                  SELECT username, email FROM users WHERE username = '$username'");
    $employee = $conn->query("SELECT * FROM emp_details WHERE username = '$username'")->fetch_assoc();
}

// Handle update
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
        header("Location: empaccount.php?success=1");
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
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            
        }
       header {
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 2px solid #87ceeb;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.02);
        }

        .logo img {
            height: 70px;
            width: 70px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(135, 206, 235, 0.3);
            transition: all 0.3s ease;
        }

        .logo img:hover {
            box-shadow: 0 6px 20px rgba(135, 206, 235, 0.5);
            transform: rotate(5deg);
        }

        .logo div strong {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a202c;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tagline {
            font-size: 0.9rem;
            color: #5f9ab1;
            font-weight: 500;
            margin-top: 2px;
            font-style: italic;
        }

        .nav-links {
            display: flex;
            list-style: none;
            align-items: center;
            gap: 2rem;
        }

        .nav-links li a {
            text-decoration: none;
            color: #1a202c;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-links li a::before {
            content: '';
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(135, 206, 235, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .nav-links li a:hover::before {
            left: 100%;
        }

        .nav-links li a:hover {
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(135, 206, 235, 0.4);
        }

        .nav-links button {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 32, 44, 0.2);
            position: relative;
            overflow: hidden;
        }
        .active{
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(135, 206, 235, 0.4);
        }

        .nav-links button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .nav-links button:hover::before {
            left: 100%;
        }

        .nav-links button:hover {
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(135, 206, 235, 0.4);
        }

        .nav-links button:active {
            transform: translateY(0);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .logo div strong {
                font-size: 1.5rem;
            }

            .nav-links li a {
                padding: 0.5rem 0.8rem;
                font-size: 0.9rem;
            }

            .nav-links button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
}
        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .page-title h1 {
            font-size: 32px;
            color: black;
            margin-bottom: 10px;
        }

        .page-title p {
            color: #87ceeb;
            font-size: 18px;
        }

        /* Account Layout */
        .account-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        /* Profile Summary Card */
        .profile-summary {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: fit-content;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #87ceeb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 48px;
            color: white;
            font-weight: bold;
        }

        .company-name {
            font-size: 24px;
            color: black;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .company-type {
            color: #87ceeb;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #87ceeb;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        /* Account Details Section */
        .account-details {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .section-header {
            background-color: #87ceeb;
            color: white;
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-edit {
            background-color: #87ceeb;
            color: black;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-edit:hover {
            background-color: #62aac7ff;
        }

        .details-content {
            padding: 30px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }

        .detail-group {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .detail-group:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #87ceeb;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .detail-value {
            color: black;
            font-size: 16px;
            font-weight: 500;
        }

        .detail-value.empty {
            color: #999;
            font-style: italic;
        }
        .detail-value input {
            width: 100%;
            padding: 6px 10px;
             font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #f9f9f9;
             transition: border 0.3s, box-shadow 0.3s;
        }

        .detail-value input:focus {
             border-color: #275d5cff;
             box-shadow: 0 0 5px rgba(54, 219, 234, 0.5); 
             outline: none;
        }

        footer {
             background-color:#83A2B2;
             color: white;
            padding: 40px 0 20px;
             margin-top: 50px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    margin-bottom: 30px;
}

.footer-section h3 {
    color: #ffffff;
    font-size: 20px;
    margin-bottom: 20px;
}

.footer-section p,
.footer-section li {
    color: #e5f7ff;
    line-height: 1.6;
    margin-bottom: 10px;
}

.footer-section ul {
    list-style: none;
}

.footer-section a {
    color: #e5f7ff;
    text-decoration: none;
}

.footer-section a:hover {
    color: #87ceeb;
}

.social-links {
    display: flex;
    gap: 15px;
    margin-top: 15px;
}

.social-links a {
    background-color: #333;
    color: white;
    padding: 10px;
    border-radius: 50%;
    text-decoration: none;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-links a:hover {
    background-color: #87ceeb;
}

.footer-bottom {
    border-top: 1px solid #333;
    padding-top: 20px;
    text-align: center;
}

.footer-bottom p {
    color: #dfdfdf;
    margin: 0;
}
    </style>
</head>
<body>
    <!-- Header -->
  <header>
    <nav>
      <div class="logo">
        <img src="../assets/images/logo2.png " height="50" width="50">
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
        <li><a href="myaccount.php"  class="active">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>


    </nav>
  </header>
    <div class="main-container">
        <!-- Page Title -->
        <div class="page-title">
            <h1>My Account</h1>
            <p>Manage your company profile and account settings</p>
        </div>

        <!-- Success/Error Messages -->
        <div id="successMessage" class="message success-message"></div>
        <div id="errorMessage" class="message error-message"></div>

       <!-- Account Layout -->
<div class="account-layout">
    <!-- Profile Summary -->
    <div class="profile-summary">
        <div class="profile-avatar">👤</div>
        <div class="company-name"><?php echo htmlspecialchars($username); ?></div>
    </div>

    <!-- Account Details -->
    <div class="account-details">
        <div class="section-header">
            User Information
        </div>

        <div class="details-content">
            <form method="POST">
      <label>Full Name</label>
      <input type="text" name="full_name" value="<?= htmlspecialchars($employee['full_name']); ?>">

      <label>Email Address</label>
      <input type="email" name="email_address" value="<?= htmlspecialchars($employee['email_address']); ?>">

      <label>Phone Number</label>
      <input type="text" name="phone_number" value="<?= htmlspecialchars($employee['phone_number']); ?>">

      <label>Education</label>
      <textarea name="education"><?= htmlspecialchars($employee['education']); ?></textarea>

      <label>Skills</label>
      <textarea name="skills"><?= htmlspecialchars($employee['skills']); ?></textarea>

      <label>Experience</label>
      <textarea name="experience"><?= htmlspecialchars($employee['experience']); ?></textarea>

      <label>Location</label>
      <input type="text" name="location" value="<?= htmlspecialchars($employee['location']); ?>">

      <label>Website (Portfolio/LinkedIn)</label>
      <input type="text" name="website" value="<?= htmlspecialchars($employee['website']); ?>">

      <button type="submit">Save Profile</button>
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