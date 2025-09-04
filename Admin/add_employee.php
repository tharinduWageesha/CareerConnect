<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php'; // Include the database connection

    // Get data from the form and sanitize it
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    // For a real application, you would hash the password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // Prepare an SQL INSERT statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the manage employees page on success
        header("Location: manage_employees.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
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
    <title>Add Employee</title>
    <link rel="stylesheet" href="adminhomepage.css">
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
    <h2 style="text-align:center; margin:20px 0;">Add a New Employee</h2>
    
    <form action="add_employee.php" method="post" style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div style="text-align:center;">
            <button type="submit">Save Employee</button>
        </div>
    </form>
</main>
</body>
</html>