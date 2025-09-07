<?php
require_once '../includes/config.php';

$userResult = $conn->query("SELECT COUNT(*) as total FROM users where role='USER';");
$totalUsers = $userResult->fetch_assoc()['total'];
$companyResult = $conn->query("SELECT COUNT(*) as total FROM users where role='company';");
$totalCompanies = $companyResult->fetch_assoc()['total'];
$jobResult = $conn->query("SELECT COUNT(*) as total FROM jobs");
$totalJobs = $jobResult->fetch_assoc()['total'];
$applicationResult = $conn->query("SELECT COUNT(*) as total FROM applications");
$totalApplications = $applicationResult->fetch_assoc()['total'];
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Outer Web - Start Your Career</title>
  <link rel="stylesheet" href="adminhomepage.css">
  <link rel="stylesheet" href="../includes/navfooter.css">
  <style>
    .banner-container {
      position: relative;
      width: 100%;
      overflow: hidden;
    }
    .banner-container img {
      width: 100%;
      height: 600px;
      display: block;
    }
    
    .welcome-section {
      padding: 2rem;
      text-align: center;
      background-color: white;
      max-width: 1200px;
      margin: 0 auto;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-top: -50px;
      position: relative;
      z-index: 2;
    }
    
    .dashboard-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin: 2rem auto;
      max-width: 1200px;
      padding: 0 1rem;
    }
    
    .stat-card {
      background: white;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    
    .stat-card h3 {
      color: #2d3748;
      margin-bottom: 0.5rem;
    }
    
    .stat-card p {
      font-size: 2rem;
      font-weight: bold;
      color: #5dade2;
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
            <li><a href="adminhomepage.php" class="active">Home</a></li>
            <li><a href="manage_employees.php">Manage Employees</a></li>
            <li><a href="manage_companies.php">Manage Companies</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>
  
  <div class="banner-container">
    <img src="../assets/images/bannerimg.jpg" alt="CareerConnect Banner">
  </div>
  
  <div class="welcome-section">
    <h1>Welcome to Admin Dashboard</h1>
    <p>Manage your platform efficiently with the tools below</p>
  </div>
  
  <div class="dashboard-stats">
    <div class="stat-card">
      <h3>Total Users</h3>
      <p><?php echo $totalUsers; ?></p>
    </div>
    <div class="stat-card">
      <h3>Companies</h3>
      <p><?php echo $totalCompanies; ?></p>
    </div>
    <div class="stat-card">
      <h3>Job Listings</h3>
      <p><?php echo $totalJobs; ?></p>
    </div>
    <div class="stat-card">
      <h3>Applications</h3>
      <p><?php echo $totalApplications; ?></p>
    </div>
  </div>

  <!-- About Section -->
   <div class="about-section" id="about">
        <div class="about-container">
            <div class="about-header">
                <h2>About CareerConnect</h2>
                <div class="about-subtitle">Your Gateway to Professional Success</div>
            </div>
            
            <div class="about-text">
                <p class="lead-text">
                    At CareerConnect, we help people find great jobs and help companies find great employees. 
                    Our platform makes job searching easy and fast for everyone.
                </p>
                
                <div class="mission-vision">
                    <div class="mission">
                        <h3>Our Mission</h3>
                        <p>To help people find jobs that match their skills and help companies find the right employees to grow their business.</p>
                    </div>
                    
                    <div class="vision">
                        <h3>Our Vision</h3>
                        <p>To be the best job platform where everyone can find their perfect job and companies can find amazing employees.</p>
                    </div>
                </div>
  </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h4>Smart Job Matching</h4>
                    <p>We find jobs that match your skills and interests perfectly.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🚀</div>
                    <h4>Career Growth</h4>
                    <p>Get help and training to grow in your career and get better jobs.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🌐</div>
                    <h4>Jobs Everywhere</h4>
                    <p>Find jobs in your city or anywhere in the world with our global network.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h4>Easy Applications</h4>
                    <p>Apply to many jobs quickly with just one click using your profile.</p>
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
                        <li><a href="helpcompage.php">Help</a></li>
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
