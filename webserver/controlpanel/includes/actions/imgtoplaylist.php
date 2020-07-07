<?php

$imgs = json_decode($_POST['imgs'], true);
$id = htmlspecialchars(stripslashes($_POST['id']));

//TODO: add "manage_media" security

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);
$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

foreach ($imgs as $img) {
  //$img = image id
  $img = htmlspecialchars(stripslashes($img));
  array_push($playlists[$id]['media'], array("type" => "image", "id" => $img));
}

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
