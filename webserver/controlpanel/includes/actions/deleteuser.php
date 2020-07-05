<?php

session_start();

//Checking if user has role
include "../classes/auth.php";

$auth = new Auth();

if ($auth->isRole("delete_users")) {
  $json = file_get_contents('/var/www/data/controlpanel_users.json');
  $userarray = json_decode($json, true);


  //Getting userid
  for ($i=0; $i<count($userarray); $i++) {
    if ($userarray[$i]['username'] === $_POST['username']) {
      break;
    }
  }

  unset($userarray[$i]);

  file_put_contents('/var/www/data/controlpanel_users.json', json_encode($userarray));

  echo "success";
} else {
  echo "norole";
}

?>
