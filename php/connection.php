<?php
error_reporting(E_ALL);

session_start();

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "Psalm19v1";
$DB_name = "ncd";
if(!isset($_SESSION['username']) && !isset($_SESSION['user_privilige']) && !isset($_SESSION['clinic_id'])){
    header("Location: ../index.php");
}
else{
	try
	{
		 $conn = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
		 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $conn->exec("SET CHARACTER SET utf8mb4");
	}
	catch(PDOException $e)
	{
		 echo $e->getMessage();
	}
}

?>