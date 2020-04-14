<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
  $json = file_get_contents('../../../data/users/controlpanel_users.json');
  $userarray = json_decode($json, true);

  $new_user = array('username' => htmlspecialchars(stripslashes($_POST['username'])), 'password' => htmlspecialchars(stripslashes($_POST['password'])), 'roles' => array('add_player' => 0, 'edit_player' => 0, 'delete_player' => 0, 'select_playlist' => 0, 'add_media' => 0, 'edit_own_media' => 0, 'edit_all_media' => 0, 'delete_own_media' => 0, 'delete_all_media' => 0, 'manage_media' => 0, 'add_playlist' => 0, 'delete_playlist' => 0, 'add_users' => 0, 'manage_users' => 0, 'delete_users' => 0), 'last_login' => 'never', 'last_ip_address' => '');

  array_push($userarray, $new_user);

  file_put_contents('../../../data/users/controlpanel_users.json', json_encode($userarray));

  echo "success";
}

?>
