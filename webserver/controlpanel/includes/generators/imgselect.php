<?php

$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$imgs = [];
$txts = [];

foreach ($media as $key => $value) {
  if ($value['type'] == "image") {
    //array_push($imgs, $value);
    $imgs[$key] = $value;
  }
  // else if ($value['type'] == "text") {
  //   array_push($txts, $value);
  // }
}

?>
<table id="imgSelectTable">
  <tr>
  <?php $x=0; foreach ($imgs as $key => $value) { ?>
    <?php if ($x == 3) { ?>
      </tr>
      <tr>
        <td>
          <img class="imgSelect" php-img-id="<?php echo $key; ?>" width="200px" src="../includes/actions/loadmedia.php?requested=<?php echo $key . "." . $value['ext']; ?>" \>
        </td>
    <?php $x=0; } else { ?>
      <td>
        <img class="imgSelect" php-img-id="<?php echo $key; ?>" width="200px" src="../includes/actions/loadmedia.php?requested=<?php echo $key . "." . $value['ext']; ?>" \>
      </td>
    <?php } $x++; ?>
  <?php } ?>
</tr>
</table>
