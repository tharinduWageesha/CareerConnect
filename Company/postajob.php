<?php
require_once '../includes/config.php';

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $jobTitle   = $conn->real_escape_string($_POST['jobTitle']);
    $company    = $conn->real_escape_string($_POST['company']);
    $location   = $conn->real_escape_string($_POST['location']);
    $jobType    = $conn->real_escape_string($_POST['jobType']);
    $salary     = $conn->real_escape_string($_POST['salary']);
    $experience = $conn->real_escape_string($_POST['experience']);
    $description= $conn->real_escape_string($_POST['description']);

    // Insert query
    $sql = "INSERT INTO jobs (jobTitle, company, location, jobType, salary, experience, description, created_at)
            VALUES ('$jobTitle', '$company', '$location', '$jobType', '$salary', '$experience', '$description', NOW())";

    if ($conn->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Job posted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - CareerConnect</title>
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
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        /* Post Job Form */
        .post-job-section {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 28px;
            color: black;
            margin-bottom: 20px;
            border-bottom: 3px solid #87ceeb;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: black;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #87ceeb;
            outline: none;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        .btn-primary {
            background-color: #87ceeb;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #5dade2;
        }

        /* Job List Section */
        .job-list-section {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .job-card {
            border: 2px solid #f0f0f0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fafafa;
        }

        .job-card h3 {
            color: black;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .job-info {
            color: #666;
            margin-bottom: 10px;
        }

        .job-info strong {
            color: #87ceeb;
        }

        .job-description {
            color: #555;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .job-actions {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background-color: #87ceeb;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-edit:hover {
            background-color: #5dade2;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .no-jobs {
            text-align: center;
            color: #999;
            font-size: 18px;
            padding: 40px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                gap: 15px;
                flex-wrap: wrap;
            }

            .main-container {
                grid-template-columns: 1fr;
                gap: 20px;
                margin: 20px auto;
            }

            .job-actions {
                flex-direction: column;
            }
        }

        /* Success Message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            display: none;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            display: none;
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
        <li><a href="companyhomepage.php">Home</a></li>
        <li><a href="postajob.php" class="active">Post a Job</a></li>
        <li><a href="viewapplications.php">View Applications</a></li>
        <li><a href="#people">Help</a></li>
        <li><a href="myaccountpage.php">My Account</a></li>
        <button onclick="window.location.href='../login.php'">Log Out</button>
      </ul>


    </nav>
  </header>

    <div class="main-container">
        <!-- Post Job Form -->
        <div class="post-job-section">
            <h2 class="section-title">Post a New Job</h2>
            
            <div id="successMessage" class="success-message"></div>
            <div id="errorMessage" class="error-message"></div>

            <form id="jobForm">
                <div class="form-group">
                    <label for="jobTitle">Job Title *</label>
                    <input type="text" id="jobTitle" name="jobTitle" required>
                </div>

                <div class="form-group">
                    <label for="company">Company Name *</label>
                    <input type="text" id="company" name="company" required>
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
                    <label for="salary">Salary Range</label>
                    <input type="text" id="salary" name="salary" placeholder="e.g., $50,000 - $70,000">
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
            </form>
        </div>

        <!-- Job List -->
        <div class="job-list-section">
            <h2 class="section-title">Your Posted Jobs</h2>
            <div id="jobList">
                <div class="no-jobs">
                    No jobs posted yet. Create your first job posting!
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
         document.getElementById("jobForm").addEventListener("submit", function(e) {
           e.preventDefault();

         const formData = new FormData(this);

         fetch("post_job.php", {
             method: "POST",
             body: formData
          })
         .then(response => response.json())
         .then(data => {
        if (data.status === "success") {
            document.getElementById("successMessage").innerText = data.message;
            document.getElementById("errorMessage").innerText = "";
            document.getElementById("jobForm").reset();
        } else {
            document.getElementById("errorMessage").innerText = data.message;
            document.getElementById("successMessage").innerText = "";
        }
    })
    .catch(err => {
        document.getElementById("errorMessage").innerText = "Something went wrong!";
    });
});
</script>
</body>
</html>