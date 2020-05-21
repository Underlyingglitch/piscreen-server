<?php

session_start();

$username = $_SESSION['auth'];

$target_dir = "../../../data/media/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

// Check if $uploadOk is set to 0 by an error
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
  $data = json_decode(file_get_contents("../../../data/media/media.json"), true);

  $dateTime = new \DateTime();

  $time = $dateTime->format('d-m-Y H:i:s');

  array_push($data, array("username" => $username, "filename" => $_FILES["file"]["name"], "timestamp" => $time));

  file_put_contents("../../../data/media/media.json", json_encode($data));
}

?>
