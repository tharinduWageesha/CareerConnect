<?php
require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account_type = $_POST['account_type'];

    // Insert into users table
    $stmt = $conn->prepare("INSERT INTO users (username, password, role, full_name, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $account_type, $full_name, $email);
    $_SESSION['username'] = $username;
    if ($stmt->execute()) {
        $stmt->close();
         header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>CareerConnect - Sign Up</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="container">
    <!-- Left Side with Image -->
    <div class="left-panel">
        <div class="overlay"></div>
    </div>

    <!-- Right Side with Form -->
    <div class="right-panel">
        <div class="form-container">
            <h2>Sign Up</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="full_name">Employee / Company Name</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>

                <div class="form-group">
                    <div class="radio-group">
                        <label>Account Type</label>
                        <div class="radio-option">
                            <input type="radio" id="employee" name="account_type" value="USER" required>
                            <label for="employee">Employee</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="company" name="account_type" value="Company" required>
                            <label for="company">Company</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="submit-btn">Register</button>
                
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
