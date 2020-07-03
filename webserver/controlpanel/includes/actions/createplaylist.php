<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

if (!$auth->isRole("add_playlist")) {
  header("Location: ../../norole.php");
}

$name = htmlspecialchars(stripslashes($_POST['name']));

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

array_push($playlists, array("name" => $name, "media" => array()));

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
