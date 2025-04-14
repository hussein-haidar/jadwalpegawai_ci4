<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?= $title2 ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/skins/_all-skins.min.css">
  <!-- Custom icon styles for this template-->
  <link href="<?= base_url() ?>/icon/bpjs.ico" rel="shortcut icon">
  <!-- page script-->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- page css-->
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?= base_url('update_profile/index') ?>" class="navbar-brand"><b>Admin</b>LTE</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- /.messages-menu -->

              <!-- Notifications Menu -->

              <!-- Tasks Menu -->

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
                          echo 'Kacab';
                        } else if (session()->get('level') == 2) {
                          echo 'Sekretaris';
                        } else if (session()->get('level') == 3) {
                          echo 'Pegawai';
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $title ?>
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title ?></a></li>
          <li class="active"><a href="#"><?= $title2 ?></a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="box box-primary box-solid">
          <div class="box-header">
          </div>

          <!-- /.box-header -->
          <div class="box-body">
            <!-- /.alert windows success -->
            <?php
            if (session()->getFlashdata('pesan')) {
              echo '<div class="alert alert-success" role="alert">';
              echo session()->getFlashdata('pesan');
              echo '</div>';
            }
            ?>

            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th scope="col" width="1%">No</th>
                    <th>Nama Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Nama Perusahaan</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Alamat Kegiatan</th>
                    <th>Status Kegiatan</th>
                    <th scope="col" width="auto">Foto Kegiatan</th>
                    <th>Dokumen Kegiatan</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $no = 1;
                  foreach ($data_jadwal as $key => $value) {
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $value['nama_lengkap']; ?></td>
                      <td><?= $value['nama_unit']; ?></td>
                      <td><?= $value['nama_perusahaan']; ?></td>
                      <td><?= $value['nama_kegiatan']; ?></td>
                      <td><?= $value['tanggal_mulai']; ?></td>
                      <td><?= $value['tanggal_berakhir']; ?></td>
                      <td><?= $value['alamat_kegiatan']; ?></td>
                      <td>
                        <?php if ($value['status_kegiatan'] == 1) { ?>
                          <div class="btn btn-xs btn-warning">Proses</div>
                        <?php } elseif ($value['status_kegiatan'] == 2) { ?>
                          <div class="btn btn-xs btn-success">Selesai</div>
                        <?php } elseif ($value['status_kegiatan'] == 3) { ?>
                          <div class="btn btn-xs btn-danger">Tolak</div>
                        <?php } else { ?>
                          <div class="btn btn-xs btn-default">Tidak Diketahui</div>
                        <?php } ?>
                      </td>
                      <td><img src="<?= base_url('fotokegiatan/' . $value['foto_kegiatan']) ?>" class="img-circle" width="80px" height="80px"><a href="<?= base_url('home_pegawai/view_foto/' . $value['id_pegawai']) ?>">
                          <p>Lihat Foto</p>
                        </a></td>
                      <td style="text-align: center; vertical-align: center;"><a href="<?= base_url('home_pegawai/view_dokumen/' . $value['id_pegawai']) ?>" <i class="fa fa-file-pdf-o fa-4x label-danger" aria-hidden="true"></i></a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <!-- /.content -->
    </div>
    <!-- /.container -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#"> HSK</a>.</strong> All rights
    reserved.
  </footer>

  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src="<?= base_url() ?>/template/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url() ?>/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url() ?>/template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>/template/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- datepicker -->
  <script src="<?= base_url() ?>/template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- page script-->

  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false
      })

    })
  </script>
  <!-- Script slide up alert window otomatis -->
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>

  <!-- Script tampil gambar -->
  <script>
    function bacaGambar(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#gambar_load').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#preview_gambar').change(function() {
      bacaGambar(this);
    });
  </script>
  <!-- Script hide password -->
  <script>
    function myFunction() {
      var x = document.getElementById("ShowPass");
      if (x.type === "password") {
        x.type = "text";

      } else {
        x.type = "password";
      }
    }
  </script>
  <!-- Script button export -->


</body>

</html>