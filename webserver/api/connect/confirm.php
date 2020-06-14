<?php

if (isset($_POST['client']) && isset($_POST['code']) && isset($_POST['name'])) {
  $json = file_get_contents("/var/www/data/players/players.json");
  $playerarray = json_decode($json, true);

  print_r($playerarray);

  $newdata = array("name" => htmlspecialchars(stripslashes($_POST['name'])), "ip" => htmlspecialchars(stripslashes($_POST['client'])), "code" => htmlspecialchars(stripslashes($_POST['code'])));

  array_push($playerarray, $newdata);

  file_put_contents("/var/www/data/players/players.json", json_encode($playerarray));

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,'http://'.$_POST['client'].':31804/server/reboot.php');
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "code=".$_POST['code']);

  $server_output = curl_exec($ch);

  curl_close ($ch);
}

?>
