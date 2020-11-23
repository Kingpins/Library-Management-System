<?php include 'server.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Library Management System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/js/bootstrap.min.js">
	
	 <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">

	<style type="text/css">
		label{
			font-family: 'Crimson Text', serif;
			font-size: 20px;
			margin-left:  20px;
		}
		input[type=text]{
			font-size: 14px;
			width: 300px;
			height: 30px;
			border:1px solid #C70039;
			margin-left: 20px;
		}
		
		input[type=password]{
			font-size: 14px;
			width: 300px;
			height: 30px;
			border:1px solid #C70039;
			margin-left: 20px;
		}
		input[type=submit]{
			font-size: 14px;
			height: 40px;
			margin-top:  15px;
			margin-left: 20px;
			border:solid 1px #C70039;
		}
		input[type=submit]:hover{
			border:none;
			background-color:grey;
			color: white;	
		}
		#signup{
			display: none;
		}
		.errors{
			margin-right: 30px;	
			margin-left: 50px;
			margin-top: 30px;
			border:solid 2px #C70039;
			background-color: pink;
			padding-left: 20px;
			font-size: 16px;
		}
	</style>

	<script type="text/javascript">
		function login(){
			document.getElementById("login").style.display="block";
			document.getElementById("loginlbl").style.color="black";
			document.getElementById("signuplbl").style.color="";
			document.getElementById("signup").style.display="none";
		}
		function signup(){
			document.getElementById("signup").style.display="block";
			document.getElementById("signuplbl").style.color="black";
			document.getElementById("loginlbl").style.color="";
			document.getElementById("login").style.display="none";
		}
		function check(){
			if(document.getElementById("username").value==""||document.getElementById("password").value=="")
			{
				alert("fields cannot be empty");
				return false;
			}
			else{
				alert("Account Created");
				return true;
			}
		}
	</script>

</head>
<body style="margin:0px; padding:0px;">


<div class="container-fluid" style="margin-top:60px">
	<div class="row">
			
			<div class="col-sm-8" style="background-color:#C70039; width: 400px; height: 450px; margin-left:220px;
			margin-top:40px; ">
				<div style="font-size: 45px;color:white; margin-top:25%;margin-left:5%; text-align: center; font-family: 'Crimson Text', serif;">
					Library Management System
				</div>
				<div style="font-size: 25px;color:white; margin-top:40px;text-align: center; font-family: 'Crimson Text', serif;">
					<ul style="display: inline-block; list-style-type: none;">
					<li style="display: inline-block; color: black" onclick="login()" id="loginlbl">Login</li>
					<li style="display: inline-block;">|</li>
					<li style="display: inline-block;" onclick="signup()" id="signuplbl">Sign Up</li>
					</ul>
				</div>
			</div>

			<div class="col-sm-4" style="border:solid 3px #C70039 ; width: 420px; height: 530px;">
			<?php if (count($errors)>0):?> 
				<div class="errors">
					<?php foreach ($errors as $error):?> 
			 			<?php echo $error; ?><br>
					<?php endforeach ?>
				</div>
			<?php endif ?>

			<div style="margin-top:20%;line-height: 40px;margin-left: 30px;" id="login">
				<form method="post" action="library.php">
					<label for="username">Username</label><br>
					<input type="text" name="user" placeholder="username"><br>
					<label for="password">Password</label><br>
					<input type="password" name="pass" placeholder="password"><br>
					<input type="submit" name="login" value="Login">
				</form>
				<div style="margin-top:100px;margin-left:110px;"><h4>&copyLMS/2019</h4></div>
			</div>	

			<div style="margin-top:10%;line-height: 40px;margin-left: 30px;" id="signup">
				<form method="post" action="library.php">
					<label for="username">Username</label><br>
					<input type="text" name="username" placeholder="username" id="username" value="<?php echo $username;?>"><br>
					<label for="email">Email</label><br>
					<input type="text" name="email" placeholder="email" value="<?php echo $email;?>"><br>
					<label for="password">Password</label><br>
					<input type="password" name="password" placeholder="password"><br>
					<label for="repassword">Re-enter Password</label><br>
					<input type="password" name="repassword" placeholder="re-enter password"><br>
					<input type="submit" name="signup" value="Sign Up" onclick="return check()">
				</form>
			</div>
			</div>
	</div>
</div>

</body>
</html>