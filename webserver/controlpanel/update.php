<?php

session_start();

if (!isset($_SESSION['auth'])) {
  header("Location: login.php");
  exit;
}

include "includes/classes/auth.php";

$auth = new Auth();

if (file_exists('/var/www/controlpanel/update')) {
  if (!$auth->isRole('admin')) {
    echo "Geen toegang tot deze pagina";
  } else {
    file_put_contents('/var/www/controlpanel/update.command', '');

    echo "Update in progress...";
    echo "<a href='index.php'>Klik hier om terug te gaan</a>";
  }
} else {
  echo "Geen update beschikbaar!";
}

?>
