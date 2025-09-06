<?php
// login.php
require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $username = $_POST['username'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $username;

        if ($row['role'] == 'Company') {
            $_SESSION['companyName'] = $row['username']; // ✅ company name = username
            header("Location: Company/companyhomepage.php");
            exit();
        } elseif ($row['role'] == 'Admin') {
            header("Location: Admin/adminhomepage.php");
            exit();
        } else {
            header("Location: User/userhomepage.php");
            exit();
        }
   } else {
        $error = "Invalid Username or Password!";
   }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>CareerConnect - Login</title>
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
            <h2>Log In</h2>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
                <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
