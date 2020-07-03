<?php

$id = $_POST['id'];

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$file = explode(".", $media[$id]['filename']);

?>

<div class="col-auto">
  <div class="input-group mb-2">
    <input class="form-control" type="text" id="newMediaName" php-media-id="<?php echo $id; ?>" placeholder="<?php echo $file[0]; ?>" \>
    <div class="input-group-prepend">
      <div class="input-group-text" id="newMediaNameExt">.<?php echo $file[1]; ?></div>
    </div>
  </div>
</div>
