<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applications - CareerConnect</title>
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
            padding: 0px;
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

        /* Filter Section */
        .filter-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .filter-row {
            display: flex;
            gap: 20px;
            align-items: end;
        }

        .filter-group {
            flex: 1;
        }

        .filter-group label {
            display: block;
            color: black;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            border-color: #87ceeb;
            outline: none;
        }

        .btn-filter {
            background-color: #87ceeb;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-filter:hover {
            background-color: #5dade2;
        }

        /* Applications Summary */
        .summary-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .summary-number {
            font-size: 36px;
            font-weight: bold;
            color: #87ceeb;
            margin-bottom: 10px;
        }

        .summary-label {
            color: black;
            font-weight: 500;
            font-size: 16px;
        }

        .summary-card.pending .summary-number {
            color: #f39c12;
        }

        .summary-card.accepted .summary-number {
            color: #27ae60;
        }

        .summary-card.rejected .summary-number {
            color: #e74c3c;
        }

        /* Applications List */
        .applications-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .section-header {
            background-color: #87ceeb;
            color: white;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .application-card {
            border-bottom: 1px solid #eee;
            padding: 25px;
        }

        .application-card:last-child {
            border-bottom: none;
        }

        .application-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .applicant-info h3 {
            color: black;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .job-title {
            color: #87ceeb;
            font-size: 18px;
            font-weight: bold;
        }

        .application-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-accepted {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .application-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .detail-item {
            color: #555;
        }

        .detail-label {
            color: #87ceeb;
            font-weight: bold;
        }

        .cover-letter {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .cover-letter h4 {
            color: black;
            margin-bottom: 10px;
        }

        .cover-letter p {
            color: #555;
            line-height: 1.6;
        }

        .application-actions {
            display: flex;
            gap: 15px;
        }

        .btn-action {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-accept {
            background-color: #27ae60;
            color: white;
        }

        .btn-accept:hover {
            background-color: #229954;
        }

        .btn-reject {
            background-color: #e74c3c;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c0392b;
        }

        .btn-view {
            background-color: #87ceeb;
            color: white;
        }

        .btn-view:hover {
            background-color: #5dade2;
        }

        .btn-contact {
            background-color: #34495e;
            color: white;
        }

        .btn-contact:hover {
            background-color: #2c3e50;
        }

        .no-applications {
            text-align: center;
            color: #999;
            font-size: 18px;
            padding: 60px 20px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .summary-section {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .application-header {
                flex-direction: column;
                gap: 10px;
            }

            .application-details {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .application-actions {
                flex-direction: column;
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

        /* Footer Styles */
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
             <li><a href="#people">Help</a></li>
             <li><a href="myaccountpage.php">My Account</a></li>
            <button onclick="window.location.href='../login.php'">Log Out</button>
        </ul>


    </nav>
  </header>
    <div class="main-container">
        <!-- Page Title -->
        <div class="page-title">
            <h1>View Applications</h1>
            <p>Manage applications for your job postings</p>
        </div>
        
        <!-- Success/Error Messages -->
        <div id="successMessage" class="message success-message"></div>
        <div id="errorMessage" class="message error-message"></div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="jobFilter">Filter by Job</label>
                    <select id="jobFilter">
                        <option value="">All Jobs</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Marketing Manager">Marketing Manager</option>
                        <option value="Data Analyst">Data Analyst</option>
                        <option value="UI/UX Designer">UI/UX Designer</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="statusFilter">Filter by Status</label>
                    <select id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="dateFilter">Filter by Date</label>
                    <input type="date" id="dateFilter">
                </div>
                <div class="filter-group">
                    <button class="btn-filter" onclick="filterApplications()">Filter</button>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-section">
            <div class="summary-card">
                <div class="summary-number" id="totalApplications">24</div>
                <div class="summary-label">Total Applications</div>
            </div>
            <div class="summary-card pending">
                <div class="summary-number" id="pendingApplications">15</div>
                <div class="summary-label">Pending Review</div>
            </div>
            <div class="summary-card accepted">
                <div class="summary-number" id="acceptedApplications">6</div>
                <div class="summary-label">Accepted</div>
            </div>
            <div class="summary-card rejected">
                <div class="summary-number" id="rejectedApplications">3</div>
                <div class="summary-label">Rejected</div>
            </div>
        </div>

        <!-- Applications List -->
        <div class="applications-section">
            <div class="section-header">Recent Applications</div>
            
            <div id="applicationsList">
                <!-- Application 1 -->
                <div class="application-card">
                    <div class="application-header">
                        <div class="applicant-info">
                            <h3>John Smith</h3>
                            <div class="job-title">Software Developer - Frontend</div>
                        </div>
                        <div class="application-status status-pending">Pending</div>
                    </div>
                    
                    <div class="application-details">
                        <div class="detail-item">
                            <div class="detail-label">Email:</div>
                            john.smith@email.com
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone:</div>
                            +1 (555) 123-4567
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Applied Date:</div>
                            March 15, 2024
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Experience:</div>
                            3 Years
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Location:</div>
                            New York, NY
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Expected Salary:</div>
                            $75,000
                        </div>
                    </div>

                    <div class="cover-letter">
                        <h4>Cover Letter</h4>
                        <p>I am excited to apply for the Frontend Developer position. With 3 years of experience in React and modern web technologies, I am confident I can contribute effectively to your team...</p>
                    </div>

                    <div class="application-actions">
                        <button class="btn-action btn-view" onclick="viewResume(1)">View Resume</button>
                        <button class="btn-action btn-contact" onclick="contactApplicant(1)">Contact</button>
                        <button class="btn-action btn-accept" onclick="updateStatus(1, 'accepted')">Accept</button>
                        <button class="btn-action btn-reject" onclick="updateStatus(1, 'rejected')">Reject</button>
                    </div>
                </div>

                <!-- Application 2 -->
                <div class="application-card">
                    <div class="application-header">
                        <div class="applicant-info">
                            <h3>Sarah Johnson</h3>
                            <div class="job-title">Marketing Manager</div>
                        </div>
                        <div class="application-status status-accepted">Accepted</div>
                    </div>
                    
                    <div class="application-details">
                        <div class="detail-item">
                            <div class="detail-label">Email:</div>
                            sarah.johnson@email.com
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone:</div>
                            +1 (555) 987-6543
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Applied Date:</div>
                            March 12, 2024
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Experience:</div>
                            5 Years
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Location:</div>
                            Los Angeles, CA
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Expected Salary:</div>
                            $90,000
                        </div>
                    </div>

                    <div class="cover-letter">
                        <h4>Cover Letter</h4>
                        <p>As a marketing professional with 5 years of experience in digital marketing and brand management, I am thrilled to apply for the Marketing Manager position at your company...</p>
                    </div>

                    <div class="application-actions">
                        <button class="btn-action btn-view" onclick="viewResume(2)">View Resume</button>
                        <button class="btn-action btn-contact" onclick="contactApplicant(2)">Contact</button>
                        <button class="btn-action btn-reject" onclick="updateStatus(2, 'rejected')">Reject</button>
                    </div>
                </div>

                <!-- Application 3 -->
                <div class="application-card">
                    <div class="application-header">
                        <div class="applicant-info">
                            <h3>Michael Chen</h3>
                            <div class="job-title">Data Analyst</div>
                        </div>
                        <div class="application-status status-pending">Pending</div>
                    </div>
                    
                    <div class="application-details">
                        <div class="detail-item">
                            <div class="detail-label">Email:</div>
                            michael.chen@email.com
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone:</div>
                            +1 (555) 456-7890
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Applied Date:</div>
                            March 10, 2024
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Experience:</div>
                            2 Years
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Location:</div>
                            Chicago, IL
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Expected Salary:</div>
                            $65,000
                        </div>
                    </div>

                    <div class="cover-letter">
                        <h4>Cover Letter</h4>
                        <p>I am writing to express my interest in the Data Analyst position. With a strong background in statistics and data visualization using Python and SQL...</p>
                    </div>

                    <div class="application-actions">
                        <button class="btn-action btn-view" onclick="viewResume(3)">View Resume</button>
                        <button class="btn-action btn-contact" onclick="contactApplicant(3)">Contact</button>
                        <button class="btn-action btn-accept" onclick="updateStatus(3, 'accepted')">Accept</button>
                        <button class="btn-action btn-reject" onclick="updateStatus(3, 'rejected')">Reject</button>
                    </div>
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
    <script>
        // Sample applications data
        let applications = [
            {
                id: 1,
                name: "John Smith",
                job: "Software Developer",
                email: "john.smith@email.com",
                phone: "+1 (555) 123-4567",
                date: "March 15, 2024",
                experience: "3 Years",
                location: "New York, NY",
                salary: "$75,000",
                status: "pending",
                coverLetter: "I am excited to apply for the Frontend Developer position. With 3 years of experience in React and modern web technologies, I am confident I can contribute effectively to your team..."
            }
        ];

        // Update application status function
        function updateStatus(applicationId, newStatus) {
            const statusText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            
            if (confirm(`Are you sure you want to ${newStatus === 'accepted' ? 'accept' : 'reject'} this application?`)) {
                // Find the application card and update status
                const applicationCard = document.querySelector(`[data-id="${applicationId}"]`);
                if (applicationCard) {
                    const statusElement = applicationCard.querySelector('.application-status');
                    statusElement.textContent = statusText;
                    statusElement.className = `application-status status-${newStatus}`;
                }
                
                showMessage(`Application ${newStatus === 'accepted' ? 'accepted' : 'rejected'} successfully!`, 'success');
                updateSummaryCounters();
            }
        }

        // View resume function
        function viewResume(applicationId) {
            alert(`Opening resume for application ID: ${applicationId}`);
            // In real application, this would open a PDF viewer or download the resume
        }

        // Contact applicant function
        function contactApplicant(applicationId) {
            alert(`Opening email client to contact applicant ID: ${applicationId}`);
            // In real application, this would open email client or messaging system
        }

        // Filter applications function
        function filterApplications() {
            const jobFilter = document.getElementById('jobFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const dateFilter = document.getElementById('dateFilter').value;
            
            // In real application, this would filter the applications based on criteria
            showMessage('Filters applied successfully!', 'success');
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

        // Update summary counters function
        function updateSummaryCounters() {
            // In real application, this would count from actual data
            // For now, just updating the display
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Any initialization code would go here
        });
    </script>
</body>
</html>