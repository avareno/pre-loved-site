<?php
session_start();


$_SESSION = array();

session_destroy();


header("Location: ../pages/main_page/index.php");
exit;
?>
