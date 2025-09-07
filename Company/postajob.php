<?php
require '../includes/config.php';
$statusMessage = "";
$comp_name = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_title = $_POST['jobTitle'] ?? null;
    $location  = $_POST['location'] ?? null;
    $job_type  = $_POST['jobType'] ?? null;
    $sal_range = $_POST['salary'] ?? null;
    $exp_lvl   = $_POST['experience'] ?? null;
    $job_desc  = $_POST['description'] ?? null;

    if ($job_title && $comp_name && $location && $job_type && $exp_lvl && $job_desc) {
        $sql = "INSERT INTO jobs (jobTitle, company, location, jobType, salary, experience, description)
                VALUES ('$job_title', '$comp_name', '$location', '$job_type', '$sal_range', '$exp_lvl', '$job_desc')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('✅ Job posted successfully!'); window.location.href='postajob.php';</script>";
            exit;
        } else {
            echo "<script>alert('❌ Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('⚠️ Please fill all required fields.');</script>";
    }
}

if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM jobs WHERE id = $deleteId";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('🗑️ Job deleted successfully!'); window.location.href='postajob.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error deleting job: " . mysqli_error($conn) . "');</script>";
    }
}

$companyName = $_SESSION['companyName']; 
$jobs = [];
$query = "SELECT * FROM jobs WHERE company = '$companyName' ORDER BY id DESC";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jobs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - CareerConnect</title>
    <link rel="stylesheet" href="postajob.css">
    <link rel="stylesheet" href="../includes/navfooter.css">
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
                <li><a href="companyhomepage.php">Home</a></li>
                <li><a href="postajob.php" class="active">Post a Job</a></li>
                <li><a href="viewapplications.php">View Applications</a></li>
                <li><a href="helpcompage.php">Help</a></li>
                <li><a href="myaccountpage.php">My Account</a></li>
                <button onclick="window.location.href='../login.php'">Log Out</button>
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <div class="post-job-section">
            <h2 class="section-title">Post a New Job</h2>
            
            <div id="successMessage" class="success-message"></div>
            <div id="errorMessage" class="error-message"></div>

            <form id="jobForm" method="POST" action="">
                <div class="form-group">
                    <label for="jobTitle">Job Title *</label>
                    <input type="text" id="jobTitle" name="jobTitle" required>
                </div>

                <div class="form-group">
                    <label for="company">Company Username *</label>
                    <input type="text" id="company" name="company" required value="<?php echo htmlspecialchars($comp_name); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="location">Location *</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="jobType">Job Type *</label>
                    <select id="jobType" name="jobType" required>
                        <option value="">Select Job Type</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Remote">Remote</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="salary">Salary Range (Rs.)</label>
                    <input type="text" id="salary" name="salary" placeholder="e.g., Rs 150,000 - Rs 170,000">
                </div>

                <div class="form-group">
                    <label for="experience">Experience Level *</label>
                    <select id="experience" name="experience" required>
                        <option value="">Select Experience Level</option>
                        <option value="Entry Level">Entry Level</option>
                        <option value="Mid Level">Mid Level</option>
                        <option value="Senior Level">Senior Level</option>
                        <option value="Executive">Executive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Job Description *</label>
                    <textarea id="description" name="description" placeholder="Describe the job responsibilities, requirements, and benefits..." required></textarea>
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">Post Job</button>
                <?php if (isset($statusquey)) echo "<p class='error'>$statusquey</p>"; ?>
            </form>
        </div>

        <div class="job-list-section">
            <h2 class="section-title">Your Posted Jobs</h2>
            <div id="jobList">
                <?php if (empty($jobs)) { ?>
                    <div class="no-jobs">
                        No jobs posted yet. Create your first job posting!
                    </div>
                <?php } else { ?>
                    <?php foreach ($jobs as $job) { ?>
                        <div class="job-card">
                            <h3><?php echo htmlspecialchars($job['jobTitle']); ?></h3>
                            <div class="job-info">
                                <strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?><br>
                                <strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?><br>
                                <strong>Type:</strong> <?php echo htmlspecialchars($job['jobType']); ?><br>
                                <strong>Experience:</strong> <?php echo htmlspecialchars($job['experience']); ?><br>
                                <strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?>
                            </div>
                            <p class="job-description"><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
                            <div class="job-actions">
                                <a href="postajob.php?delete=<?php echo $job['id']; ?>"
                                   class="btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this job?');">
                                   Delete
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
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