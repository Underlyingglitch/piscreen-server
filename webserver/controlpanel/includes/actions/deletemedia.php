<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

$id = $_POST['id'];

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$users = json_decode(file_get_contents("/var/www/data/controlpanel_users.sjon"), true);

$username = $users[$_SESSION['id']]['username'];

if (
  (!$auth->isRole("delete_own_media") && !$auth->isRole("delete_all_media")) ||
  (!$auth->isRole("delete_all_media") && $auth->isRole("delete_own_media") && $media[(int)$id]['username'] != $username)
) {
  header("Location: ../../norole.php");
}

shell_exec("rm /var/www/data/media/uploads/".$media[(int)$id]['filename']);

unset($media[(int)$id]);

file_put_contents("/var/www/data/media/media.json", json_encode($media));

echo "success";

?>
