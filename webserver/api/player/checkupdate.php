<?php

$code = $_GET['code'];
$hash = $_GET['hash'];

$players = json_decode(file_get_contents("/var/www/data/players.json"), true);
$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

if ($players[$code]['active_playlist'] == "--") {
  $check = "d751713988987e9331980363e24189ce";
} else {
  $check = md5(str_replace(" ", "", json_encode($playlists[$players[$code]['active_playlist']])));
}


if ($check == $hash) {
  echo "false";
} else {
  echo "true";
}

?>
