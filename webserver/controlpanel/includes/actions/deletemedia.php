<?php

$id = $_POST['id'];

//TODO: Add security

$media = json_decode(file_get_contents("../../../data/media/media.json"), true);

$data = $media[$i];

unset($media[(int)$i]);

file_put_contents("../../../data/media/media.json", json_encode($media));

if(file_exists("../../../data/media/uploads/".$data['filename'])) {
	unlink("../../../data/media/uploads/".$data['filename']);
}

echo "success";

?>
