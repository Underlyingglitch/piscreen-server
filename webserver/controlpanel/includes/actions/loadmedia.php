<?php

// $content = file_get_contents("../../../data/media/uploads/".$_GET['requested']);
// $content = base64_encode($content);
//
// $data = "data:image/png;base64,{$content}";
//
// header('Content-Type: image/png');
// echo base64_decode($data);

$remoteImage = "/var/www/data/media/uploads/".$_GET['requested'];
$imginfo = getimagesize($remoteImage);
header("Content-type: {$imginfo['mime']}");
readfile($remoteImage);

?>
