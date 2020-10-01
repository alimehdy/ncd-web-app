<?php
error_reporting(E_ALL);

//ini_set('display_errors', 0);
//session_start();
// configuration
$dbhost 	= "localhost";
$dbname		= "ncd";
$dbuser		= "root";
$dbpass		= "Psalm19v1";

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->exec("SET CHARACTER SET utf8mb4");
// new data

if(isset($_POST['user']) && isset($_POST['pass']))
{
	$user = $_POST['user'];
	$password = md5($_POST['pass']);
	 
	// query

	$result = $conn->prepare("SELECT * FROM login WHERE username= :u AND password= :p");
	$result->bindParam(':u', $user);
	$result->bindParam(':p', $password);
	$result->execute();
	$rows = $result->fetch(PDO::FETCH_ASSOC);

	if($result->rowCount() > 0) {
		session_start();
		$_SESSION['username'] = $rows['username'];
		$_SESSION['user_privilige'] = $rows['user_privilige'];
		$_SESSION['clinic_id'] = $rows['clinic_id'];
		$res3 = "correct";
		echo $res3;

	}
	else{
		$res3 = "incorrect";
		echo $res3;
	}
}
?>