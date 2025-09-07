<?php
require_once '../includes/config.php';

if (isset($_GET['user_id'])) {
    $employee_id = $_GET['user_id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("s", $employee_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                $conn->close();
                header("Location: manage_employees.php?success=1");
                exit();
            } else {
                $stmt->close();
                $conn->close();
                header("Location: manage_employees.php?error=not_found");
                exit();
            }
        } else {
            $stmt->close();
            $conn->close();
            header("Location: manage_employees.php?error=db_error");
            exit();
        }
    } catch (Exception $e) {
        $conn->close();
        header("Location: manage_employees.php?error=exception");
        exit();
    } 
    
} else {
    header("Location: manage_employees.php?error=no_id");
    exit();
}
?>
