<?php

$data_path = "../../../data/";

$json = file_get_contents($data_path.'users/controlpanel_users.json');
$userarray = json_decode($json, true);

for ($i=0; $i<count($userarray); $i++) {
  ?>
  <tr>
    <td><?php echo $userarray[$i]['username']; ?></td>
    <td><?php echo $userarray[$i]['last_login']; ?></td>
    <td><?php echo $userarray[$i]['last_ip_address']; ?></td>
    <td><button class="btn btn-primary change-password-btn" username="<?php echo $userarray[$i]['username']; ?>">Reset wachtwoord</button> <button class="btn btn-info role-edit-btn" username="<?php echo $userarray[$i]['username']; ?>">Rollen</button><?php if ($userarray[$i]['blocked'] == 0) { ?> <button class="btn btn-warning block-user-btn" username="<?php echo $userarray[$i]['username']; ?>">Blokkeer</button><?php } else { ?> <button class="btn btn-success activate-user-btn" username="<?php echo $userarray[$i]['username']; ?>">Activeer</button><?php } ?> <button class="btn btn-danger delete-btn" username="<?php echo $userarray[$i]['username']; ?>">Verwijder</button></td>
  </tr>

  <?php
}

?>
<script src="js/users.js"></script>
