<?php
include'config.php';
 
if(isset($_POST['save'])){
    session_start();

    $id=$_SESSION['CustomerID'];
	//code for image uploading
	if($_FILES['f1']['name']){
		move_uploaded_file($_FILES['f1']['tmp_name'], "image/".$_FILES['f1']['name']);
		$img="image/".$_FILES['f1']['name'];
	}
 
	$i="update customer set Image='$img'WHERE CustomerID='$id'";   
		if(mysqli_query($conn, $i)){
			header("Refresh: 0.1; url= Manageprofile.php");
            echo "<script>alert('You have successfully Update your profile picture.')</script>";

	}
}
?>
