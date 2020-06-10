<?php

if (isset($_GET['client']) && isset($_GET['code']) && isset($_GET['name'])) {
  $json = file_get_contents("../../data/players/players.json");
  $playerarray = json_decode($json, true);

  $newdata = array("name" => htmlspecialchars(stripslashes($_GET['name'])), "ip" => htmlspecialchars(stripslashes($_POST['client'])), "code" => htmlspecialchars(stripslashes($_POST['code'])));

  array_push($playerarray, $newdata);

  file_put_contents("../../data/players/players.json", json_encode($playerarray));

  echo "success";
}

?>
