<?php
include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $photo = $_POST['photo']; // You can optionally validate and sanitize this input.
    $user_role = $_POST['user_role'];

    // Get the current date and time in MySQL format (YYYY-MM-DD HH:MM:SS)
    $currentDateTime = date('Y-m-d H:i:s');

    // Insert admin data into the database, including the current date and time
    $sql = "INSERT INTO admin (username, password, firstname, lastname, photo, created_on, user_role) VALUES ('$username', '$password', '$firstname', '$lastname', '$photo', '$currentDateTime', '$user_role')";

    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Admin added successfully';
    } else {
        $_SESSION['error'] = 'Error: ' . $sql . '<br>' . $conn->error;
    }

    header('location: accounts.php');
    exit(); // Ensure that no further code is executed after the header redirect.
} else {
    $_SESSION['error'] = 'Invalid request method';
    header('location: accounts.php');
    exit();
}
?>
