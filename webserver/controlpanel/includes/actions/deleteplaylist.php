<?php

include "../classes/auth.php";
$auth = new Auth();

if (!$auth->isRole('delete_playlist')) {
  header('Location: ../../norole.php');
}

$id = $_POST['id'];

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

unlink($playlists[$id]);

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

?>
