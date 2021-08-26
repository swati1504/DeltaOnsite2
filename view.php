<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<style type="text/css">
		
		body{
			background-image:url(images1.jpg);
			background-size: cover;
			background-attachment: fixed;
		}
		
		.alb {
			width: 250px;
			height: 250px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		h1{
			font-size: 60px;
			color: white;
            font-family: arial;
            text-align:center
		}
		h2{
			position: absolute;
			left:300px;
		}
	</style>
</head>
    <h1>Picturesque</h1>
	<br>
     <?php 
          $sql = "SELECT * FROM images ORDER BY id DESC";
          $res = mysqli_query($conn,  $sql);

          if (mysqli_num_rows($res) > 0) {
          	while ($images = mysqli_fetch_assoc($res)) {  ?>
             <div class="alb">
			    <h2><?php echo $images['image_url']?></h2>
             	<img src="uploads/<?=$images['image_url']?>">
             </div>
			  </br>
			  </br>
          		
	 <?php } }?>
</html>