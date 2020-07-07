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

if (!$auth->isRole("manage_media")) {
  header("Location: norole.php");
}

$id = $_GET['id'];

$playlists = json_decode(file_get_contents("/var/www/data/playlists.json"), true);
$media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);

$playlist = $playlists[$id];

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PiScreen - Afspeellijst bewerken</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
    .selected {
      border-style: solid;
      border-color: green;
      border-width: 3px;
    }
  </style>

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
            <h1 class="h3 mb-2 text-gray-800">Afspeellijst bewerken</h1>
            <button id="addMediaBtn" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Voeg media toe</button>
          </div>
          <p class="mb-4">Bewerk afspeellijst: <strong><?php echo $playlist['name']; ?></strong></p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Alle afspeellijsten</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div style="display: none" id="playlistid"><?php echo $id; ?></div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Type</th>
                      <th>Naam</th>
                      <th>Acties</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Type</th>
                      <th>Naam</th>
                      <th>Acties</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach($playlist['media'] as $key => $value) { ?>
                      <tr>
                        <?php if ($value['type'] == "image") { ?>
                          <?php $img = $media[$value['id']]; ?>
                          <td><img height="100px" src="includes/actions/loadmedia.php?requested=<?php echo $img['id'].".".$img['ext']; ?>" \></td>
                          <td><?php echo $value['type']; ?></td>
                          <td><?php echo $img['filename']; ?></td>
                        <?php } ?>
                        <td>
                          <?php if ($key != 0) { ?><button class="btn btn-info move-media-up-btn" php-media-id="<?php echo $key; ?>"><i class="fas fa-chevron-up"></i></button> <?php } ?>
                          <?php if ($key != count($playlist['media'])-1) { ?><button class="btn btn-info move-media-down-btn" php-media-id="<?php echo $key; ?>"><i class="fas fa-chevron-down"></i></button> <?php } ?>
                          <button class="btn btn-danger delete-media-btn" php-media-id="<?php echo $key; ?>">Verwijder</button></td>
                      </tr>

                    <?php } ?>
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

  <!-- Add media modal-->
  <div class="modal fade bd-example-modal-lg" id="addMediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voeg nieuwe media toe</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="imgSelect"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" id="cancelAddImgs">Annuleren</button>
          <button class="btn btn-success" php-playlist-id="<?php echo $_GET['id']; ?>" id="confirmAddImgs">Voeg toe</button>
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

  <script src="js/editplaylist.js"></script>

</body>

</html>
