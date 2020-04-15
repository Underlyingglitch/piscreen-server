<?php

session_start();

if (!isset($_SESSION['auth'])) {

  header("Location: login.php");

  exit;
}

include "includes/classes/auth.php";

$auth = new Auth();

$page = "users";

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

  <title>PiScreen - Gebruikers</title>

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
            <h1 class="h3 mb-2 text-gray-800">Gebruikers</h1>
            <button id="create-user-toggle" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nieuwe gebruiker</button>
          </div>
          <p class="mb-4">Bekijk, bewerk en maak nieuwe gebruikers voor uw PiScreen webportaal.</p>

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

  <!-- Role editor -->
  <div class="modal fade" id="roleEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="roleEditorTitle">{title}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="roleEditorBody">{content}</div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Sluiten</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Change password -->
  <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordTitle">{title}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="changePasswordBody">
          <input type="hidden" value="" id="username">
          <input class="form-control" style="margin-bottom: 4px" type="text" id="newPassword" placeholder="Nieuw wachtwoord">
          <input class="form-control" style="margin-bottom: 4px" type="text" id="repeatNewPassword" placeholder="Herhaal nieuw wachtwoord">
          <button class="btn btn-primary" id="changePasswordSave">Opslaan</button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Annuleren</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Block user -->
  <div class="modal fade" id="blockUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="blockUserTitle">{title}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="blockUserBody">{content}</div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-danger" type="button" id="proceed-block">Blokkeren</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Activate user -->
  <div class="modal fade" id="activateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="activateUserTitle">{title}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="activateUserBody">{content}</div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" type="button" id="proceed-activation">Activeren</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Create user -->
  <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Maak een nieuwe gebruiker</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <input class="form-control" id="newUserUsername" type="text" placeholder="Gebruikersnaam" style="margin-bottom: 4px">
          <input class="form-control" id="newUserPassword" type="password" placeholder="Wachtwoord" style="margin-bottom: 4px">
          <p>Na het aanmaken is het mogelijk de rollen te selecteren voor deze gebruiker</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Annuleren</button>
          <button class="btn btn-success" type="button" id="create-user-btn">Maak gebruiker</button>
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
