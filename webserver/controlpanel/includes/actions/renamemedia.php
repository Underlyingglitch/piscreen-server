<?php

$id = htmlspecialchars(stripslashes($_POST['id']));
$newname = htmlspecialchars(stripslashes($_POST['newname']));

$files = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$oldname = $files[$id]['filename'];

$files[$id]['filename'] = $newname;

shell_exec(escapeshellcmd('mv /var/www/data/media/uploads/'.$oldname.' /var/www/data/media/uploads/'.$newname));

file_put_contents("/var/www/data/media/media.json", json_encode($files));

?>
