<?php
//This script will handle login
session_start();
if(isset($_SESSION["loggedin"]) != true){
	header("location: login.php");
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Picturesque</title>
	<style type="text/css">
		
		body{
			background-image:url(images1.jpg);
			background-size: cover;
			background-attachment: fixed;
		}

		h1{
			font-size: 60px;
			color: white;
            font-family: arial;
            text-align:center
		}
		div{
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 50vh;
		}
		label{
			font-size: 30px;
			color: white;
            font-family: arial;
			text-align:center
		}
	</style>
</head>
<body>
    <h1>Picturesque</h1>
	<h2 style="color:white;text-align:center">Welcome!!!</h2>
	<div>
	</br>
	<label>Select file to upload:</label></br>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
     <form action="upload.php" method="post" enctype="multipart/form-data">
           <input type="file" 
                  name="newfile">

           <input type="submit" 
                  name="submit"
                  value="Upload">
     </form>
	</div>
	<br>
	<br>
	<br>
	<br>
	<h3 style="color:white; text-align:center">JPG PNG MP3 MP4 PDF AVI 20MB</h3>
</body>
</html>