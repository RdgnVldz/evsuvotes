<?php
// Database connection settings (include 'includes/session.php' here)
include 'includes/session.php';
// Check if an ID parameter is provided in the URL
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $admin_id = $_GET["id"];
    
    // SQL query to delete the admin with the specified ID
    $delete_sql = "DELETE FROM admin WHERE id = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $admin_id);
    
    if ($stmt->execute()) {
        // Redirect back to the admin table page after successful deletion
        header("Location: accounts.php");
        exit();
    } else {
        echo "Error deleting admin: " . $conn->error;
    }
    
    // Close the prepared statement
    $stmt->close();
} else {
    echo "Invalid admin ID.";
}

header('location: accounts.php');
// $conn->close();
?>
