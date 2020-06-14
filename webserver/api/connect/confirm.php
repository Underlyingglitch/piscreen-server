<?php

if (isset($_GET['client']) && isset($_GET['code']) && isset($_GET['name'])) {
  $json = file_get_contents("/var/www/data/players/players.json");
  $playerarray = json_decode($json, true);

  print_r($playerarray);

  $newdata = array("name" => htmlspecialchars(stripslashes($_GET['name'])), "ip" => htmlspecialchars(stripslashes($_GET['client'])), "code" => htmlspecialchars(stripslashes($_GET['code'])));

  array_push($playerarray, $newdata);

  file_put_contents("/var/www/data/players/players.json", json_encode($playerarray));

  //file_get_contents("http://".$_GET['client'].":31804/server/reboot.php");

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,'http://'.$_GET['server'].':31804/connect/confirm.php');

  $server_output = curl_exec($ch);

  curl_close ($ch);

  echo "success";
}

?>
