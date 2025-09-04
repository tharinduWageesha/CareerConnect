<?php
// Connect to database
include 'db.php';

// Check if we got an ID to delete
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $employee_id = $_GET['id'];
    
    try {
        // Prepare SQL to delete the employee safely
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $employee_id);
        
        // Try to delete
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // Success! Employee was deleted
                $stmt->close();
                $conn->close();
                header("Location: manage_employees.php?success=1");
                exit();
            } else {
                // No employee found with that ID
                $stmt->close();
                $conn->close();
                header("Location: manage_employees.php?error=not_found");
                exit();
            }
        } else {
            // Database error
            $stmt->close();
            $conn->close();
            header("Location: manage_employees.php?error=db_error");
            exit();
        }
        
    } catch (Exception $e) {
        // Something went wrong
        $conn->close();
        header("Location: manage_employees.php?error=exception");
        exit();
    }
    
} else {
    // No valid ID provided
    header("Location: manage_employees.php?error=no_id");
    exit();
}
?>