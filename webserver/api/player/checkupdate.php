<?php

$code = $_GET['code'];
$hash = $_GET['hash'];

$players = json_decode(file_get_contents("/var/www/data/players.json"), true);
$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

if (md5(json_encode($playlists[$players[$code]['active_playlist']])) == $hash) {
  echo "false";
} else {
  echo "true";
}

?>
