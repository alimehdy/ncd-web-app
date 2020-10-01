<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$new_status = $_POST['new_status'];
$reason_of_edit = "Status Changed Only";
if($new_status !== "select")
{
	$updateStatus = "UPDATE lab_test SET lab_status = :new_status WHERE lab_id = :pid AND clinic_id = :cid";
	$execUpdateStatus = $conn->prepare($updateStatus);
	$execUpdateStatus->bindValue(':new_status', $new_status);
	$execUpdateStatus->bindValue(':pid', $pid);
	$execUpdateStatus->bindValue(':cid', $cid);
	$execUpdateStatus->execute();
	echo "updated";
}
else
{
	echo "select";
}
?>