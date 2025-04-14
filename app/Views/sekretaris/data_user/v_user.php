<div class="box box-primary box-solid">
  <div class="box-header">
    <a href="<?= base_url('sekretaris_kelola_user/add') ?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
      Tambah Data</a>
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
            <th>Nama Pengguna</th>
            <th>Nama Lengkap</th>
            <th>Nama Title</th>
            <th>Foto Profil</th>
            <th>No Telpon User</th>
            <th>Jobdesk User</th>
            <th>Unit Kerja User</th>
            <th>Level</th>
            <th>Terakhir Login</th>
            <th scope="col" width="auto">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($data_user as $key => $value) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['username']; ?></td>
              <td><?= $value['nama_lengkap']; ?></td>
              <td><?= $value['nama_title']; ?></td>
              <td><img src="<?= base_url('fotouser/' . $value['foto_user']) ?>" class="img-circle" width="80px" height="80px"></td>
              <td><?= $value['notelpon']; ?></td>
              <td><?= $value['jobdesk']; ?></td>
              <td><?= $value['nama_unit']; ?></td>
              <td><?php if ($value['level'] == 1) {
                    echo 'Sekretaris';
                  } else if ($value['level'] == 2) {
                    echo 'Pegawai';
                  } else if ($value['level'] == 3) {
                    echo 'Satpam';
                  }
                  ?>
              </td>
              <td><?= $value['last_login']; ?></td>
              </td>
              <td><a href="<?= base_url('sekretaris_kelola_user/edit/' . $value['id_user']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_user'] ?>"><i class="fa fa-fw fa-trash"></i>Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal delete-->
<?php foreach ($data_user as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value['id_user'] ?>">
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
              <center>Apakah Anda Ingin Menghapus Data&nbsp;<?= $value['nama_lengkap'] ?> ?</center>
            </p>
          </h4>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('sekretaris_kelola_user/delete/' . $value['id_user']) ?>" class="btn btn-success pull-left btn-flat"> Delete</a>
          <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>