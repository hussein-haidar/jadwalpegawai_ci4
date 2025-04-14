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
                  <div class="btn btn-xs btn-warning">Proses</div>
                <?php } elseif ($value['status_kegiatan'] == 2) { ?>
                  <div class="btn btn-xs btn-success">Selesai</div>
                <?php } elseif ($value['status_kegiatan'] == 3) { ?>
                  <div class="btn btn-xs btn-danger">Tolak</div>
                <?php } else { ?>
                  <div class="btn btn-xs btn-default">Tidak Diketahui</div>
                <?php } ?>
              </td>
              <td><img src="<?= base_url('fotokegiatan/' . $value['foto_kegiatan']) ?>" class="img-circle" width="80px" height="80px"><a href="<?= base_url('sekretaris_kelola_jadwal/view_foto/' . $value['id_pegawai']) ?>"> Lihat Foto</a></td>
              <td style="text-align: center; vertical-align: center;"><a href="<?= base_url('sekretaris_kelola_jadwal/view_dokumen/' . $value['id_pegawai']) ?>" <i class="fa fa-file-pdf-o fa-4x label-danger" aria-hidden="true"></i></a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>