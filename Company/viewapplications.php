<?php
require_once '../includes/config.php';

function getCount($conn, $sql) {
    $result = $conn->query($sql);
    if (!$result) {
        die("SQL Error: " . $conn->error);
    }
    return $result->fetch_row()[0];
}

$totapp = getCount($conn, "SELECT COUNT(*) FROM applications WHERE username = '" . $_SESSION['companyName'] . "'");
$accapp  = getCount($conn, "SELECT COUNT(*) FROM applications WHERE username = '" . $_SESSION['companyName'] . "' AND status = 'accepted'");
$pendapp = getCount($conn, "SELECT COUNT(*) FROM applications WHERE username = '" . $_SESSION['companyName'] . "' AND status = 'pending'");
$rejapp  = getCount($conn, "SELECT COUNT(*) FROM applications WHERE username = '" . $_SESSION['companyName'] . "' AND status = 'rejected'");

if (isset($_POST['action'], $_POST['application_id'])) {
    $appId = intval($_POST['application_id']);
    $newStatus = $_POST['action'] === 'accept' ? 'accepted' : 'rejected';

    $stmt = $conn->prepare("UPDATE applications SET status = ? WHERE application_id = ?");
    $stmt->bind_param("si", $newStatus, $appId);
    $stmt->execute();
    $stmt->close();

    header("Location: viewapplications.php");
    exit();
}

$companyName = $_SESSION['companyName']; 
$apps = $conn->query("SELECT * FROM applications Where username = '" . $_SESSION['companyName'] . "' ORDER BY applied_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications - CareerConnect</title>
    <link rel="stylesheet" href="viewapplication.css">
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
                <li><a href="postajob.php">Post a Job</a></li>
                <li><a href="viewapplications.php" class="active">View Applications</a></li>
                <li><a href="helpcompage.php">Help</a></li>
                <li><a href="myaccountpage.php">My Account</a></li>
                <button onclick="window.location.href='../login.php'">Log Out</button>
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <div class="page-title">
            <h1>View Applications</h1>
            <p>Manage applications for your job postings</p>
        </div>
        
        <div class="summary-section">
            <div class="summary-card">
                <div class="summary-number" id="totalApplications"><?php echo $totapp; ?></div>
                <div class="summary-label">Total Applications</div>
            </div>
            <div class="summary-card pending">
                <div class="summary-number" id="pendingApplications"><?php echo $pendapp; ?></div>
                <div class="summary-label">Pending Review</div>
            </div>
            <div class="summary-card accepted">
                <div class="summary-number" id="acceptedApplications"><?php echo $accapp; ?></div>
                <div class="summary-label">Accepted</div>
            </div>
            <div class="summary-card rejected">
                <div class="summary-number" id="rejectedApplications"><?php echo $rejapp; ?></div>
                <div class="summary-label">Rejected</div>
            </div>
        </div>

        <div class="applications-section">
            <div class="section-header">Recent Applications</div>

            <?php if ($apps->num_rows > 0): ?>
                <?php while ($row = $apps->fetch_assoc()): ?>
                    <div class="application-card">
                        <div class="application-header">
                            <div class="applicant-info">
                                <h3><?php echo $row['Empname']; ?></h3>
                                <div class="job-title">Job ID: <?php echo $row['job_id']; ?></div>
                            </div>
                            <div class="application-status status-<?php echo $row['status']; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </div>
                        </div>

                        <div class="application-details">
                            <div class="detail-item"><strong>Email:</strong> <?php echo $row['email']; ?></div>
                            <div class="detail-item"><strong>Phone:</strong> <?php echo $row['phone']; ?></div>
                            <div class="detail-item"><strong>Experience:</strong> <?php echo $row['experience']; ?></div>
                            <div class="detail-item"><strong>Location:</strong> <?php echo $row['location']; ?></div>
                            <div class="detail-item"><strong>Expected Salary:</strong> <?php echo $row['salary']; ?></div>
                            <div class="detail-item"><strong>Applied Date:</strong> <?php echo $row['applied_at']; ?></div>
                        </div>

                        <div class="cover-letter">
                            <h4>Cover Letter</h4>
                            <p><?php echo nl2br(htmlspecialchars($row['cover_letter'])); ?></p>
                        </div>

                        <div class="application-actions">
                            <?php if ($row['resume_path']): ?>
                                <a class="btn-action btn-view" href="<?php echo $row['resume_path']; ?>" target="_blank">View Resume</a>
                            <?php endif; ?>

                            <form method="post" style="display:inline;">
                                <input type="hidden" name="application_id" value="<?php echo $row['application_id']; ?>">
                                <button type="submit" name="action" value="accept" class="btn-action btn-accept">Accept</button>
                                <button type="submit" name="action" value="reject" class="btn-action btn-reject">Reject</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-applications">No applications found.</div>
            <?php endif; ?>
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