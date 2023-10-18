<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $studentid = $_POST['studentid'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Determine the department_id based on the course
$departmentId = 0; // Initialize the department_id variable
switch ($course) {
    case 'BSIT':
    case 'BSCE':
    case 'BSEE':
        $departmentId = 1; // Engineering Department
        break;
    case 'BSEDMath':
    case 'BSEDScience':
    case 'BPEd':
    case 'BTVTEdFSM':
    case 'BTVTEdGFD':
    case 'DTS':
        $departmentId = 3; // Education Department
        break;
    case 'BSE':
    case 'BSA':
    case 'BSOA':
    case 'BSBAMarketing':
        $departmentId = 4; // Business, Entrepreneurship and Marketing Department
        break;
    case 'BSiTechElectronics':
    case 'BSiTechElectrical':
    case 'BSMTAutomotive':
    case 'BSMTWF':
    case 'BSHM':
        $departmentId = 2; // Technology Department
        break;
    default:
        $departmentId = 0; // Unknown Department
        break;
}
    // Check if the student ID already exists in the database
    $checkSql = "SELECT * FROM voters WHERE studentid = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $studentid);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows === 0) {
        // Student ID does not exist, proceed with insertion
        $sql = "INSERT INTO voters (studentid, password, firstname, middlename, lastname, course, year, department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $studentid, $password, $firstname, $middlename, $lastname, $course, $year, $departmentId);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Voter added successfully';
        } else {
            $_SESSION['error'] = $conn->error;
        }
    } else {
        $_SESSION['error'] = 'Student ID already exists';
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: voters.php');
?>
