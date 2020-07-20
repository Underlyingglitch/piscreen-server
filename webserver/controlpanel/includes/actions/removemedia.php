<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

if (!$auth->isRole('manage_media')) {
  header('Location: ../../norole.php');
  exit;
}

$playlistid = htmlspecialchars(stripslashes($_POST['playlistid']));
$mediaid = htmlspecialchars(stripslashes($_POST['id']));

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

unset($playlists[$playlistid]['media'][$mediaid]);

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
