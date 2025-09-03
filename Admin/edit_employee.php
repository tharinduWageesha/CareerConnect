<?php
include 'db.php';

$employee = null; // Initialize the variable

// Part 1: Fetch employee data for the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit();
    }
    $stmt->close();
}

// Part 2: Handle form submission for updating data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Prepare the UPDATE statement
    if (!empty($password)) {
        // Update password only if a new one is provided
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $hashed_password, $id);
    } else {
        // Update without changing the password
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }

    if ($stmt->execute()) {
        header("Location: manage_employees.php");
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
    <title>Edit Employee</title>
    <link rel="stylesheet" href="adminhomepage.css">
</head>
<body>
    <h2 style="text-align:center; margin:20px 0;">Edit Employee</h2>
    <form action="edit_employee.php" method="post" style="max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">New Password (optional):</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <button type="submit">Update Employee</button>
        </div>
    </form>
</body>
</html>