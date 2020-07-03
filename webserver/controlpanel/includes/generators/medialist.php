<?php
$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

foreach($media as $key => $value){
?>
<tr>
  <td><img src="includes/actions/loadmedia.php?requested=<?php echo $value['filename']; ?>" height="100px" \></td>
  <td><?php echo $value['username']; ?></td>
  <td><?php echo $value['filename']; ?></td>
  <td><?php echo $value['timestamp']; ?></td>
  <td></td>
  <td><button class="btn btn-danger">Verwijder</button> <button class="btn btn-info">Wijzig naam</button></td>
</tr>
<?php
}
?>
