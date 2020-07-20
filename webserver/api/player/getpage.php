<?php

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$requested = $_GET['id'].".".$media[$_GET['id']]['ext'];

if ($_GET['type'] == "image") {
  $remoteImage = "/var/www/data/media/uploads/".$requested;
  $imginfo = getimagesize($remoteImage);
  header("Content-type: {$imginfo['mime']}");
  readfile($remoteImage);
}
?>
