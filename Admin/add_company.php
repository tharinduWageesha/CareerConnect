<?php
// Start session and check authentication
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; // Include the database connection

    // Get data from the form and sanitize it
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $industry = htmlspecialchars($_POST['industry']);
    $location = htmlspecialchars($_POST['location']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare an SQL INSERT statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO companies (name, email, industry, location, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $industry, $location, $password);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the manage companies page on success
        header("Location: manage_companies.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company - CareerConnect</title>
    <link rel="stylesheet" href="adminhomepage.css">
</head>
<body>
<header>
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
            <li><a href="adminhomepage.php">Home</a></li>
            <li><a href="manage_employees.php">Manage Employees</a></li>
            <li><a href="manage_companies.php">Manage Companies</a></li>
            <li><a href="help.html">Help</a></li>
            <li><a href="my_account.php">My Account</a></li>
            <li><button onclick="window.location.href='../login.php'">Log Out</button></li>
        </ul>
    </nav>
</header>

<main>
    <h2 style="text-align:center; margin:20px 0;">Add a New Company</h2>
    
    <?php if (isset($error)): ?>
        <div style="color: red; text-align: center; margin: 10px 0;"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="add_company.php" method="post" class="form-container">
        <div class="form-group">
            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="industry">Industry:</label>
            <input type="text" id="industry" name="industry" required>
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div style="text-align:center;">
            <button type="submit">Save Company</button>
            <button type="button" onclick="window.location.href='manage_companies.php'">Cancel</button>
        </div>
    </form>
</main>

<footer style="text-align: center; padding: 20px; margin-top: 30px;">
    <p>&copy; 2023 CareerConnect. All rights reserved.</p>
</footer>
</body>
</html>