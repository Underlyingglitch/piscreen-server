<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

$id = htmlspecialchars(stripslashes($_POST['id']));

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$users = json_decode(file_get_contents("/var/www/data/controlpanel_users.sjon"), true);

$username = $users[$_SESSION['id']]['username'];

if (
  (!$auth->isRole("edit_own_media") && !$auth->isRole("edit_all_media")) ||
  (!$auth->isRole("edit_all_media") && $auth->isRole("edit_own_media") && $media[(int)$id]['username'] != $username)
) {
  header("Location: ../../norole.php");
  exit;
}


$newname = htmlspecialchars(stripslashes($_POST['newname']));

$media[(string)$id]['filename'] = $newname;

file_put_contents("/var/www/data/media/media.json", json_encode($media));

echo "success";

?>
