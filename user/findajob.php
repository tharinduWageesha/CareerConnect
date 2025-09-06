<?php
require '../includes/config.php';

// Handle search and filters
$searchKeyword = $_GET['search'] ?? '';
$locationFilter = $_GET['location'] ?? '';
$jobTypeFilter = $_GET['job_type'] ?? '';
$experienceFilter = $_GET['experience'] ?? '';
$companyFilter = $_GET['company'] ?? '';

// Build the WHERE clause
$whereConditions = [];
$params = [];

if (!empty($searchKeyword)) {
    $whereConditions[] = "(jobTitle LIKE ? OR description LIKE ?)";
    $params[] = "%$searchKeyword%";
    $params[] = "%$searchKeyword%";
}

if (!empty($locationFilter)) {
    $whereConditions[] = "location LIKE ?";
    $params[] = "%$locationFilter%";
}

if (!empty($jobTypeFilter)) {
    $whereConditions[] = "jobType = ?";
    $params[] = $jobTypeFilter;
}

if (!empty($experienceFilter)) {
    $whereConditions[] = "experience = ?";
    $params[] = $experienceFilter;
}

if (!empty($companyFilter)) {
    $whereConditions[] = "company LIKE ?";
    $params[] = "%$companyFilter%";
}

// Construct the query
$whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
$sql = "SELECT * FROM jobs $whereClause ORDER BY id DESC";

// Prepare and execute the query
if (!empty($params)) {
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} else {
    $result = mysqli_query($conn, $sql);
}

$jobs = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }
}

// Get unique values for filter dropdowns
$locations = [];
$companies = [];
$locationQuery = mysqli_query($conn, "SELECT DISTINCT location FROM jobs WHERE location IS NOT NULL AND location != ''");
$companyQuery = mysqli_query($conn, "SELECT DISTINCT company FROM jobs WHERE company IS NOT NULL AND company != ''");

if ($locationQuery) {
    while ($row = mysqli_fetch_assoc($locationQuery)) {
        $locations[] = $row['location'];
    }
}

if ($companyQuery) {
    while ($row = mysqli_fetch_assoc($companyQuery)) {
        $companies[] = $row['company'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Job - CareerConnect</title>
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
            line-height: 1.6;
        }

        /* Header Styles */
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

        .nav-links li a:hover,
        .nav-links li a.active {
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
        }

        .nav-links button:hover {
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(135, 206, 235, 0.4);
        }

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            min-height: calc(100vh - 200px);
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: #1a202c;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #1a202c 0%, #87ceeb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-header p {
            font-size: 1.2rem;
            color: #5f9ab1;
        }

        /* Search Section */
        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border: 2px solid rgba(135, 206, 235, 0.1);
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1a202c;
        }

        .form-group input,
        .form-group select {
            padding: 0.8rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #87ceeb;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(135, 206, 235, 0.1);
        }

        .search-btn {
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(135, 206, 235, 0.3);
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(135, 206, 235, 0.4);
        }

        .clear-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
        }

        .clear-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        /* Results Section */
        .results-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #87ceeb;
        }

        .results-count {
            font-size: 1.1rem;
            color: #1a202c;
            font-weight: 600;
        }

        .results-count strong {
            color: #87ceeb;
        }

        /* Job Cards */
        .jobs-container {
            display: grid;
            gap: 1.5rem;
        }

        .job-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(135, 206, 235, 0.1);
            position: relative;
            overflow: hidden;
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(135, 206, 235, 0.15);
            border-color: #87ceeb;
        }

        .job-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1.5rem;
        }

        .job-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .job-title:hover {
            color: #87ceeb;
        }

        .company-name {
            font-size: 1.1rem;
            color: #5f9ab1;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .job-location {
            color: #6b7280;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .job-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .meta-tag {
            background: rgba(135, 206, 235, 0.1);
            color: #1a202c;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid rgba(135, 206, 235, 0.2);
        }

        .meta-tag.salary {
            background: rgba(72, 187, 120, 0.1);
            color: #2f855a;
            border-color: rgba(72, 187, 120, 0.2);
        }

        .job-description {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .job-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .apply-btn {
            background: linear-gradient(135deg, #87ceeb 0%, #5dade2 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(135, 206, 235, 0.4);
        }

        .view-details {
            color: #87ceeb;
            text-decoration: none;
            font-weight: 600;
            padding: 0.8rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .view-details:hover {
            background: rgba(135, 206, 235, 0.1);
            border-color: #87ceeb;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .no-results h3 {
            font-size: 1.5rem;
            color: #1a202c;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #6b7280;
            font-size: 1.1rem;
        }

        /* Footer Styles */
        footer {
            background-color: #83A2B2;
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
            background-color: #1a202c;
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
            border-top: 1px solid #6b7280;
            padding-top: 20px;
            text-align: center;
        }

        .footer-bottom p {
            color: #dfdfdf;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .search-form {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                gap: 1rem;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .job-header {
                flex-direction: column;
                align-items: start;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
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
                 <li><a href="userhomepage.php" >Home</a></li>
                <li><a href="findajob.php" class="active">Find a Job</a></li>
                 <li><a href="myapplications.php">My Applications</a></li>
                 <li><a href="help.php">Help</a></li>
                <li><a href="myaccount.php">My Account</a></li>
                <button onclick="window.location.href='../login.php'">Log Out</button>
             </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>Find Your Dream Job</h1>
            <p>Discover thousands of job opportunities from top companies</p>
        </div>

        <!-- Search Section -->
        <div class="search-section">
            <form class="search-form" method="GET" action="">
                <div class="form-group">
                    <label for="search">Keywords</label>
                    <input type="text" id="search" name="search" placeholder="Job title, skills, company..." 
                           value="<?= htmlspecialchars($searchKeyword) ?>">
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <select id="location" name="location">
                        <option value="">All Locations</option>
                        <?php foreach ($locations as $location): ?>
                            <option value="<?= htmlspecialchars($location) ?>" 
                                    <?= $locationFilter === $location ? 'selected' : '' ?>>
                                <?= htmlspecialchars($location) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="job_type">Job Type</label>
                    <select id="job_type" name="job_type">
                        <option value="">All Types</option>
                        <option value="Full-time" <?= $jobTypeFilter === 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                        <option value="Part-time" <?= $jobTypeFilter === 'Part-time' ? 'selected' : '' ?>>Part-time</option>
                        <option value="Contract" <?= $jobTypeFilter === 'Contract' ? 'selected' : '' ?>>Contract</option>
                        <option value="Internship" <?= $jobTypeFilter === 'Internship' ? 'selected' : '' ?>>Internship</option>
                        <option value="Remote" <?= $jobTypeFilter === 'Remote' ? 'selected' : '' ?>>Remote</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="experience">Experience</label>
                    <select id="experience" name="experience">
                        <option value="">All Levels</option>
                        <option value="Entry Level" <?= $experienceFilter === 'Entry Level' ? 'selected' : '' ?>>Entry Level</option>
                        <option value="Mid Level" <?= $experienceFilter === 'Mid Level' ? 'selected' : '' ?>>Mid Level</option>
                        <option value="Senior Level" <?= $experienceFilter === 'Senior Level' ? 'selected' : '' ?>>Senior Level</option>
                        <option value="Executive" <?= $experienceFilter === 'Executive' ? 'selected' : '' ?>>Executive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="company">Company</label>
                    <select id="company" name="company">
                        <option value="">All Companies</option>
                        <?php foreach ($companies as $company): ?>
                            <option value="<?= htmlspecialchars($company) ?>" 
                                    <?= $companyFilter === $company ? 'selected' : '' ?>>
                                <?= htmlspecialchars($company) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <button type="submit" class="search-btn">🔍 Search Jobs</button>
                    <button type="button" class="clear-btn" onclick="clearFilters()">Clear</button>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div class="results-section">
            <div class="results-header">
                <div class="results-count">
                    Found <strong><?= count($jobs) ?></strong> job<?= count($jobs) !== 1 ? 's' : '' ?>
                    <?php if ($searchKeyword || $locationFilter || $jobTypeFilter || $experienceFilter || $companyFilter): ?>
                        matching your criteria
                    <?php endif; ?>
                </div>
            </div>

            <div class="jobs-container">
                <?php if (empty($jobs)): ?>
                    <div class="no-results">
                        <h3>No jobs found</h3>
                        <p>Try adjusting your search criteria or browse all available positions.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($jobs as $job): ?>
                        <div class="job-card">
                            <div class="job-header">
                                <div>
                                    <h2 class="job-title"><?= htmlspecialchars($job['jobTitle']) ?></h2>
                                    <div class="company-name"><?= htmlspecialchars($job['company']) ?></div>
                                    <div class="job-location">📍 <?= htmlspecialchars($job['location']) ?></div>
                                </div>
                            </div>

                            <div class="job-meta">
                                <span class="meta-tag"><?= htmlspecialchars($job['jobType']) ?></span>
                                <span class="meta-tag"><?= htmlspecialchars($job['experience']) ?></span>
                                <?php if (!empty($job['salary'])): ?>
                                    <span class="meta-tag salary">💰 <?= htmlspecialchars($job['salary']) ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="job-description">
                                <?= nl2br(htmlspecialchars($job['description'])) ?>
                            </div>

                            <div class="job-actions">
                                <a href="applyjob.php?job_id=<?= $job['id'] ?>" class="apply-btn">
                                    ✉️ Apply Now
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <script>
        function clearFilters() {
            // Clear all form inputs
            document.getElementById('search').value = '';
            document.getElementById('location').value = '';
            document.getElementById('job_type').value = '';
            document.getElementById('experience').value = '';
            document.getElementById('company').value = '';
            
            // Redirect to page without parameters
            window.location.href = 'findajob.php';
        }

        // Add some interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add search on Enter key
            document.getElementById('search').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.querySelector('.search-form').submit();
                }
            });

            // Add loading state to search button
            document.querySelector('.search-btn').addEventListener('click', function() {
                this.innerHTML = '🔄 Searching...';
                this.disabled = true;
                
                setTimeout(() => {
                    document.querySelector('.search-form').submit();
                }, 500);
            });
        });
    </script>
</body>
</html>