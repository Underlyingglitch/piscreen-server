<?php

$remoteImage = "/var/www/data/media/uploads/".$_GET['requested'];
$imginfo = getimagesize($remoteImage);
header("Content-type: {$imginfo['mime']}");
readfile($remoteImage);

?>
