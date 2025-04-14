<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('fotouser/' . session()->get('foto_user')) ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= session()->get('nama_lengkap') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url('fotouser/' . session()->get('foto_user')) ?>" class="img-circle" alt="User Image">
                  <p>
                    <?= session()->get('nama_lengkap') ?>
                    <small>Level :&nbsp;
                      <?php if (session()->get('level') == 1) {
                        echo 'Sekretaris';
                      } else if (session()->get('level') == 2) {
                        echo 'Pegawai';
                      } else if (session()->get('level') == 3) {
                        echo 'Satpam';
                      }
                      ?>
                      <br>
                      Last Login : <?= session()->get('last_login') ?>
                    </small>
                    </br>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url('update_profile/index') ?>" class="btn btn-default btn-flat"><i class="fa fa-fw fa-user"></i>&nbsp;Profile</a>
                  </div>
                  <div class="pull-right">
                    <button class="btn btn-default btn-flat" data-toggle="modal" data-target="#logout"><i class="fa fa-fw fa-key"></i>&nbsp;Sign Out</button></td>
                  </div>
                </li>
              </ul>
            </li>

        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Modal Logout-->
    <div class="modal fade" id="logout">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Keluar Sistem</h4>
          </div>
          <div class="modal-body">

            <h4>
              <p>
                <center>Apakah <?= session()->get('nama_lengkap') ?> Ingin Keluar Dari Sistem ?</b></center>
              </p>
            </h4>

          </div>

          <div class="modal-footer">
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-success pull-left btn-flat"> Done</a>
            <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>