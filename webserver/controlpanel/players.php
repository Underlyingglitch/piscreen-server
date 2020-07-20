<?php

session_start();

if (!isset($_SESSION['auth'])) {

  header("Location: login.php");

  exit;
}

include "includes/classes/auth.php";

$auth = new Auth();

$page = "players";

if (!$auth->isAnyRole("players")) {
  header("Location: /");
}

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PiScreen - Players</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include "includes/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "includes/nav.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Players</h1>
            <button id="create-player-toggle" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nieuwe player</button>
          </div>
          <p class="mb-4">Beheer de players van uw PiScreen installatie.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Alle gebruikers</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Naam</th>
                      <th>IP</th>
                      <th>Status</th>
                      <th>Afspeellijst</th>
                      <th>Acties</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Naam</th>
                      <th>IP</th>
                      <th>Status</th>
                      <th>Afspeellijst</th>
                      <th>Acties</th>
                    </tr>
                  </tfoot>
                  <tbody id="players">
                    <?php

                    $data_path = "/var/www/data/";

                    $json = file_get_contents($data_path.'players.json');
                    if (filesize($data_path.'players.json') != 0) {
                      $playerarray = json_decode($json, true);

                      foreach ($playerarray as $player) {
                        ?>
                        <tr>
                          <td><?php echo $player['name']; ?></td>
                          <td><?php echo $player['ip']; ?></td>
                          <td class="status-box" style="background-color: orange; color: black">Laden...</td>
                          <td><?php if ($player['active_playlist'] != "--") { echo $playlists[$player['active_playlist']]['name']; } else { echo "Geen afspeellijst"; } ?></td>
                          <td>
                            <button class="btn btn-info select-playlist-btn" php-player-id="<?php echo $player['code']; ?>">Afspeellijst</button>
                            <button class="btn btn-danger delete-player-btn" php-player-id="<?php echo $player['code']; ?>">Verwijder</button></td>
                        </tr>

                      <?php
                    } }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2019 PiScreen</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Uitloggen</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik op <strong>Uitloggen</strong> om definitief uit te loggen!</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <a class="btn btn-warning" href="logout.php">Uitloggen</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="addPlayer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voeg player toe</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Vul onderstaande velden in om een nieuwe player te koppelen aan uw PiScreen installatie.<br>
          <input class="form-control" type="text" id="newPlayerName" placeholder="Naam van player" style="margin-bottom: 4px">
          <input class="form-control" type="text" id="newPlayerIP" placeholder="IP adres (xxx.xxx.xx.xx)" style="margin-bottom: 4px">
          <input class="form-control" type="text" id="newPlayerCode" placeholder="Beveiligingscode" style="margin-bottom: 4px" maxlength="6" min="0" max="6">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" id="addPlayerBtn">Voeg toe</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit playlist modal -->
  <div class="modal fade" id="editPlaylist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Verander afspeellijst</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <select id="editPlaylistSelect"></select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" id="editPlaylistSubmit">Push wijzigingen</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script>

  var serverIP = "<?php echo $_SERVER['SERVER_ADDR']; ?>";
  </script>

  <script src="vendor/ipinputmask/mask.ip-input.js"></script>

  <script src="js/players.js"></script>


</body>

</html>
