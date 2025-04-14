<div class="box box-primary box-solid">
  <div class="box-header">
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <!-- /.alert windows success -->

    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped ">
        <thead>
          <tr>
            <th scope="col" width="1%">No</th>
            <th>Nama Pegawai</th>
            <th>Nama Unit</th>
            <th>Nama Perusahaan</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Berakhir</th>
            <th>Alamat Kegiatan</th>
            <th>Status Kegiatan</th>
            <th>Foto Kegiatan</th>
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
                  <span class="label label-warning">Proses</span>
                <?php } elseif ($value['status_kegiatan'] == 2) { ?>
                  <span class="label label-success">Selesai</span>
                <?php } elseif ($value['status_kegiatan'] == 3) { ?>
                  <span class="label label-danger">Tolak</span>
                <?php } else { ?>
                  <span class="label label-default">Tidak Diketahui</span>
                <?php } ?>
              </td>
              <td><img src="<?= base_url('fotokegiatan/' . $value['foto_kegiatan']) ?>" class="img-circle" width="80px" height="80px"><a href="<?= base_url('pegawai_kelola_jadwal/view_foto/' . $value['id_pegawai']) ?>"> Lihat Foto</a></td>
              <td style="text-align: center; vertical-align: center;">
                <a href="<?= base_url('pegawai_kelola_jadwal/view_dokumen/' . $value['id_pegawai']) ?>">
                  <i class="fa fa-file-pdf-o fa-4x label-danger" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal delete-->
<?php foreach ($data_jadwal as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value['id_pegawai'] ?>">
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
              <center>Apakah Anda Ingin Menghapus Data&nbsp;<?= $value['nama_pegawai'] ?> ?</center>
            </p>
          </h4>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('pegawai_kelola_jadwal/delete/' . $value['id_pegawai']) ?>" class="btn btn-success pull-left btn-flat">&nbsp;Delete</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>