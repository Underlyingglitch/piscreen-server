<?php

session_start();

$page = "players";

include "includes/classes/auth.php";

$auth = new Auth();

if (!isset($_SESSION['auth'])) {

  header("Location: login.php");

  exit;
}

if (!$auth->isAnyRole("players")) {
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

  <title>PiScreen - Players</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
          <p class="mb-4">Bekijk en voeg nieuwe players toe aan uw PiScreen installatie.</p>

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
                      <th>Laatste inlog</th>
                      <th>Laatste IP</th>
                      <th>Acties</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Naam</th>
                      <th>Laatste inlog</th>
                      <th>Laatste IP</th>
                      <th>Acties</th>
                    </tr>
                  </tfoot>
                  <tbody id="users">
                    <?php

                    $data_path = "../data/";

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
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <script src="js/users.js"></script>

</body>

</html>
