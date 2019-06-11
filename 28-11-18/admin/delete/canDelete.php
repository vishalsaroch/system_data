<?php
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM candidate WHERE id=$id");
	$_SESSION['message'] = "Candidate Deleted!"; 
	header('location: index.php');
}
?>