<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
    // Check if the checkbox is checked
    if (!isset($_POST['terms_agreed'])) {
        $_SESSION['error'] = 'You must accept the Terms and Conditions first.';
        header('location: department_login.php'); // Redirect back to the login page
        exit();
    }

    $studentid = $_POST['studentid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM voters WHERE studentid = '$studentid'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Unable to locate voter with the specified ID.';
    } else {
        $row = $query->fetch_assoc();
        $voter_id = $row['id'];
        $department_id = $row['department_id']; // Assuming 'department_id' is a column in your 'voters' table.

        // Check if the user's department is active
        $department_status_query = "SELECT status FROM departments WHERE department_id = '$department_id'";
        $department_status_result = $conn->query($department_status_query);

        if ($department_status_result->num_rows == 1) {
            $department_row = $department_status_result->fetch_assoc();
            $department_status = $department_row['status'];

            if ($department_status == 'inactive') {
                $_SESSION['error'] = 'Your department is currently inactive. Please try again later.';
                header('location: department_login.php'); // Redirect to the login page with the error message
                exit();
            }
        }

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['voter'] = $voter_id;
        } else {
            $_SESSION['error'] = 'Incorrect password';
        }
    }
} else {
    $_SESSION['error'] = 'Input voter credentials first';
}

header('location: home.php');
?>
