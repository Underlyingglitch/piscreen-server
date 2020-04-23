<?php

session_start();

include "../classes/auth.php";

$auth = new Auth("../../../data");

$response = $auth->login($_POST['username'], $_POST['password']);

if ($reponse === "success") {
  header("Location: ../../");
} else {
  header("Location: ../../login.php?error=".$response);
}

?>
