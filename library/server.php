<?php
$conn=mysqli_connect("localhost","root","","library");

session_start();
$username="";
$email="";
$errors = array();
 if(isset($_POST['signup'])){
 	$username=$_POST['username'];
 	$email=$_POST['email'];
 	$password=$_POST['password'];
 	$repassword=$_POST['repassword'];
 	if ($password!=$repassword) {
 		array_push($errors,"Passwords are not matched");
 	}
 	if (empty($email)) 
 	{
		array_push($errors, "Email is empty");
	}
	else
	{
		$a="SELECT * FROM login where email='$email'";
		$b=$conn->query($a);
		$c=$b->fetch_assoc();
			if ($c["email"]==$email)
				{
				array_push($errors, "Email already exists");
				}
	}
 	if (count($errors)==0) 
 	{
 	$sql="INSERT INTO login VALUES('$username','$email','$password','$repassword')";
 	$conn->query($sql);
 	array_push($errors, "Your account is created, Go for LOGIN"); 
 	}
 }


 if(isset($_POST['login']))
 {
 	$username=$_POST['user'];
 	$password=$_POST['pass'];
 	$sql="SELECT count(username) FROM login WHERE username='$username' AND password='$password'";
 	$result=$conn->query($sql);
 	$b=mysqli_fetch_array($result);
 	if($b["count(username)"]==1)
 	{
 		header('location:home.php');
 		$_SESSION['username']=$username;
 		exit();
 	}
 	else
 	{
 		array_push($errors, "Invalid Username and Password");
 	}
 }

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['username']);
	header('location:library.php');
}

if(isset($_POST['addbook']))
{
	$bnumber=$_POST['booknumber'];
	$bname=$_POST['bookname'];
	$bauthor=$_POST['authorname'];
	$bpublication=$_POST['publication'];
	if(empty($bnumber))
	{
		array_push($errors, "Must enter a book number");
	}
	$sql="SELECT * FROM bookdetails where bnumber='$bnumber'";
	$a=$conn->query($sql);
	$imp=$a->fetch_assoc();
	if(mysqli_num_rows($a)>0){
		array_push($errors, "Book Number already exists!");	
	}
	if(count($errors)==0)
	{
	$sql="INSERT INTO bookdetails VALUES('$bnumber','$bname','$bauthor','$bpublication')";
	$conn->query($sql);
	array_push($errors, "Book Added Successfully!");
	header('location:bookdetails.php');
	exit();
	}
}

if(isset($_POST['addstudent']))
{
	$sname=$_POST['studentname'];
	$ID=$_POST['id'];
	$sgender=$_POST['gender'];
	$sdep=$_POST['department'];
	if(empty($ID))
	{
		array_push($errors, "Must Enter a Student ID");
	}
	$sql="SELECT * FROM studentdetails where ID='$ID'";
	$a=$conn->query($sql);
	$imp=$a->fetch_assoc();
	if(mysqli_num_rows($a)>0){
		array_push($errors, "Student ID already exists!");	
	}
	if(count($errors)==0)
	{
	$sql="INSERT INTO studentdetails VALUES('$ID','$sname','$sgender','$sdep')";
	$conn->query($sql);
	header('location:student.php');
	exit();
	}
}
?>
