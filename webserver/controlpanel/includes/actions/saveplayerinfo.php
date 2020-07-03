<?php

if (isset($_POST['code']) && isset($_POST['ip']) && isset($_POST['name'])) {

  $json = file_get_contents("/var/www/data/players/players.json");
  $playerarray = json_decode($json, true);

  $newdata = array("name" => htmlspecialchars(stripslashes($_POST['name'])), "ip" => htmlspecialchars(stripslashes($_POST['ip'])), "code" => htmlspecialchars(stripslashes($_POST['code'])), "active_playlist" => "");

  array_push($playerarray, $newdata);

  file_put_contents("/var/www/data/players/players.json", json_encode($playerarray));

  echo "success";
}

?>
