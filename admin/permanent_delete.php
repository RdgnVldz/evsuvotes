<?php
	include 'includes/session.php';

	$sql = "DELETE FROM archive_votes";
	if($conn->query($sql)){
		$_SESSION['success'] = "Votes are successfully deleted";
	}
	else{
		$_SESSION['error'] = "Something went wrong in reseting";
	}

	header('location: archived_votes.php');

?>