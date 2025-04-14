<div class="box box-primary box-solid">
  <div class="box-header">
    <a href="<?= base_url('satpam_kelola_data/add_kendaraan') ?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
      Tambah Data</a>
    <a href="<?= base_url('satpam_kelola_data/data_kendaraan_dihapus') ?>" class="btn btn-sm btn-primary">Lihat Data Dihapus</a>
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
            <th>Nama Kendaraan</th>
            <th>Jenis Kendaraan</th>
            <th>Plat Kendaraan</th>
            <th>Stok Kendaraan</th>
            <th>Status Kendaraan</th>
            <th>Foto Kendaraan</th>
            <th scope="col" width="auto">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($data_kendaraan as $key => $value) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_kendaraan']; ?></td>
              <td><?php if ($value['jenis_kendaraan'] == 1) {
                    echo 'Roda 2';
                  } else if ($value['jenis_kendaraan'] == 2) {
                    echo 'Roda 4';
                  }
                  ?>
              </td>
              <td><?= $value['plat_kendaraan']; ?></td>
              <td><?= $value['stok_kendaraan']; ?></td>
              <td>
                <?php if ($value['status_kendaraan'] == 1) { ?>
                  <span class="label label-warning">Tidak</span>
                <?php } elseif ($value['status_kendaraan'] == 2) { ?>
                  <span class="label label-success">Dinas</span>
                <?php } else { ?>
                  <span class="label label-default">Tidak Diketahui</span>
                <?php } ?>
              </td>
              <td><img src="<?= base_url('fotokendaraan/' . $value['foto_kendaraan']) ?>" class="img-circle" width="80px" height="80px"></td>
              <td>
                <a href="<?= base_url('satpam_kelola_data/edit_kendaraan/' . $value['id_kendaraan']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_kendaraan'] ?>"><i class="fa fa-fw fa-trash"></i>Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal delete-->
<?php foreach ($data_kendaraan as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value['id_kendaraan'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete <?= $title ?></h4>
        </div>
        <div class="modal-body">
          <h4>
            <p>
              <center>Apakah Anda Ingin Menghapus Data&nbsp;<?= $value['nama_kendaraan'] ?> ?</center>
            </p>
          </h4>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('satpam_kelola_data/delete_kendaraan/' . $value['id_kendaraan']) ?>" class="btn btn-success pull-left btn-flat">&nbsp;Delete</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>