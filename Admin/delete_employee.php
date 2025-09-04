<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a DELETE statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_employees.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No ID specified for deletion.";
}
?>