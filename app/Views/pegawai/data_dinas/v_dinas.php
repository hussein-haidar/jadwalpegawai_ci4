<div class="box box-primary box-solid">
  <div class="box-header">
    <a href="<?= base_url('pegawai_kelola_data/add_dinas') ?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
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
            <th>Nama Pegawai</th>
            <th>Nama Unit</th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Mulai Dinas</th>
            <th>Tanggal Berakhir Dinas</th>
            <th>Perusahaan</th>
            <th>Alamat Kegiatan</th>
            <th>Kendaraan</th>
            <th>Plat Kendaraan</th>
            <th>Sopir</th>
            <th scope="col" width="auto">Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php $no = 1;
          foreach ($data_dinas as $key => $value) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $value['nama_lengkap']; ?></td>
              <td><?= $value['nama_unit']; ?></td>
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
              <td><?= $value['nama_perusahaan']; ?></td>
              <td><?= $value['alamat_kegiatan']; ?></td>
              <td><?= $value['nama_kendaraan']; ?></td>
              <td><?= $value['plat_kendaraan']; ?></td>
              <td><?= $value['nama_supir']; ?></td>
              <td>
                <a href="<?= base_url('pegawai_kelola_data/edit_dinas/' . $value['id_dinas']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                <button class="btn btn-success btn-sm btn-xs" data-toggle="modal" data-target="#return<?= $value['id_dinas'] ?>"><i class="fa fa-fw fa-undo"></i>Kembalikan Stok</button>
                <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_dinas'] ?>"><i class="fa fa-fw fa-trash"></i>Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal return-->
<?php foreach ($data_dinas as $key => $value) { ?>
  <div class="modal fade" id="return<?= $value['id_dinas'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Kembalikan Stok <?= $title ?></h4>
        </div>
        <div class="modal-body">
          <h4>
            <p>
              <center>Apakah Anda Ingin Mengembalikan Stok Untuk Data&nbsp;<?= $value['nama_lengkap'] ?> ?</center>
            </p>
          </h4>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('pegawai_kelola_data/return_stok/' . $value['id_dinas']) ?>" class="btn btn-success pull-left btn-flat">&nbsp;Kembalikan</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>

<!-- Modal delete-->
<?php foreach ($data_dinas as $key => $value) { ?>
  <div class="modal fade" id="delete<?= $value['id_dinas'] ?>">
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
          <a href="<?= base_url('pegawai_kelola_data/delete_dinas/' . $value['id_dinas']) ?>" class="btn btn-success pull-left btn-flat">&nbsp;Delete</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>