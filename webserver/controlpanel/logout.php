<?php

session_start();

include "includes/classes/auth.php";

$auth = new Auth("/var/www/data");

$auth->logout();

header("Location: login.php");

?>
