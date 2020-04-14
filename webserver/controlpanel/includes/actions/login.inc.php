<?php

include "../classes/auth.php";

$auth = new Auth();

$response = $auth->login($_POST['username'], $_POST['password']) === "success";

if ($reponse === "success") {
  header("Location: ../../");
} else {
  header("Location: ../../login.php?error=".$response);
}

?>
