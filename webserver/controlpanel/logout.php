<?php

session_start();

include "includes/classes/auth.php";

$auth = new Auth("../data");

$auth->logout();

header("Location: login.php");

?>
