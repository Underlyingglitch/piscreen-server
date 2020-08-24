<?php

$code = $_GET['code'];

$players = json_decode(file_get_contents("/var/www/data/players.json"), true);
$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);


if ($players[$code]['active_playlist'] == "--") {
  echo "empty";
} else {
  echo json_encode($playlists[$players[$code]['active_playlist']]);
}

?>
