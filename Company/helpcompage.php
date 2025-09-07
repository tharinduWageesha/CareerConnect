<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - CareerConnect</title>
    <link rel="stylesheet" href="../includes/navfooter.css">
    <link rel="stylesheet" href="helpcompage.css">
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
             <li><a href="viewapplications.php">View Applications</a></li>
             <li><a href="helpcompage.php" class="active">Help</a></li>
             <li><a href="myaccountpage.php">My Account</a></li>
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
            <div class="nav-card" onclick="scrollToSection('post-job')">
                <div class="nav-icon">📝</div>
                <div class="nav-title">Post a Job</div>
                <div class="nav-description">Learn how to create and manage job postings</div>
            </div>
            <div class="nav-card" onclick="scrollToSection('view-applications')">
                <div class="nav-icon">📋</div>
                <div class="nav-title">View Applications</div>
                <div class="nav-description">Manage and review candidate applications</div>
            </div>
            <div class="nav-card" onclick="scrollToSection('my-account')">
                <div class="nav-icon">👤</div>
                <div class="nav-title">My Account</div>
                <div class="nav-description">Update your company profile and settings</div>
            </div>
        </div>

        <!-- Post a Job Section -->
        <div class="help-section" id="post-job">
            <div class="section-header" onclick="toggleSection(this)">
                📝 How to Post a Job
                <span class="expand-icon">−</span>
            </div>
            <div class="section-content">
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-title">Fill in Job Details</div>
                        <div class="step-description">Start by entering the basic job information in the form on the left side of the page.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Use clear, specific job titles like "Frontend Developer" instead of generic terms like "Developer".
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Select Job Type and Experience Level</div>
                        <div class="step-description">Choose the appropriate job type (Full-time, Part-time, Contract, Remote, Internship) and required experience level.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Remote jobs typically get more applications, so be specific about location requirements.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Write a Detailed Job Description</div>
                        <div class="step-description">Include responsibilities, requirements, benefits, and company culture in the description box.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Mention specific skills, tools, and qualifications. Include salary range if possible to attract serious candidates.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Review and Post</div>
                        <div class="step-description">Double-check all information and click "Post Job". Your job will appear in the "Your Posted Jobs" section on the right.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> You can edit or delete posted jobs anytime using the buttons on each job card.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Delete Jobs</div>
                        <div class="step-description">Use "Delete" button to remove a posting.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Keep job postings updated. Remove filled positions to avoid unnecessary applications.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Applications Section -->
        <div class="help-section" id="view-applications">
            <div class="section-header" onclick="toggleSection(this)">
                📋 How to View and Manage Applications
                <span class="expand-icon">−</span>
            </div>
            <div class="section-content">
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-title">Understanding the Dashboard</div>
                        <div class="step-description">The top section shows summary cards with total applications, pending reviews, accepted, and rejected applications.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Monitor pending applications regularly to provide timely responses to candidates.
                        </div>
                    </div>
                    
                    
                    <div class="step-item">
                        <div class="step-title">Reviewing Application Details</div>
                        <div class="step-description">Each application card shows candidate name, contact information, experience, expected salary, and cover letter.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Pay attention to cover letters - they often show candidate motivation and communication skills.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Taking Action on Applications</div>
                        <div class="step-description">Use the action buttons to view resumes, contact candidates, accept, or reject applications.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Always provide feedback when rejecting applications. It helps candidates improve and reflects well on your company.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Contacting Candidates</div>
                        <div class="step-description">Click "Contact" to reach out to promising candidates for interviews or additional information.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Respond to applications within 1-2 weeks to maintain a positive candidate experience.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Account Section -->
        <div class="help-section" id="my-account">
            <div class="section-header" onclick="toggleSection(this)">
                👤 How to Manage Your Account
                <span class="expand-icon">−</span>
            </div>
            <div class="section-content">
                <div class="step-list">
                    <div class="step-item">
                        <div class="step-title">Understanding Your Profile Summary</div>
                        <div class="step-description">The left side shows your company avatar, key statistics like active jobs, total applications, hired candidates, and company rating.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> A complete profile with good statistics helps attract better candidates to your job postings.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Viewing Company Information</div>
                        <div class="step-description">Review all your company details including contact information, industry, company size, and description.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Keep your company description updated and engaging - candidates read this before applying.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Checking Account Status</div>
                        <div class="step-description">Monitor your account verification, profile completion, and subscription status in the status section.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Address any warnings (like incomplete profile) to improve your visibility on the platform.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Editing Your Profile</div>
                        <div class="step-description">Click "Edit Profile" to update company information, add details, or change your company description.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Regularly update your profile to reflect company growth, new services, or achievements.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Managing Account Security</div>
                        <div class="step-description">Use "Change Password" to update your login credentials. Consider doing this every 3-6 months for security.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Use a strong password with a mix of letters, numbers, and symbols for better security.
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-title">Billing and Subscriptions</div>
                        <div class="step-description">Access billing information, view subscription details, and manage payment methods.</div>
                        <div class="step-tip">
                            <span class="tip-icon">💡</span>
                            <strong>Tip:</strong> Monitor your subscription expiry date to ensure uninterrupted service.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <div class="faq-header">Frequently Asked Questions</div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    How long do job postings stay active? 
                    <span class="expand-icon">+</span>
                </div>
                <div class="faq-answer">
                    Job postings remain active for 30 days by default. You can edit, renew, or delete them anytime from the Post a Job page.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    Can I edit a job posting after it's published?
                    <span class="expand-icon">+</span>
                </div>
                <div class="faq-answer">
                    Yes! Click the "Edit" button on any job card in your Posted Jobs section. This will load the job details into the form for editing.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    How do I know when someone applies to my job?
                    <span class="expand-icon">+</span>
                </div>
                <div class="faq-answer">
                    You'll receive email notifications for new applications. You can also check the View Applications page regularly to see new applications.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    What happens when I accept or reject an application?
                    <span class="expand-icon">+</span>
                </div>
                <div class="faq-answer">
                    The candidate will receive an email notification about your decision. Accepted candidates can then be contacted for next steps, while rejected applications are archived.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    How can I improve my company profile visibility?
                    <span class="expand-icon">+</span>
                </div>
                <div class="faq-answer">
                    Complete all profile sections, add a detailed company description, keep job postings updated, and maintain good response times to applications.
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="support-section">
            <div class="support-title">Still Need Help?</div>
            <div class="support-description">Our support team is here to help you succeed</div>
            
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
                    <div class="support-card-description">Call us for urgent issues<br>+1 (555) 123-HELP</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" onclick="scrollToTop()" id="scrollTopBtn">↑</button>
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

    <script>
        // Toggle section content
        function toggleSection(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector('.expand-icon');
            
            if (content.style.display === 'none' || content.classList.contains('collapsed')) {
                content.style.display = 'block';
                content.classList.remove('collapsed');
                icon.textContent = '−';
            } else {
                content.style.display = 'none';
                content.classList.add('collapsed');
                icon.textContent = '+';
            }
        }

        // Toggle FAQ answers
        function toggleFAQ(question) {
            const answer = question.nextElementSibling;
            const icon = question.querySelector('.expand-icon');
            
            if (answer.classList.contains('show')) {
                answer.classList.remove('show');
                icon.textContent = '+';
            } else {
                // Close all other FAQ items
                document.querySelectorAll('.faq-answer').forEach(item => {
                    item.classList.remove('show');
                });
                document.querySelectorAll('.faq-question .expand-icon').forEach(item => {
                    item.textContent = '+';
                });
                
                // Open clicked item
                answer.classList.add('show');
                icon.textContent = '−';
            }
        }

        // Scroll to section
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
                
                // Ensure section is expanded
                const header = section.querySelector('.section-header');
                const content = section.querySelector('.section-content');
                const icon = section.querySelector('.expand-icon');
                
                if (content.style.display === 'none' || content.classList.contains('collapsed')) {
                    content.style.display = 'block';
                    content.classList.remove('collapsed');
                    icon.textContent = '−';
                }
            }
        }

        // Contact support functions
        function contactSupport(method) {
            switch(method) {
                case 'email':
                    window.location.href = 'mailto:support@careerconnect.com';
                    break;
                case 'chat':
                    alert('Live chat feature coming soon! Please use email support for now.');
                    break;
                case 'phone':
                    alert('Phone: +1 (555) 123-HELP\nAvailable: Monday-Friday, 9 AM - 6 PM');
                    break;
            }
        }

        // Scroll to top functionality
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Show/hide scroll to top button
        window.addEventListener('scroll', function() {
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            if (window.pageYOffset > 300) {
                scrollTopBtn.style.display = 'block';
            } else {
                scrollTopBtn.style.display = 'none';
            }
        });

        // Search functionality
        document.querySelector('.search-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value.toLowerCase();
                if (searchTerm.includes('post') || searchTerm.includes('job')) {
                    scrollToSection('post-job');
                } else if (searchTerm.includes('application') || searchTerm.includes('view')) {
                    scrollToSection('view-applications');
                } else if (searchTerm.includes('account') || searchTerm.includes('profile')) {
                    scrollToSection('my-account');
                }
            }
        });

        document.querySelector('.search-button').addEventListener('click', function() {
            const searchTerm = document.querySelector('.search-input').value.toLowerCase();
            if (searchTerm.includes('post') || searchTerm.includes('job')) {
                scrollToSection('post-job');
            } else if (searchTerm.includes('application') || searchTerm.includes('view')) {
                scrollToSection('view-applications');
            } else if (searchTerm.includes('account') || searchTerm.includes('profile')) {
                scrollToSection('my-account');
            }
        });
    </script>
</body>
</html>