<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $studentid = $_POST['studentid'];
    $password = $_POST['password'];

    // Check if the student ID already exists in the database (excluding the current user's ID)
    $checkSql = "SELECT * FROM voters WHERE studentid = ? AND id != ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("si", $studentid, $id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows === 0) {
        // Student ID does not exist (or belongs to the current user), proceed with update
        $sql = "UPDATE voters SET firstname = ?, middlename = ?, lastname = ?, course = ?, year = ?, studentid = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $firstname, $middlename, $lastname, $course, $year, $studentid, $password, $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Voter updated successfully';
        } else {
            $_SESSION['error'] = $conn->error;
        }
    } else {
        $_SESSION['error'] = 'Student ID already exists';
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: voters.php');
?>
