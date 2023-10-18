<?php
// Include your session handling and database connection code
include 'includes/session.php';

if (isset($_POST['vote'])) {
    // Assuming you have retrieved the voter's ID from your session
    $voterId = $_SESSION['voters_id']; // Make sure you have the 'voters_id' in your session

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the voter has already voted
    $existingVoteCheck = "SELECT * FROM votes WHERE voters_id = '$voterId'";
    $result = $conn->query($existingVoteCheck);

    if ($result->num_rows == 0) {
        // The voter has not voted yet, so proceed to record their vote

        // Initialize an array to store SQL queries
        $sql_array = array();

        foreach ($_POST['vote'] as $position => $candidates) {
            // Adjust the variable names according to your form field names
            $positionId = mysqli_real_escape_string($conn, $position);
    
            if (is_array($candidates)) {
                foreach ($candidates as $candidate) {
                    $candidate = mysqli_real_escape_string($conn, $candidate);
    
                    // Construct the SQL query for inserting votes
                    $sql = "INSERT INTO votes (voters_id, candidate_id, position_id, date_time) 
                            VALUES ('$voterId', '$candidate', '$positionId', NOW())";
    
                    // Add the SQL query to the array
                    $sql_array[] = $sql;
                }
            } else {
                $candidates = mysqli_real_escape_string($conn, $candidates);
    
                // Construct the SQL query for inserting votes
                $sql = "INSERT INTO votes (voters_id, candidate_id, position_id, date_time) 
                        VALUES ('$voterId', '$candidates', '$positionId', NOW())";
    
                // Add the SQL query to the array
                $sql_array[] = $sql;
            }
        }
        

        // Execute the SQL queries
        foreach ($sql_array as $sql) {
            if (!$conn->query($sql)) {
                // Handle errors if the query execution fails
                $_SESSION['error'][] = 'Error: ' . $conn->error;
            }
        }
    } else {
        // The voter has already voted
        $_SESSION['error'][] = 'You have already voted. You cannot vote again.';
    }

    // Close the database connection
    $conn->close();

    // Redirect to your success or error page
    header('location: home.php');
} else {
    $_SESSION['error'][] = 'Select candidates to vote first';
    header('location: home.php');
}
?>
