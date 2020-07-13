<?php

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);
echo "<option value='--'>--</option>";
foreach($playlists as $key => $value) { ?>
  <option value="<?php echo $key; ?>"><?php echo $value['name']; ?></option>
<?php } ?>
