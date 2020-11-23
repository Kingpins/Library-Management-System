<?php
	include 'server.php';
	if(empty($_SESSION['username'])){
		header('location:library.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Library Management System</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/js/bootstrap.min.js">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<style type="text/css">
	body{
	font-family: 'Crimson Text', serif;	
	}
	.a ul li{
		list-style-type: none;
		font-size: 25px;
	}
		label{
			font-family: 'Crimson Text', serif;
			font-size: 20px;
			margin-left: 30px;
		}
		input[type=text]{
			font-size: 18px;
			width: 360px;
			height: 40px;
			border:1px solid #C70039;
			margin-left: 30px;
		}
		select{
			font-size: 18px;
			width: 360px;
			height: 40px;
			border:1px solid #C70039;
			margin-left: 30px;
		}
		.library ul li{
		list-style-type: none;
		font-size: 28px;
		display: inline-block;
		padding-right:30px;
		padding-left: 30px;
		border-bottom: 2px solid ;
	}
		.vb{
			background-color: #C70039;
			color: white;
		}
		.errors{
			margin-right: 30px;	
			margin-left: 50px;
			margin-top: 10px;
			margin-bottom: 10px;
			border:solid 2px #C70039;
			background-color: pink;
			padding-left: 20px;
			font-size: 16px;
		}
		table{
			width: auto;
			font-size: 18px;
			text-align: left;
			color: ;
		}
		.search th {
		    background-color: gray;
			color:white;
		}
		th{
			background-color: #C70039;
			color:white;
		}
		.mform{	
			line-height: 30px;
			border:solid 2px #C70039;
			 margin-right: 520px;
			 padding-bottom: 20px;
			 padding-top: 10px;

		}
		input[type=submit]{
			font-size: 14px;
			height: 40px;
			margin-top:  15px;
			margin-left: 30px;
			border:solid 2px #C70039;
		}
		input[type=submit]:hover{
			border:none;
			border:solid 2px grey;
			color: black;	
		}
		input[type=button]{
			font-size: 14px;
			height: 30px;
			margin-top:  15px;
			margin-left: 30px;
			border:solid 2px #C70039;
		}
		input[type=button]:hover{
			border:none;
			border:solid 2px grey;
			color: black;	
		}
		#add1{
			display: none;
		}
		.footer{
			padding: 0px;
			margin-top: 25px;
			background-color: #000111;
			color: white;
			text-align: center;
			letter-spacing: 4px;
			font-size: 40px;	
		}
	</style>
	<script type="text/javascript">
			function ab() {
		document.getElementById("add1").setAttribute("style","display:block ;");
		document.getElementById("view1").setAttribute("style","display:none;");
		//document.getElementsByClassName("am").setAttribute("style","background-color:black;");
		document.getElementById("am2").setAttribute("style","background-color:#C70039; color:white;");
	}
	function vb(){
		document.getElementById("view1").setAttribute("style","display:block ;");
		document.getElementById("add1").setAttribute("style","display:none;");
		document.getElementById("vm1").setAttribute("style","background-color:#C70039; color:white;");
		//document.getElementsByClassName("am").setAttribute("style","background-color:none;");
	}
	</script>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed" style="width:100%;background: #C70039; border:none; margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header" >
      <a class="navbar-brand" style="font-size:40px; letter-spacing: 4px; color: white;" id="logo" href="home.php">LMS</a><br>
    </div>
    <ul class="nav navbar-nav navbar-right">
	 <?php if (isset($_SESSION['username'])):?> 
	 <li class="active"><a href=""><?php echo $_SESSION['username'];?></a></li>
	<?php endif ?>
	<li><a href="library.php?logout='1'">logout</a></li>
    </ul>
  </div>
</nav>

 <div class="container-fluid" style="margin-top: 0px;">
	<div class="row">
		<div class="col-sm-2 a" style="background-color: ;  height:100%; ">
			<ul>
				<li><a name="studentdetailsbtn" href="student.php"><img src="student.png" width="80px" style="padding-left:30px;padding-top:13px;"/><br>Students Details</a></li>
				<li><a href="bookdetails.php"><img src="bookdetail1.png" width="80px" style="padding-left:30px;padding-top:13px;"/><br>Books Details</a></li>
				<li><a href="issue.php"><img src="issue.png" width="80px" style="padding-left:30px;padding-top:13px;"/><br>Books Issue</a></li>
				<li><a href="bookrenewal.php"><img src="renewal.png" width="80px" style="padding-left:30px;padding-top:13px;"/><br>Books Renewal</a></li>
				<li><a href="bookreturn.php"><img src="return.png" width="80px" style="padding-left:30px;padding-top:13px;"/><br>Books Return</a></li>
			</ul>
		</div>
		

</body>
</html>

