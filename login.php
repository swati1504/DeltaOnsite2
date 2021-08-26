<?php
//This script will handle login
session_start();

require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;
							
                            //Redirect user to welcome page
								            header("location: index.php");
							
                        }
                    }

                }

    }
}    


}


?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./style.css">
  <style type="text/css">
		
		body{
			background-image:url(images1.jpg);
			background-size: cover;
			background-attachment: fixed;
		}

		.content{
			background: white;
			width: 50%;
			padding: 40px;
			margin: 100px auto;
			font-family: calibri;
			border-radius: 10px;
		}

		h1{
			font-size: 60px;
			color: white;
            font-family: arial;
            text-align:center
		}
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    h1 {text-align: center;}
    </style>
</head>
<body>
<h1>Picturesque</h1>
<div>
  
  <form action="" method="post">
    <h2 style="font-family:calibri;";class="text-warning text-center pt-5">LOGIN</h2>

    <label>
      <input type="text" class="input" name="username" placeholder="ENTER USERNAME"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <label>
        <input type="password" class="input" name="password" placeholder="ENTER PASSWORD"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <button type="submit" onClick="window.location = './index.php'">Login</button>
  </form>
</div>
 </body>
</html>