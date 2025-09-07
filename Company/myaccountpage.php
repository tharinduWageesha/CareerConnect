<?php
require_once '../includes/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch company details
$sql = "SELECT * FROM company_details WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$company = $result->fetch_assoc();

// Fetch user account details
$sql2 = "SELECT * FROM users WHERE username = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $username);
$stmt2->execute();
$result2 = $stmt2->get_result();
$company2 = $result2->fetch_assoc();

// Insert default record if company not found
if (!$company) {
    $conn->query("INSERT INTO company_details (username, full_name, email_address) 
                  SELECT username, email FROM users WHERE username = '$username'");
    $company = $conn->query("SELECT * FROM company_details WHERE username = '$username'")->fetch_assoc();
}

// Update details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $industry = $_POST['industry'];
    $company_size = $_POST['company_size'];
    $founded = $_POST['founded'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $website = $_POST['website'];
    $location = $_POST['location'];

    $stmt = $conn->prepare("
        UPDATE company_details 
        SET full_name = ?, industry = ?, company_size = ?, founded = ?, email_address = ?, phone_number = ?, website = ?, location = ?
        WHERE username = ?
    ");
    $stmt->bind_param("sssssssss", $full_name, $industry, $company_size, $founded, $email_address, $phone_number, $website, $location, $username);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: myaccountpage.php?success=1");
        exit();
    } else {
        echo "Error updating: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - CareerConnect</title>
    <link rel="stylesheet" href="myaccountpage.css">
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
                <li><a href="companyhomepage.php" >Home</a></li>
                <li><a href="postajob.php">Post a Job</a></li>
                <li><a href="viewapplications.php">View Applications</a></li>
                <li><a href="helpcompage.php">Help</a></li>
                <li><a href="myaccountpage.php" class="active">My Account</a></li>
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
                <div class="company-name">@ <?= htmlspecialchars($username); ?></div>
                <div class="company-type"><?php echo $company2['role']; ?> Account</div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo $company2['user_id']; ?></div>
                        <div class="stat-label">User ID</div>
                    </div>
                    <div class="stat-item" style="font-size: 1px;">
                        <div class="stat-number"><?php echo $company2['created_at']; ?></div>
                        <div class="stat-label">Date Joined</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number"><?= htmlspecialchars($company['location']); ?></div>
                        <div class="stat-label">Location</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">Company</div>
                        <div class="stat-label">Role</div>
                    </div>
                </div>
        </div>

            <div class="account-details">
                <div class="section-header">
                    Company Information
                </div>

                <div class="details-content">
                    <form method="POST">
                        <div class="details-grid">
                            <div class="detail-group">
                                <div class="detail-label">Company Name</div>
                                <div class="detail-value"><input type="text" name="full_name" value="<?php echo htmlspecialchars($company['full_name']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Industry</div>
                                <div class="detail-value"><input type="text" name="industry" value="<?php echo htmlspecialchars($company['industry']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Company Size</div>
                                <div class="detail-value"><input type="text" name="company_size" value="<?php echo htmlspecialchars($company['company_size']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Founded</div>
                                <div class="detail-value"><input type="text" name="founded" value="<?php echo htmlspecialchars($company['founded']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Email Address</div>
                                <div class="detail-value"><input type="email" name="email_address" value="<?php echo htmlspecialchars($company['email_address']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Phone Number</div>
                                <div class="detail-value"><input type="text" name="phone_number" value="<?php echo htmlspecialchars($company['phone_number']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Website</div>
                                <div class="detail-value"><input type="text" name="website" value="<?php echo htmlspecialchars($company['website']); ?>"></div>
                            </div>

                            <div class="detail-group">
                                <div class="detail-label">Location</div>
                                <div class="detail-value"><input type="text" name="location" value="<?php echo htmlspecialchars($company['location']); ?>"></div>
                            </div>
                        </div>
                        <button class="btn-edit" onclick="editProfile()">Save</button>
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
</html