<?php

$id = $_POST['id'];

//TODO: Add security

$media = json_decode(file_get_contents("../../../data/media/media.json"), true);

shell_exec("rm ../../../data/media/uploads/".$media[(int)$id]['filename']);

unset($media[(int)$id]);

file_put_contents("../../../data/media/media.json", json_encode($media));

echo "success";

?>
