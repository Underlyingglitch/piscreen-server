<?php

session_start();

$username = htmlspecialchars(stripslashes($_POST['username']));
$password = htmlspecialchars(stripslashes($_POST['password']));

$data_path = "../../../data/";

$json = file_get_contents($data_path.'users/controlpanel_users.json');
$userarray = json_decode($json, true);

for ($i=0; $i<count($userarray); $i++) {
  if ($userarray[$i]['username'] === $username) {
    if ($userarray[$i]['password'] === $_POST['password']) {
      //Details correct!
      $_SESSION['auth'] = $username;
      $_SESSION['id'] = $i;
    } else {
      //Incorrect password
      header("Location: ../../login.php?error=incorrectpassword");
    }
  } else {
    //Incorrect username
    header("Location: ../../login.php?error=usernotfound");
  }
}

?>
