<div class="box box-primary box-solid">
  <div class="box-header">
    <a href="<?= base_url('pegawai_kelola_data/add_jadwal') ?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
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
            <th>Nama Pelaksana</th>
            <th>Nama Unit</th>
            <th>Nama Perusahaan</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Mulai Kegiatan</th>
            <th>Tanggal Berakhir Kegiatan</th>
            <th>Alamat Kegiatan</th>
            <th>Status Kegiatan</th>
            <th>Foto Kegiatan</th>
            <th>Dokumen Kegiatan</th>
            <th scope="col" width="auto">Aksi</th>
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
              <?php
              $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
              ];
              ?>
              <td>
                <?php
                $tanggalMulai = strtotime($value['tanggal_mulai']);
                $formattedTanggalMulai = date('d', $tanggalMulai) . ' ' . $bulan[date('n', $tanggalMulai)] . ' ' . date('Y H:i:s', $tanggalMulai);
                ?>
                <?= $formattedTanggalMulai ?>
              </td>
              <td>
                <?php
                $tanggalBerakhir = strtotime($value['tanggal_berakhir']);
                $formattedTanggalBerakhir = date('d', $tanggalBerakhir) . ' ' . $bulan[date('n', $tanggalBerakhir)] . ' ' . date('Y H:i:s', $tanggalBerakhir);
                ?>
                <?= $formattedTanggalBerakhir ?>
              </td>
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
              <td><img src="<?= base_url('fotokegiatan/' . $value['foto_kegiatan']) ?>" class="img-circle" width="80px" height="80px"><a href="<?= base_url('pegawai_kelola_data/view_foto/' . $value['id_pegawai']) ?>"> Lihat Foto</a></td>
              <td style="text-align: center; vertical-align: center;">
                <a href="<?= base_url('pegawai_kelola_data/view_dokumen/' . $value['id_pegawai']) ?>">
                  <i class="fa fa-file-pdf-o fa-4x label-danger" aria-hidden="true"></i>
                </a>
              </td>
              <td>
                <a href="<?= base_url('pegawai_kelola_data/edit_jadwal/' . $value['id_pegawai']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_pegawai'] ?>"><i class="fa fa-fw fa-trash"></i>Delete</button>
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
              <center>Apakah Anda Ingin Menghapus Data&nbsp;<?= $value['nama_lengkap'] ?> ?</center>
            </p>
          </h4>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('pegawai_kelola_data/delete_jadwal/' . $value['id_pegawai']) ?>" class="btn btn-success pull-left btn-flat">&nbsp;Delete</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>