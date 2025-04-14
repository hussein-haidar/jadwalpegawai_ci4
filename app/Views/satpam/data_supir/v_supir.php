<div class="box box-primary box-solid">
  <div class="box-header">
    <a href="<?= base_url('satpam_kelola_data/add_supir') ?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
      Tambah Data</a>
    <a href="<?= base_url('satpam_kelola_data/data_supir_dihapus') ?>" class="btn btn-sm btn-primary">Lihat Data Dihapus</a>
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
            <th>Nama Supir</th>
            <th>No Telpon Supir</th>
            <th>Alamat Supir</th>
            <th>Stok Supir</th>
            <th>Status Supir</th>
            <th>Foto Supir</th>
            <th scope="col" width="auto">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($data_supir as $key => $value) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_supir']; ?></td>
              <td><?= $value['notelpon_supir']; ?></td>
              <td><?= $value['alamat_supir']; ?></td>
              <td><?= $value['stok_supir']; ?></td>
              <td>
                <?php if ($value['status_supir'] == 1) { ?>
                  <span class="label label-warning">Tidak</span>
                <?php } elseif ($value['status_supir'] == 2) { ?>
                  <span class="label label-success">Dinas</span>
                <?php } else { ?>
                  <span class="label label-default">Tidak Diketahui</span>
                <?php } ?>
              </td>
              <td><img src="<?= base_url('fotosupir/' . $value['foto_supir']) ?>" class="img-circle" width="80px" height="80px"></td>
              <td>
                <a href="<?= base_url('satpam_kelola_data/edit_supir/' . $value['id_supir']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_supir'] ?>"><i class="fa fa-fw fa-trash"></i>Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal delete-->
<?php foreach ($data_supir as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value['id_supir'] ?>">
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
              <center>Apakah Anda Ingin Menghapus Data&nbsp;<?= $value['nama_supir'] ?> ?</center>
            </p>
          </h4>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('satpam_kelola_data/delete_supir/' . $value['id_supir']) ?>" class="btn btn-success pull-left btn-flat">&nbsp;Delete</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>