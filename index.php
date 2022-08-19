<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index2.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}
 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body >
	
	<style type="text/css">
	body{
		
		background-image:linear-gradient(to bottom, rgb(0,0,0,0.6) 0% ,rgb(0,0,0,0.6)100%) , url("images/iteAp.jpeg") ;
		background-repeat: no-repeat;
		background-size: cover;

	}
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 97%;
		
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color:  #92A8D1 ;
		border: none;
		border-radius: 10px;
	}

	#box{

		background-color:  #2A3F54 ;
		margin: auto;
		margin-top: 150px;
		width: 300px;
		padding: 20px;
		border-radius: 10px;
		
	}
	a{
		color: #92A8D1;
	}
	a:hover{
		color: red;
	}

	</style>

   <div class="head" style>  
	 
<!-- 	<span  style="font-size: 40px; color:aliceblue;" >بلدية غزة</span></a> -->  
   <img src="images/img1.png" alt="..." class="img-circle profile_pic" style="height: 60px; width: 60px;">
           
	</div> 

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" placeholder="User Name" name="user_name"><br><br>
			<input id="text" type="password" placeholder="Password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>
			<span style="color:aliceblue">If You Don't Have Account</span>
			<a href="signup.php" >Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>