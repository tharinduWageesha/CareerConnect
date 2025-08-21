<?php
require 'includes/config.php';

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user role
$username = $_SESSION['username'];
$sql = "SELECT role, full_name FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$role = $user['role'];
$name = $user['full_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CareerConnect - Home</title>
   <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

    <div class="navbar1">
        <div class="logo">
            <a href="homepage.php"><img src="assets/images/logo2.png" alt="CareerConnect Logo"></a>
        </div>

        <div class="user-info">
            <span><?php echo htmlspecialchars($name); ?></span>
            <span>Role: <?php echo htmlspecialchars($role); ?></span>
        </div>

        <ul class="nav-links">
            <?php if ($role == 'ADMIN') { ?>
                <li><a href="pages/admin/users.php">Manage Users</a></li>
                <li><a href="pages/admin/jobs.php">Manage Jobs</a></li>
                <li><a href="pages/admin/reports.php">Reports</a></li>
            <?php } else { ?>
                <li><a href="jobs.php">Job Listings</a></li>
                <li><a href="applications.php">My Applications</a></li>
            <?php } ?>
            <li><a href="functionalities.php">Functionalities</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

</body>
</html>
