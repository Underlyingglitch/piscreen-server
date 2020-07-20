<?php

session_start();

include "../classes/auth.php";
$auth = new Auth();

if (!$auth->isRole('manage_media')) {
  header('Location: ../../norole.php');
  exit;
}

$addmedia = json_decode($_POST['media'], true);
$id = htmlspecialchars(stripslashes($_POST['id']));

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);
$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

foreach ($addmedia as $entry) {
  array_push($playlists[$id]['media'], $media[$entry]);
}

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
