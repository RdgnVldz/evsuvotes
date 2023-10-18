<?php
    include 'includes/session.php';
    
    $sql = "INSERT INTO votes (voters_id, candidate_id, position_id, date_time) 
    SELECT voters_id, candidate_id, position_id, NOW()
    FROM archive_votes";

if($conn->query($sql)){
    $_SESSION['success'] = "Unarchive vote moved to Votes successfully";
}
    else{
		$_SESSION['error'] = "Something went wrong in reseting";
	}

    // Optionally, you can delete the data from the votes table after moving it.
    $deleteSql = "DELETE FROM archive_votes";
    if (mysqli_query($conn, $deleteSql)) {
        $_SESSION['success'] = "Unarchive vote moved to Votes successfully";
     } else {
        echo "Error: " . $deleteSql . "<br>" . mysqli_error($conn);
     }
     header('location: archived_votes.php');
    
    ?>
