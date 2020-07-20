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

$fileid = generateRandomString();

$target_dir = "/var/www/data/media/uploads/";
$target_file = $target_dir . $fileid . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if $uploadOk is set to 0 by an error
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
  //chmod($target_file, 666);
  $data = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

  $dateTime = new \DateTime();

  $time = $dateTime->format('d-m-Y H:i:s');

  $data[$fileid] = array(
    "id" => $fileid,
    "type" => "image",
    "ext" => pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION),
    "username" => $username,
    "filename" => $_FILES["file"]["name"],
    "filetype" => $imageFileType,
    "timestamp" => $time);

  file_put_contents("/var/www/data/media/media.json", json_encode($data));
}

?>
