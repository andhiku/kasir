<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="#" class="nav-link" data-toggle="dropdown">
        <i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
        <a href="<?php echo site_url('auth/logout') ?>" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
 
</nav>
<!-- /.navbar -->