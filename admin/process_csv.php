<?php
include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
        $csvFile = $_FILES['csvFile']['tmp_name'];

        // Handle CSV file processing - parse, validate, and insert data into the database
        if (($handle = fopen($csvFile, 'r')) !== false) {
            $inserted = false; // Initialize a flag to track if any new voters were successfully inserted

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Assuming your CSV format is: studentid,firstname,middlename,lastname,course,year,password
                $studentid = $data[0];

                // Check if the student ID matches the desired format (4 numbers, dash, and 5 numbers)
                if (!preg_match('/^\d{4}-\d{5}$/', $studentid)) {
                    continue; // Skip this record and move to the next one
                }

                // Check if the student ID already exists in the database
                $checkSql = "SELECT * FROM voters WHERE studentid = ?";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->bind_param("s", $studentid);
                $checkStmt->execute();
                $result = $checkStmt->get_result();

                if ($result->num_rows === 0) {
                    // Student ID does not exist, proceed with insertion
                    $firstname = $data[1];
                    $middlename = $data[2];
                    $lastname = $data[3];
                    $course = $data[4];
                    $year = $data[5];
                    $password = $data[6];

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

                    // Hash the password securely.
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert data into the database
                    $insertSql = "INSERT INTO voters (studentid, firstname, middlename, lastname, course, year, password, department_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("sssssssi", $studentid, $firstname, $middlename, $lastname, $course, $year, $hashedPassword, $departmentId);
                    $insertStmt->execute();

                    $inserted = true; // Set the flag to true since at least one voter was inserted
                }
            }
            fclose($handle);

            if ($inserted) {
                $_SESSION['success'] = "CSV file uploaded, and valid data inserted into the database successfully.";
            } else {
                $_SESSION['error'] = "All voters in the CSV file already exist in the database.";
            }
        } else {
            $_SESSION['error'] = "Error processing the CSV file.";
        }
    } else {
        $_SESSION['error'] = "Error uploading the CSV file.";
    }

    header("Location: voters.php"); // Redirect back to the voters page
    exit();
}
?>
