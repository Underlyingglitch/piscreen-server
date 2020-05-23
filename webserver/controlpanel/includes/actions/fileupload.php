<?php

session_start();

$username = $_SESSION['auth'];

$target_dir = "../../../data/media/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if $uploadOk is set to 0 by an error
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
  //chmod($target_file, 666);
  $data = json_decode(file_get_contents("../../../data/media/media.json"), true);

  $dateTime = new \DateTime();

  $time = $dateTime->format('d-m-Y H:i:s');

  array_unshift($data, array("username" => $username, "filename" => $_FILES["file"]["name"], "filetype" => $imageFileType, "timestamp" => $time));

  file_put_contents("../../../data/media/media.json", json_encode($data));
}

?>
