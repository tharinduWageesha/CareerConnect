<?php
require_once '../includes/config.php';

$countsek = $conn->query("SELECT COUNT(*) FROM users WHERE role = 'USER'")->fetch_row()[0];
$countcomp = $conn->query("SELECT COUNT(*) FROM users WHERE role = 'Company'")->fetch_row()[0];
$countjob = $conn->query("SELECT COUNT(*) FROM jobs")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Outer Web - Start Your Career</title>
  <link rel="stylesheet" href="company/style.css">
  <link rel="stylesheet" href="../includes/navfooter.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        line-height: 1.6;
    }
  </style>
</head>

<body>
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
        <li><a href="companyhomepage.php" class="active">Home</a></li>
        <li><a href="postajob.php">Post a Job</a></li>
        <li><a href="viewapplications.php">View Applications</a></li>
        <li><a href="helpcompage.php">Help</a></li>
        <li><a href="myaccountpage.php">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="welcome-text">-  Welcome to company page -</div>
        
        <h1 class="hero-title">
          Discover Top Employers with 
          <span class="accent">Career Connect</span>
        </h1>
        
        <p class="hero-subtitle">
          We are the people who dream & do.
        </p>
        
        <div class="cta-buttons">
          <a href="myaccountpage.php" class="btn btn-primary">Your profile</a>
          <a href="#about" class="btn btn-outline">About us</a>
        </div>
      </div>

      <div class="hero-images">
        <div class="image-card">
          <div>
            <img src="company/emloyer3.jpg" height="537" width="400">
            Happy Professional<br>
            <small>Strengthen partnerships</small>
          </div>
        </div>
        <div class="image-card">
          <div>
             <img src="company/employer4.avif" height="200" width="300">
            Well-being Employers<br>
            <small>Maximizing Productivity</small>
          </div>
        </div>
        <div class="image-card">
          <div>
            <img src="company/epploye5.jpg" height="200" width="300">
            Peak performance when required<br>
            <small>Maintain punctuality</small>
          </div>
        </div>
      </div>
    </div>
  </section>
  
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
        
        <div class="about-stats">
            <div class="stat-card">
                <div class="stat-number"><?php echo $countsek; ?></div>
                <div class="stat-label">Job Seekers</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $countcomp; ?></div>
                <div class="stat-label">Companies</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $countjob; ?></div>
                <div class="stat-label">Jobs Found</div>
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