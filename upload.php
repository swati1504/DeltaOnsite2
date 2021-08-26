<?php 

if (isset($_POST['submit']) && isset($_FILES['newfile'])) {
	include "config.php";

	echo "<pre>";
	print_r($_FILES['newfile']);
	echo "</pre>";

	$file_name = $_FILES['newfile']['name'];
	$file_size = $_FILES['newfile']['size'];
	$tmp_name = $_FILES['newfile']['tmp_name'];
	$error = $_FILES['newfile']['error'];

	if ($error === 0) {
		if ($file_size > 20000000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}else {
			$file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
			$file_ex_lc = strtolower($file_ex);

			$allowed_exs = array("jpg", "jpeg", "png", "mp3", "mp4", "avi", "doc", "docx", "pdf"); 

			if (in_array($file_ex_lc, $allowed_exs)) {
				$new_file_name = uniqid("FILE-", true).'.'.$file_ex_lc;
				$file_upload_path = 'uploads/'.$new_file_name;
				move_uploaded_file($tmp_name, $file_upload_path);

				// Insert into Database
				$sql = "INSERT INTO images(image_url) 
				        VALUES('$new_file_name')";
				mysqli_query($conn, $sql);
				header("Location: view.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}

}else {
	header("Location: index.php");
}