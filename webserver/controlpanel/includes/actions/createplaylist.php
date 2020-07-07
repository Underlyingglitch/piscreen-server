<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

if (!$auth->isRole("add_playlist")) {
  header("Location: ../../norole.php");
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$name = htmlspecialchars(stripslashes($_POST['name']));
$playlistid = generateRandomString();

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

$playlists[$playlistid] = array("name" => $name, "id" => $playlistid, "media" => array());

file_put_contents("/var/www/data/playlists.json", json_encode($playlists));

echo "success";

?>
