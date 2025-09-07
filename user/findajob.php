<?php
require '../includes/config.php';

$searchKeyword = $_GET['search'] ?? '';
$locationFilter = $_GET['location'] ?? '';
$jobTypeFilter = $_GET['job_type'] ?? '';
$experienceFilter = $_GET['experience'] ?? '';
$companyFilter = $_GET['company'] ?? '';

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

$whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';
$sql = "SELECT * FROM jobs $whereClause ORDER BY id DESC";

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
    <link rel="stylesheet" href="../includes/navfooter.css">
    <link rel="stylesheet" href="findajob.css">
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
                 <li><a href="userhomepage.php" >Home</a></li>
                <li><a href="findajob.php" class="active">Find a Job</a></li>
                 <li><a href="myapplications.php">My Applications</a></li>
                 <li><a href="help.php">Help</a></li>
                <li><a href="myaccount.php">My Account</a></li>
                <button onclick="window.location.href='../login.php'">Log Out</button>
             </ul>
        </nav>
    </header>

    <div class="main-container">
        <div class="page-header">
            <h1>Find Your Dream Job</h1>
            <p>Discover thousands of job opportunities from top companies</p>
        </div>

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
            document.getElementById('search').value = '';
            document.getElementById('location').value = '';
            document.getElementById('job_type').value = '';
            document.getElementById('experience').value = '';
            document.getElementById('company').value = '';
            
            window.location.href = 'findajob.php';
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('search').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.querySelector('.search-form').submit();
                }
            });

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