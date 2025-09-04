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
            background-color: white;
            color: #87ceeb;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-edit:hover {
            background-color: #f0f0f0;
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

        /* Company Description */
        .company-description {
            grid-column: span 2;
        }

        .description-text {
            color: #555;
            line-height: 1.6;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #87ceeb;
        }

        /* Account Status */
        .account-status {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .status-header {
            font-size: 20px;
            color: black;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .status-items {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .status-item {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #eee;
        }

        .status-item.active {
            border-color: #27ae60;
            background-color: #d4edda;
        }

        .status-item.warning {
            border-color: #f39c12;
            background-color: #fff3cd;
        }

        .status-item.inactive {
            border-color: #e74c3c;
            background-color: #f8d7da;
        }

        .status-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .status-item.active .status-icon {
            color: #27ae60;
        }

        .status-item.warning .status-icon {
            color: #f39c12;
        }

        .status-item.inactive .status-icon {
            color: #e74c3c;
        }

        .status-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .status-item.active .status-title {
            color: #155724;
        }

        .status-item.warning .status-title {
            color: #856404;
        }

        .status-item.inactive .status-title {
            color: #721c24;
        }

        .status-description {
            font-size: 14px;
            color: #666;
        }

        /* Action Buttons */
        .account-actions {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .actions-header {
            font-size: 20px;
            color: black;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .action-btn {
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background-color: #87ceeb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #5dade2;
        }

        .btn-secondary {
            background-color: #34495e;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #2c3e50;
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
        }

        .btn-warning:hover {
            background-color: #d68910;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .account-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .company-description {
                grid-column: span 1;
            }

            .status-items {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .actions-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .profile-stats {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        /* Success/Error Messages */
        .message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
        <li><a href="companyhomepage.php" >Home</a></li>
        <li><a href="postajob.php">Post a Job</a></li>
        <li><a href="viewapplications.php">View Applications</a></li>
        <li><a href="#people">Help</a></li>
        <li><a href="myaccountpage.php" class="active">My Account</a></li>
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
                <div class="profile-avatar">TC</div>
                <div class="company-name">TechCorp Solutions</div>
                <div class="company-type">Technology Company</div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Active Jobs</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">245</div>
                        <div class="stat-label">Total Applications</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">38</div>
                        <div class="stat-label">Hired</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">4.8</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="account-details">
                <div class="section-header">
                    Company Information
                    <button class="btn-edit" onclick="editProfile()">✏️ Edit</button>
                </div>
                
                <div class="details-content">
                    <div class="details-grid">
                        <div class="detail-group">
                            <div class="detail-label">Company Name</div>
                            <div class="detail-value">TechCorp Solutions Ltd.</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Industry</div>
                            <div class="detail-value">Information Technology</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Company Size</div>
                            <div class="detail-value">51-200 employees</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Founded</div>
                            <div class="detail-value">2015</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Email Address</div>
                            <div class="detail-value">hr@techcorp.com</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Phone Number</div>
                            <div class="detail-value">+1 (555) 123-4567</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Website</div>
                            <div class="detail-value">www.techcorp.com</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">San Francisco, CA, USA</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Registration Date</div>
                            <div class="detail-value">January 15, 2024</div>
                        </div>
                        
                        <div class="detail-group">
                            <div class="detail-label">Last Updated</div>
                            <div class="detail-value">March 10, 2024</div>
                        </div>
                        
                        <div class="detail-group company-description">
                            <div class="detail-label">Company Description</div>
                            <div class="description-text">
                                TechCorp Solutions is a leading technology company specializing in innovative software development and digital transformation services. We help businesses modernize their operations through cutting-edge technology solutions, cloud services, and custom software development. Our team of experienced developers and consultants work closely with clients to deliver exceptional results that drive business growth and success.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="account-status">
            <div class="status-header">Account Status</div>
            <div class="status-items">
                <div class="status-item active">
                    <div class="status-icon">✅</div>
                    <div class="status-title">Account Verified</div>
                    <div class="status-description">Your company account is verified and active</div>
                </div>
                
                <div class="status-item warning">
                    <div class="status-icon">⚠️</div>
                    <div class="status-title">Profile Incomplete</div>
                    <div class="status-description">Add more details to improve visibility</div>
                </div>
                
                <div class="status-item active">
                    <div class="status-icon">💳</div>
                    <div class="status-title">Subscription Active</div>
                    <div class="status-description">Premium plan expires on Dec 15, 2024</div>
                </div>
            </div>
        </div>

        <!-- Account Actions -->
        <div class="account-actions">
            <div class="actions-header">Account Management</div>
            <div class="actions-grid">
                <button class="action-btn btn-primary" onclick="editProfile()">
                    👤 Edit Profile
                </button>
                
                <button class="action-btn btn-primary" onclick="changePassword()">
                    🔒 Change Password
                </button>
                
                <button class="action-btn btn-secondary" onclick="viewBilling()">
                    💰 Billing & Subscription
                </button>
                
                <button class="action-btn btn-secondary" onclick="downloadData()">
                    📥 Download My Data
                </button>
                
                <button class="action-btn btn-warning" onclick="deactivateAccount()">
                    ⏸️ Deactivate Account
                </button>
                
                <button class="action-btn btn-danger" onclick="deleteAccount()">
                    🗑️ Delete Account
                </button>
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

    <script>
        // Edit profile function
        function editProfile() {
            showMessage('Redirecting to profile edit page...', 'success');
            // In real application, this would redirect to edit profile page
        }

        // Change password function
        function changePassword() {
            showMessage('Redirecting to change password page...', 'success');
            // In real application, this would open password change form
        }

        // View billing function
        function viewBilling() {
            showMessage('Opening billing and subscription details...', 'success');
            // In real application, this would show billing information
        }

        // Download data function
        function downloadData() {
            showMessage('Preparing your data download...', 'success');
            // In real application, this would generate and download user data
        }

        // Deactivate account function
        function deactivateAccount() {
            if (confirm('Are you sure you want to deactivate your account? You can reactivate it later.')) {
                showMessage('Account deactivation process started...', 'success');
                // In real application, this would deactivate the account
            }
        }

        // Delete account function
        function deleteAccount() {
            if (confirm('Are you sure you want to permanently delete your account? This action cannot be undone!')) {
                if (confirm('This will permanently delete all your data. Are you absolutely sure?')) {
                    showMessage('Account deletion process started...', 'error');
                    // In real application, this would delete the account
                }
            }
        }

        // Show message function
        function showMessage(message, type) {
            const messageElement = type === 'success' ? 
                document.getElementById('successMessage') : 
                document.getElementById('errorMessage');
            
            messageElement.textContent = message;
            messageElement.style.display = 'block';
            
            // Hide message after 3 seconds
            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 3000);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Any initialization code would go here
        });
    </script>
</body>
</html>