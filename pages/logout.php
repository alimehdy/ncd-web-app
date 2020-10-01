<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["user_privilige"]);
unset($_SESSION["clinic_id"]);
session_destroy();
header("Location: ../index.php");
?>