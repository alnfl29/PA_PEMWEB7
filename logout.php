<?php

session_start();

session_unset();
$_SESSION["akses"] = "none";
session_destroy();

header("location: index.php");
exit;
?>
