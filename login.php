<?php
// login.php
require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $username = $_POST['username'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) == 1) {
      $_SESSION['username'] = $username;
      header("Location: homepage.php"); // redirect after login
      exit();
   } else {
      $error = "Invalid username or password!";
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
            <h2>Sign In</h2>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>

                <button type="submit">Login</button>
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
