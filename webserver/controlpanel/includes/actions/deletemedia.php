<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

$id = $_POST['id'];

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);
$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);
$users = json_decode(file_get_contents("/var/www/data/controlpanel_users.sjon"), true);

$username = $users[$_SESSION['id']]['username'];

if (
  (!$auth->isRole("delete_own_media") && !$auth->isRole("delete_all_media")) ||
  (!$auth->isRole("delete_all_media") && $auth->isRole("delete_own_media") && $media[$id]['username'] != $username)
) {
  header("Location: ../../norole.php");
  exit;
}

shell_exec("rm /var/www/data/media/uploads/".$media[$id]['filename']);

foreach ($playlists as $key => $playlist) {
  foreach ($playlist['media'] as $key2 => $pmedia) {
    if ($pmedia['id'] == $id) {
      unset($playlists[$key]['media'][$key2]);
    }
  }
}

unset($media[$id]);

file_put_contents("/var/www/data/media/media.json", json_encode($media));
file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
