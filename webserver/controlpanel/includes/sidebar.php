<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
      <img src="img/logo_piscreen_small.png" height="40px" width="40px" \>
    </div>
    <div class="sidebar-brand-text mx-3">PiScreen</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php if ($page === "dashboard") { echo "active"; } ?>">
    <a class="nav-link" href="/">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Content
  </div>

  <?php if ($auth->isAnyRole("media")) { ?>
  <li class="nav-item <?php if ($page === "media") { echo "active"; } ?>">
    <a class="nav-link" href="media.php">
      <i class="fas fa-fw fa-image"></i>
      <span>Media</span></a>
  </li>
  <?php } ?>

  <?php if ($auth->isAnyRole("playlists")) { ?>
  <li class="nav-item <?php if ($page === "playlists") { echo "active"; } ?>">
    <a class="nav-link" href="playlists.php">
      <i class="fas fa-fw fa-play"></i>
      <span>Afspeellijsten</span></a>
  </li>
  <?php } ?>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Beheer
  </div>

  <?php if ($auth->isAnyRole("users")) { ?>
  <li class="nav-item <?php if ($page === "users") { echo "active"; } ?>">
    <a class="nav-link" href="users.php">
      <i class="fas fa-fw fa-users"></i>
      <span>Gebruikers</span></a>
  </li>
  <?php } ?>

  <?php if ($auth->isAnyRole("players")) { ?>
  <li class="nav-item <?php if ($page === "players") { echo "active"; } ?>">
    <a class="nav-link" href="players.php">
      <i class="fas fa-fw fa-tv"></i>
      <span>Players</span></a>
  </li>
  <?php } ?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
