<?php

$json = file_get_contents('/var/www/data/controlpanel_users.json');
$userarray = json_decode($json, true);


//Getting userid
for ($i=0; $i<count($userarray); $i++) {
  if ($userarray[$i]['username'] === $_POST['username']) {
    break;
  }
}

?>

<div class="row">
  <div class="col-md-3">
    <h5>Players</h5>
    <button class="btn <?php if ($userarray[$i]['roles']['add_player'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="add_player" php-status="<?php echo $userarray[$i]['roles']['add_player']; ?>" style="margin-bottom: 4px">Players toevoegen</button>
    <button class="btn <?php if ($userarray[$i]['roles']['edit_player'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="edit_player" php-status="<?php echo $userarray[$i]['roles']['edit_player']; ?>" style="margin-bottom: 4px">Players bewerken</button>
    <button class="btn <?php if ($userarray[$i]['roles']['delete_player'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="delete_player" php-status="<?php echo $userarray[$i]['roles']['delete_player']; ?>" style="margin-bottom: 4px">Players verwijderen</button>
    <button class="btn <?php if ($userarray[$i]['roles']['select_playlist'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="select_playlist" php-status="<?php echo $userarray[$i]['roles']['select_playlist']; ?>">Afspeellijst selecteren</button>
  </div>
  <div class="col-md-3">
    <h5>Media</h5>
    <button class="btn <?php if ($userarray[$i]['roles']['add_media'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="add_media" php-status="<?php echo $userarray[$i]['roles']['add_media']; ?>" style="margin-bottom: 4px">Toevoegen</button>
    <button class="btn <?php if ($userarray[$i]['roles']['edit_own_media'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="edit_own_media" php-status="<?php echo $userarray[$i]['roles']['edit_own_media']; ?>" style="margin-bottom: 4px">Eigen media bewerken</button>
    <button class="btn <?php if ($userarray[$i]['roles']['edit_all_media'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="edit_all_media" php-status="<?php echo $userarray[$i]['roles']['edit_all_media']; ?>" style="margin-bottom: 4px">Alle media bewerken</button>
    <button class="btn <?php if ($userarray[$i]['roles']['delete_own_media'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="delete_own_media" php-status="<?php echo $userarray[$i]['roles']['delete_own_media']; ?>" style="margin-bottom: 4px">Eigen media verwijderen</button>
    <button class="btn <?php if ($userarray[$i]['roles']['delete_all_media'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="delete_all_media" php-status="<?php echo $userarray[$i]['roles']['delete_all_media']; ?>">Alle media verwijderen</button>
  </div>
  <div class="col-md-3">
    <h5>Afspeellijsten</h5>
    <button class="btn <?php if ($userarray[$i]['roles']['add_playlist'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="add_playlist" php-status="<?php echo $userarray[$i]['roles']['add_playlist']; ?>" style="margin-bottom: 4px">Playlist aanmaken</button>
    <button class="btn <?php if ($userarray[$i]['roles']['delete_playlist'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="delete_playlist" php-status="<?php echo $userarray[$i]['roles']['delete_playlist']; ?>" style="margin-bottom: 4px">Playlist verwijderen</button>
    <button class="btn <?php if ($userarray[$i]['roles']['manage_media'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="manage_media" php-status="<?php echo $userarray[$i]['roles']['manage_media']; ?>">Media beheren</button>
  </div>
  <div class="col-md-3">
    <h5>Gebruikers</h5>
    <button class="btn <?php if ($userarray[$i]['roles']['add_users'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="add_users" php-status="<?php echo $userarray[$i]['roles']['add_users']; ?>" style="margin-bottom: 4px">Gebruiker aanmaken</button>
    <button class="btn <?php if ($userarray[$i]['roles']['delete_users'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="delete_users" php-status="<?php echo $userarray[$i]['roles']['delete_users']; ?>" style="margin-bottom: 4px">Gebruiker verwijderen</button>
    <button class="btn <?php if ($userarray[$i]['roles']['manage_users'] === 1) { echo 'btn-success'; } else { echo 'btn-danger'; } ?> role-btn" php-role="manage_users" php-status="<?php echo $userarray[$i]['roles']['manage_users']; ?>">Gebruikers beheren</button>
  </div>
</div>

<script>
$(document).ready(function(){

  var user = <?php echo $i; ?>;

  $('.role-btn').on('click', function(){
    var role = $(this).attr('php-role');
    var status = $(this).attr('php-status');
    if (status == "0") {
      var newstatus = 1;
    } else {
      var newstatus = 0;
    }
    var elementClicked = $(this);
    $.post('includes/actions/edit_role.php', {user: user, status: newstatus, role: role}, function(data){
      if (data == "success") {
        if (status == "0") {
          elementClicked.removeClass('btn-danger');
          elementClicked.addClass('btn-success');
          elementClicked.attr('php-status', '1');
        } else {
          elementClicked.removeClass('btn-success');
          elementClicked.addClass('btn-danger');
          elementClicked.attr('php-status', '0');
        }
      } else {
        alert('Waarschuwing: update gefaald!');
        alert(data);
      }
    });
  });
});
</script>
