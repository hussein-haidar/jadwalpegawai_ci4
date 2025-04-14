  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title ?></a></li>
        <li class="active"><a href="#"><?= $title2 ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
      if ($isi) {
        echo view($isi);
      }
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->