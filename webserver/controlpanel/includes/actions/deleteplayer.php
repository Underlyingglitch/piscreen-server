<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

if (!$auth->isRole('delete_player')) {
  header('Location: ../../norole.php');
  exit;
}

$players = json_decode(file_get_contents("/var/www/data/players.json"), true);
$playerid = $_POST['id'];
$player = $players[$playerid];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,'http://'.$player['ip'].':31804/server/reset.php');

$server_output = curl_exec($ch);

curl_close($ch);

if ($server_output == "success") {
  unset($players[$playerid]);
  file_put_contents("/var/www/data/players.json", json_encode($players));
  echo "success";
} else {
  echo "error";
}

?>
