<?php
require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert new user into database
    $sql = "INSERT INTO users (username, password, role, full_name, email)
            VALUES ('$username', '$password', 'USER', '$full_name', '$email')";

    if (mysqli_query($conn, $sql)) {
        // redirect to login instead of homepage (better UX)
        header("Location: homepage.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
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
                <label>Full Name</label>
                <input type="text" name="full_name" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>Username</label>
                <input type="text" name="username" required>

                <label>Password</label>
                <input type="password" name="password" required>

                <button type="submit">Register</button>
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
