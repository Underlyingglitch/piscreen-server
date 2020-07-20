<?php

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

?>
<table id="mediaSelectTable">
  <tr>
  <?php $x=0; foreach ($media as $key => $value) { ?>
    <?php if ($x == 3) { ?>
      </tr>
      <tr>
        <td>
          <?php if ($value['type'] == "image") { ?>
            <img class="mediaSelect" php-media-id="<?php echo $key; ?>" width="200px" src="../includes/actions/loadmedia.php?requested=<?php echo $key . "." . $value['ext']; ?>" \>
          <?php } else if ($value['type'] == "text") { ?>
            <div class="mediaSelect" php-media-id="<?php echo $key; ?>"><?php echo chunk_split($value['value'], 30); ?></div>
          <?php } ?>
        </td>
    <?php $x=0; } else { ?>
      <td>
        <?php if ($value['type'] == "image") { ?>
          <img class="mediaSelect" php-media-id="<?php echo $key; ?>" width="200px" src="../includes/actions/loadmedia.php?requested=<?php echo $key . "." . $value['ext']; ?>" \>
        <?php } else if ($value['type'] == "text") { ?>
          <div class="mediaSelect" php-media-id="<?php echo $key; ?>"><?php echo chunk_split($value['value'], 30); ?></div>
        <?php } ?>
      </td>
    <?php } $x++; ?>
  <?php } ?>
</tr>
</table>
