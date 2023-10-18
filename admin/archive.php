    <?php
    include 'includes/session.php';
    
    $sql = "INSERT INTO archive_votes (voters_id, candidate_id, position_id, date_times) 
    SELECT voters_id, candidate_id, position_id, NOW()
    FROM votes";

if($conn->query($sql)){
    $_SESSION['success'] = "Votes moved to Archive successfully";
}
    else{
		$_SESSION['error'] = "Something went wrong in reseting";
	}

    // Optionally, you can delete the data from the votes table after moving it.
    $deleteSql = "DELETE FROM votes";
    if (mysqli_query($conn, $deleteSql)) {
        $_SESSION['success'] = "Votes moved to Archive successfully";
     } else {
        echo "Error: " . $deleteSql . "<br>" . mysqli_error($conn);
     }
     header('location: votes.php');
    
    ?>
