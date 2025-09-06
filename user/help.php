<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - CareerConnect</title>
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
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Page Title */
        .page-title {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: center;
        }

        .page-title h1 {
            font-size: 36px;
            color: black;
            margin-bottom: 15px;
        }

        .page-title p {
            color: #87ceeb;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .search-box {
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #87ceeb;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
        }

        .search-button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #87ceeb;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #5dade2;
        }

        /* Quick Navigation */
        .quick-nav {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .nav-card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(135, 206, 235, 0.3);
        }

        .nav-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #87ceeb;
        }

        .nav-title {
            font-size: 20px;
            color: black;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .nav-description {
            color: #666;
            font-size: 14px;
        }

        /* Help Sections */
        .help-section {
            background-color: white;
            margin-bottom: 30px;
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
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .section-header:hover {
            background-color: #5dade2;
        }

        .expand-icon {
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .section-content {
            padding: 30px;
            display: block;
        }

        .section-content.collapsed {
            display: none;
        }

        .step-list {
            counter-reset: step-counter;
        }

        .step-item {
            counter-increment: step-counter;
            margin-bottom: 25px;
            position: relative;
            padding-left: 60px;
        }

        .step-item::before {
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 0;
            background-color: #87ceeb;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .step-title {
            font-size: 18px;
            color: black;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .step-description {
            color: #555;
            margin-bottom: 10px;
        }

        .step-tip {
            background-color: #e8f4fd;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #87ceeb;
            font-size: 14px;
            color: #2c5282;
        }

        .tip-icon {
            color: #87ceeb;
            font-weight: bold;
            margin-right: 5px;
        }

        /* FAQ Section */
        .faq-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .faq-header {
            background-color: black;
            color: white;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .faq-item {
            border-bottom: 1px solid #eee;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            padding: 20px;
            background-color: #f9f9f9;
            cursor: pointer;
            font-weight: bold;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .faq-question:hover {
            background-color: #f0f0f0;
        }

        .faq-answer {
            padding: 20px;
            color: #555;
            display: none;
        }

        .faq-answer.show {
            display: block;
        }

        /* Contact Support */
        .support-section {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .support-title {
            font-size: 24px;
            color: black;
            margin-bottom: 15px;
        }

        .support-description {
            color: #666;
            margin-bottom: 25px;
        }

        .support-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .support-card {
            padding: 25px;
            border: 2px solid #eee;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .support-card:hover {
            border-color: #87ceeb;
            background-color: #f8fafc;
            transform: translateY(-2px);
        }

        .support-card-icon {
            font-size: 32px;
            color: #87ceeb;
            margin-bottom: 10px;
        }

        .support-card-title {
            font-weight: bold;
            color: black;
            margin-bottom: 5px;
        }

        .support-card-description {
            color: #666;
            font-size: 14px;
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
            transition: color 0.3s ease;
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
            transition: background-color 0.3s ease;
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

        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #87ceeb;
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            display: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .scroll-top:hover {
            background-color: #5dade2;
        }

        /* Mobile Responsive */
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

            .quick-nav {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .support-options {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .step-item {
                padding-left: 50px;
            }

            .step-item::before {
                width: 30px;
                height: 30px;
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
        <img src="../assets/images/logo2.png " height="50" width="50">
        <div>
          <strong>CareerConnect</strong>
          <div class="tagline">Connecting Careers, Building Futures.</div>
        </div>
      </div>
      
      <ul class="nav-links">
        <li><a href="userhomepage.php">Home</a></li>
        <li><a href="findajob.php">Find a Job</a></li>
        <li><a href="myapplications.php">My Applications</a></li>
        <li><a href="help.php"  class="active">Help</a></li>
        <li><a href="myaccount.php">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>


    </nav>
  </header>

    <div class="main-container">
        <!-- Page Title -->
        <div class="page-title">
            <h1>Help Center</h1>
            <p>Learn how to make the most of CareerConnect</p>
        </div>

        <!-- Quick Navigation -->
        <div class="quick-nav">
            <div class="nav-card" onclick="scrollToSection('job-search')">
                <div class="nav-icon">🔍</div>
                <div class="nav-title">Job Search</div>
                <div class="nav-description">Learn how to find and apply for jobs</div>
            </div>
            <div class="nav-card" onclick="scrollToSection('profile-management')">
                <div class="nav-icon">👤</div>
                <div class="nav-title">Profile Management</div>
                <div class="nav-description">Manage your profile and resume</div>
            </div>
            <div class="nav-card" onclick="scrollToSection('application-tracking')">
                <div class="nav-icon">📋</div>
                <div class="nav-title">Application Tracking</div>
                <div class="nav-description">Track your job applications</div>
            </div>
        </div>

        <!-- Job Search Section -->
        <div class="help-section" id="job-search">
            <div class="section-header" onclick="toggleSection(this)">
                🔍 How to Search and Apply for Jobs
                <span class="expand-icon">−</span>
            </div>
            <div class="section-content">
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-title">Browse Available Jobs</div>
                        <div class="step-description">Go to the "Find Jobs" page to see all available positions. Use filters to narrow down results by location, job type, or experience level.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Use specific keywords in your search to find more relevant job opportunities.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Read Job Details Carefully</div>
                        <div class="step-description">Click on any job card to view detailed information including requirements, responsibilities, and company details.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Make sure you meet the basic requirements before applying to increase your chances of success.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Submit Your Application</div>
                        <div class="step-description">Click "Apply Now" and fill out the application form with your details, expected salary, and cover letter.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Customize your cover letter for each job application to show genuine interest.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Upload Your Resume</div>
                        <div class="step-description">Make sure to upload an updated resume that highlights your relevant skills and experience.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Keep your resume updated and tailored to the jobs you're applying for.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Management Section -->
        <div class="help-section" id="profile-management">
            <div class="section-header" onclick="toggleSection(this)">
                👤 How to Manage Your Profile
                <span class="expand-icon">−</span>
            </div>
            <div class="section-content">
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-title">Complete Your Profile</div>
                        <div class="step-description">Fill out all sections of your profile including personal information, skills, education, and work experience.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> A complete profile increases your visibility to employers and improves job matching.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Add Your Skills</div>
                        <div class="step-description">List your technical and soft skills to help employers find you for relevant positions.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Include both technical skills and soft skills like communication and teamwork.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Upload a Professional Photo</div>
                        <div class="step-description">Add a professional headshot to make your profile more personal and trustworthy.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Use a clear, professional photo with good lighting and appropriate attire.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Keep Information Updated</div>
                        <div class="step-description">Regularly update your profile with new skills, experiences, and contact information.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Set a reminder to review and update your profile monthly.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Tracking Section -->
        <div class="help-section" id="application-tracking">
            <div class="section-header" onclick="toggleSection(this)">
                📋 How to Track Your Applications
                <span class="expand-icon">−</span>
            </div>
            <div class="section-content">
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-title">View Application Status</div>
                        <div class="step-description">Go to "My Applications" to see all jobs you've applied for and their current status.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Check your applications regularly to stay updated on any status changes.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Understand Status Types</div>
                        <div class="step-description">Applications can be Pending (under review), Accepted (moved to next stage), or Rejected (not selected).</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Don't get discouraged by rejections - they're part of the job search process.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Follow Up on Applications</div>
                        <div class="step-description">If you haven't heard back after 1-2 weeks, consider following up politely with the employer.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> A brief, professional follow-up email can show continued interest in the position.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Learn from Feedback</div>
                        <div class="step-description">When possible, ask for feedback on rejected applications to improve your future applications.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Use feedback to refine your resume and interview skills for better success rates.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Support -->
        <div class="support-section">
            <div class="support-title">Still Need Help?</div>
            <div class="support-description">Our support team is here to help you succeed in your job search</div>
            
            <div class="support-options">
                <div class="support-card" onclick="contactSupport('email')">
                    <div class="support-card-icon">📧</div>
                    <div class="support-card-title">Email Support</div>
                    <div class="support-card-description">Get detailed help via email<br>support@careerconnect.com</div>
                </div>
                
                <div class="support-card" onclick="contactSupport('chat')">
                    <div class="support-card-icon">💬</div>
                    <div class="support-card-title">Live Chat</div>
                    <div class="support-card-description">Chat with support instantly<br>Available 9 AM - 6 PM</div>
                </div>
                
                <div class="support-card" onclick="contactSupport('phone')">
                    <div class="support-card-icon">📞</div>
                    <div class="support-card-title">Phone Support</div>
                    <div class="support-card-description">Speak directly with a support agent<br>+1 (800) 123-4567</div>
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