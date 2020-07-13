<?php

$player = htmlspecialchars(stripslashes($_POST['player']));
$playlist = htmlspecialchars(stripslashes($_POST['playlist']));

$players = json_decode(file_get_contents("/var/www/data/players.json"), true);

$players[$player]['active_playlist'] = $playlist;

file_put_contents("/var/www/data/players.json", json_encode($players));

echo "success";

?>
