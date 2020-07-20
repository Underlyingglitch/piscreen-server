<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

if (!$auth->isRole('manage_media')) {
  header('Location: ../../norole.php');
  exit;
}

$playlist = $_POST['playlistid'];
$mediaid = $_POST['id'];

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

$temp = $playlists[$playlist]['media'][$mediaid];
if ($_POST['action'] == "down") {
  $playlists[$playlist]['media'][$mediaid] = $playlists[$playlist]['media'][$mediaid+1];
  $playlists[$playlist]['media'][$mediaid+1] = $temp;
} else {
  $playlists[$playlist]['media'][$mediaid] = $playlists[$playlist]['media'][$mediaid-1];
  $playlists[$playlist]['media'][$mediaid-1] = $temp;
}

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
