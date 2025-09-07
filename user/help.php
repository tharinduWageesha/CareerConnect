<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - CareerConnect</title>
    <link rel="stylesheet" href="../includes/navfooter.css">
    <link rel="stylesheet" href="help.css">
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
        <li><a href="userhomepage.php">Home</a></li>
        <li><a href="findajob.php">Find a Job</a></li>
        <li><a href="myapplications.php">My Applications</a></li>
        <li><a href="help.php" class="active">Help</a></li>
        <li><a href="myaccount.php">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>
    </nav>
  </header>

  <div class="main-container">
    <div class="page-title">
      <h1>Help Center</h1>
      <p>Learn how to make the most of CareerConnect</p>
    </div>

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
