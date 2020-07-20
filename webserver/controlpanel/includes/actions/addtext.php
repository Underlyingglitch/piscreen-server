<?php

session_start();

include "../classes/auth.php";

$auth = new Auth();

if (!$auth->isRole("add_media")) {
  header("Location: ../../norole.php");
  exit;
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

$username = $_SESSION['auth'];

$text = htmlspecialchars(stripslashes($_POST['text']));

$data = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$dateTime = new \DateTime();

$time = $dateTime->format('d-m-Y H:i:s');

$id = generateRandomString();

$data[$id] = array(
  "id" => $id,
  "type" => "text",
  "username" => $username,
  "value" => $text,
  "timestamp" => $time);

file_put_contents("/var/www/data/media/media.json", json_encode($data));

echo "success";

?>
