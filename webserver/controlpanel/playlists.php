<?php

session_start();

if (!isset($_SESSION['auth'])) {

  header("Location: login.php");

  exit;
}

include "includes/classes/auth.php";

$auth = new Auth();

$page = "playlists";

if (!$auth->isAnyRole("playlists")) {
  header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PiScreen - Afspeellijsten</title>

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
            <h1 class="h3 mb-2 text-gray-800">Afspeellijsten</h1>
            <button id="create-playlist-toggle" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nieuwe afspeellijst</button>
          </div>
          <p class="mb-4">Bekijk, wijzig en voeg nieuwe afspeellijsten toe aan uw PiScreen installatie.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Alle afspeellijsten</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Naam</th>
                      <th>Media (aantal)</th>
                      <th>Players</th>
                      <th>Acties</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Naam</th>
                      <th>Media (aantal)</th>
                      <th>Players</th>
                      <th>Acties</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php

                    $data_path = "/var/www/data/";

                    $playlists = json_decode(file_get_contents($data_path.'playlists.json'), true);

                    $players = json_decode(file_get_contents($data_path.'players/players.json'), true);



                    for ($i=0; $i<count($playlists); $i++) {
                      $playlistplayers = [];
                      foreach ($players as $key => $value) {
                        if ($value['active_playlist'] === $i) {
                          array_push($playlistplayers, $value['name']);
                        }
                      }
                      ?>
                      <tr>
                        <td><?php echo $playlists[$i]['name']; ?></td>
                        <td><?php echo count($playlists[$i]['media']); ?></td>
                        <td><?php if (count($playlistplayers) == 0) { echo "<i>Geen players met deze afspeellijst</i>"; } else { print_r(implode(', ', $playlistplayers)); } ?></td>
                        <td>
                        <?php if ($auth->isRole("manage_media")) { ?>
                          <button class="btn btn-info edit-playlist-btn" php-playlist-id="<?php echo $i; ?>">Bewerk afspeellijst</button>
                        <?php } ?>
                        <?php if ($auth->isRole("delete_playlist")) { ?>
                          <button class="btn btn-danger delete-playlist-btn" php-playlist-id="<?php echo $id; ?>">Verwijder afspeellijst</button>
                        <?php } ?>
                        </td>
                      </tr>

                      <?php
                    }

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

  <!-- Confirm delete modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Weet u het zeker?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Weet u zeker dat u de afspeellijst met het id <strong id="confirmDeleteId"></strong> wilt verwijderen?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <a class="btn btn-danger" id="confirmDeletePlaylist" php-playlist-id="">Uitloggen</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Create playlist modal-->
  <div class="modal fade" id="createPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nieuwe afspeellijst</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control" id="newPlaylistName" placeholder="Naam" \>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" id="confirmCreatePlaylist" php-playlist-id="">Maak afspeellijst</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/main.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script src="js/playlists.js"></script>

</body>

</html>
