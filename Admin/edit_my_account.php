<?php
require_once '../includes/config.php';

// In a real application, you would get the admin ID from a session
// For now, we'll just use ID = 1 as an example
$admin_id = 1;
$admin = null;

// Part 1: Fetch admin data for the form
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    echo "Admin account not found.";
    exit();
}
$stmt->close();

// Part 2: Handle form submission for updating data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Prepare the UPDATE statement
    if (!empty($password)) {
        // Update password only if a new one is provided
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $hashed_password, $admin_id);
    } else {
        // Update without changing the password
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $admin_id);
    }

    if ($stmt->execute()) {
        header("Location: my_account.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit My Account</title>
    <link rel="stylesheet" href="adminhomepage.css">
    <link rel="stylesheet" href="../includes/navfooter.css">
</head>
<body>
    <h2 style="text-align:center; margin:20px 0;">Edit My Account</h2>
    <form action="edit_my_account.php" method="post" style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">New Password (optional):</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <button type="submit">Update Profile</button>
        </div>
    </form>
</body>
</html>