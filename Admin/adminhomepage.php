<?php
// 1. Include the database connection
include 'db.php';

// 2. Fetch data for the dashboard stats
// Fetch total users
$userResult = $conn->query("SELECT COUNT(*) as total FROM users");
$totalUsers = $userResult->fetch_assoc()['total'];

// Fetch total companies (using the new 'companies' table)
$companyResult = $conn->query("SELECT COUNT(*) as total FROM companies");
$totalCompanies = $companyResult->fetch_assoc()['total'];

// Fetch total job listings
$jobResult = $conn->query("SELECT COUNT(*) as total FROM jobs");
$totalJobs = $jobResult->fetch_assoc()['total'];

// Fetch total applications
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
  <style>
    .banner-container {
      position: relative;
      width: 100%;
      overflow: hidden;
    }
    
    .banner-container img {
      width: 100%;
      height: auto;
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
        <li><a href="adminhomepage.php">Home</a></li>
        <li><a href="manage_employees.php">Manage Employees</a></li>
        <li><a href="manage_companies.php">Manage Companies</a></li>
        <li><a href="help.html">Help</a></li>
        <li><a href="my_account.php">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
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

</body>
</html>