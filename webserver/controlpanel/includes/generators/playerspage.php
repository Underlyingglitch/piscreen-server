<?php

$data_path = "../../../data/";

$json = file_get_contents($data_path.'players/players.json');
$playerarray = json_decode($json, true);

for ($i=0; $i<count($playerarray); $i++) {
  ?>
  <tr>
    <td><?php echo $playerarray[$i]['name']; ?></td>
    <td><?php echo $playerarray[$i]['ip']; ?></td>
    <td class="status-box" php-ip="<?php echo $playerarray[$i]['ip']; ?>"></td>
    <td><button class="btn btn-primary change-password-btn" username="<?php echo $userarray[$i]['username']; ?>">Reset wachtwoord</button> <button class="btn btn-info role-edit-btn" username="<?php echo $userarray[$i]['username']; ?>">Rollen</button><?php if ($userarray[$i]['blocked'] == 0) { ?> <button class="btn btn-warning block-user-btn" username="<?php echo $userarray[$i]['username']; ?>">Blokkeer</button><?php } else { ?> <button class="btn btn-success activate-user-btn" username="<?php echo $userarray[$i]['username']; ?>">Activeer</button><?php } ?> <button class="btn btn-danger delete-btn" username="<?php echo $userarray[$i]['username']; ?>">Verwijder</button></td>
    <!-- TODO: copy design from original page -->
  </tr>

  <?php
}

?>
