<?php

if (isset($_POST['role']) && isset($_POST['user']) && isset($_POST['status'])) {

  //Checking if user has role
  include "../classes/auth.php";

  $auth = new Auth();

  if ($auth->isRole("manage_users")) {
    $json = file_get_contents('../../../data/users/controlpanel_users.json');
    $userarray = json_decode($json, true);

    $userarray[(int)$_POST['user']]['roles'][$_POST['role']] = (int)$_POST['status'];

    if ($userarray[(int)$_POST['user']]['roles']['add_player'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['edit_player'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['delete_player'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['select_playlist'] === 1) {

      $userarray[(int)$_POST['user']]['roles']['main']['players'] = 1;
    } else {
      $userarray[(int)$_POST['user']]['roles']['main']['players'] = 0;
    }

    if ($userarray[(int)$_POST['user']]['roles']['add_media'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['edit_own_media'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['edit_all_media'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['delete_own_media'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['delete_all_media'] === 1) {

      $userarray[(int)$_POST['user']]['roles']['main']['media'] = 1;
    } else {
      $userarray[(int)$_POST['user']]['roles']['main']['media'] = 0;
    }

    if ($userarray[(int)$_POST['user']]['roles']['manage_media'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['add_playlist'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['delete_playlist'] === 1) {

      $userarray[(int)$_POST['user']]['roles']['main']['playlists'] = 1;
    } else {
      $userarray[(int)$_POST['user']]['roles']['main']['playlists'] = 0;
    }

    if ($userarray[(int)$_POST['user']]['roles']['add_users'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['manage_users'] === 1 ||
    $userarray[(int)$_POST['user']]['roles']['delete_users'] === 1) {

      $userarray[(int)$_POST['user']]['roles']['main']['users'] = 1;
    } else {
      $userarray[(int)$_POST['user']]['roles']['main']['users'] = 0;
    }

    file_put_contents('../../../data/users/controlpanel_users.json', json_encode($userarray));

    echo "success";
  } else {
    echo "norole";
  }


} else {
  echo "error";
}

?>
