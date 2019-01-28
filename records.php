<?php 
include('config.php');
 ?>

 <?php 
if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['mail'];
	$gen = $_POST['gender'];
	$age = $_POST['age'];
	//$hob =implode(",",$_POST['hobbies']);
	$hob = implode(",",$_POST['hobbies']);
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];

	$query = mysqli_query($conn, "INSERT INTO form(name, email, gender, age, hobbies, pass, cpass)VALUES('".$name."', '".$email."', '".$gen."', '".$age."', '".$hob."', '".$pass."', '".$cpass."') ");
	if($query)
	 {
		echo "Insert";
	} 
	else
	 {
		echo "Fail";
	}
}

if(isset($_POST['uid'])) {
	$id = $_POST['uid'];
	$name = $_POST['name'];
	$email = $_POST['mail'];
	$gen = $_POST['gender'];
	$age = $_POST['age'];
	//$hob =implode(",",$_POST['hobbies']);
	//$hob = implode(",",$_POST['hobbies']);
	$hob = implode(",",$_POST['hobbies']);
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$query = mysqli_query($conn, "UPDATE form SET name = '".$name."', email = '".$email."', gender = '".$gen."', age = '".$age."', hobbies = '".$hob."', pass = '".$pass."', cpass = '".$cpass."' WHERE my_id = '".$id."' ");
	if($query)
	 {
		echo "Update";
	} 
	else
	 {
		echo "Fail";
	}
}

$id = $_GET['id'];

$query = mysqli_query($conn, "DELETE FROM form WHERE my_id = '".$id."'");

header("Location:view.php");

  ?>