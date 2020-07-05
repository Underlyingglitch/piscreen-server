<?php

session_start();

if (!isset($_SESSION['auth'])) {

  header("Location: login.php");

  exit;
}

include "includes/classes/auth.php";

$auth = new Auth();

$page = "media";

if (!$auth->isAnyRole("media")) {
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

  <title>PiScreen - Media</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/vendor/dropzone.js/basic.css">
  <link rel="stylesheet" href="/vendor/dropzone.js/dropzone.css">

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
            <h1 class="h3 mb-2 text-gray-800">Media</h1>
            <?php if ($auth->isRole('add_media')) { ?>
            <div class="dropdown">
              <button class="dropdown-toggled-none d-sm-inline-block btn btn-sm btn-success shadow-sm" type="button" id="addMediaBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus fa-sm text-white-50"></i> Voeg media toe</button>
              <div class="dropdown-menu" aria-labelledby="addMediaBtn">
                <a class="dropdown-item addMediaModalBtn" php-type="image">Upload afbeeling</a>
                <a class="dropdown-item addMediaModalBtn" php-type="text">Text bericht</a>
                <a class="dropdown-item addMediaModalBtn" php-type="url">Website (url)</a>
              </div>
            </div>
            <?php } ?>

          </div>
          <p class="mb-4">Bewerk en voeg nieuwe media toe om weer te geven op uw PiScreen installatie.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Alle media</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Gebruiker</th>
                      <th>Bestandsnaam</th>
                      <th>Timestamp</th>
                      <th>Gekoppelde afspeellijsten</th>
                      <th>Acties</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Gebruiker</th>
                      <th>Bestandsnaam</th>
                      <th>Timestamp</th>
                      <th>Gekoppelde afspeellijsten</th>
                      <th>Acties</th>
                    </tr>
                  </tfoot>
                  <tbody id="media">
                    <?php
                    $media = json_decode(file_get_contents("/var/www/data/media/media.json"), true);
                    foreach($media as $key => $value){
                    ?>
                    <tr>
                      <td><img src="includes/actions/loadmedia.php?requested=<?php echo $value['filename']; ?>" height="100px" \></td>
                      <td><?php echo $value['username']; ?></td>
                      <td><?php echo $value['filename']; ?></td>
                      <td><?php echo $value['timestamp']; ?></td>
                      <td><?php echo $auth->isRole('delete_own_media'); ?></td>
                      <td><?php if ($auth->isRole('delete_own_media') && $value['username'] == $_SESSION['auth'] || $auth->isRole('delete_all_media')) { ?><button class="btn btn-danger deleteMediaBtn" php-media-id="<?php echo $key; ?>">Verwijder</button><?php } ?> <?php if ($auth->isRole('edit_own_media') && $value['username'] == $_SESSION['auth'] || $auth->isRole('edit_all_media')) { ?><button class="btn btn-info renameMediaBtn" php-media-id="<?php echo $key; ?>">Wijzig naam</button><?php } ?></td>
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

  <!-- Confirm Delete Media-->
  <div class="modal fade" id="deleteMediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Weet u het zeker?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Weet u zeker dat u dit wilt verwijderen?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-danger deleteMediaBtnConfirm" id="">Verwijderen</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Text Modal-->
  <div class="modal fade" id="addTextModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voeg tekst toe</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Selecteer een mediavorm en klik op volgende.
          <select id="mediaTypeSelect">
            <option value="--">--</option>
            <option value="text">Tekst (mededelingen etc)</option>
            <option value="image">Afbeelding</option>
            <option value="url">Webpagina</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-primary" id="submitMediaType">Volgende</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Media Modal-->
  <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voeg afbeelding toe</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="includes/actions/fileupload.php" class="dropzone" id="imageUploadDropzone"></form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" id="closeMediaModal">Sluiten</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Url Modal-->
  <div class="modal fade" id="addUrlModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voeg webpagina toe</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Selecteer een mediavorm en klik op volgende.
          <select id="mediaTypeSelect">
            <option value="--">--</option>
            <option value="text">Tekst (mededelingen etc)</option>
            <option value="image">Afbeelding</option>
            <option value="url">Webpagina</option>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-primary" id="submitMediaType">Volgende</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Rename File Modal-->
  <div class="modal fade" id="renameMediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Wijzig naam</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="renameMediaModalBody"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" id="submitNewMediaName">Opslaan</button>
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

  <!-- Page level custom scripts -->
  <script src="vendor/dropzone.js/dropzone.js"></script>

  <script type="text/javascript">
  Dropzone.options.imageUploadDropzone = false;
  var uploader = $('#imageUploadDropzone').dropzone({
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 20, // MB
    acceptedFiles: "image/*",
    dictDefaultMessage: "Klik hier, of sleep de bestanden naar dit veld om te beginnen met uploaden"
  });
  </script>

  <script src="js/media.js"></script>

</body>

</html>
