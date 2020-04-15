<?php

include "includes/classes/auth.php";

$auth = new Auth();

$auth->logout();

header("Location: login.php");

?>
