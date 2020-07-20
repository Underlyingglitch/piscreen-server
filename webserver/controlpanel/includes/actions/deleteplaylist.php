<?php

session_start();

include "../classes/auth.php";
$auth = new Auth();

if (!$auth->isRole('delete_playlist')) {
  header('Location: ../../norole.php');
  exit;
}

$id = $_POST['id'];

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);
$players = json_decode(file_get_contents("/var/www/data/players.json"), true);

foreach ($players as $key => $player) {
  if ($player['active_playlist'] == $id) {
    $players[$key]['active_playlist'] = "--";
  }
}

unset($playlists[$id]);

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));
file_put_contents("/var/www/data/players.json", json_encode($players));

echo "success";

?>
