<?php

if (isset($_POST['role']) && isset($_POST['user']) && isset($_POST['status'])) {
  $json = file_get_contents('../../../data/users/controlpanel_users.json');
  $userarray = json_decode($json, true);

  $userarray[(int)$_POST['user']]['roles'][$_POST['role']] = (int)$_POST['status'];

  file_put_contents('../../../data/users/controlpanel_users.json', json_encode($userarray));

  echo "success";
} else {
  echo "error";
}

?>
