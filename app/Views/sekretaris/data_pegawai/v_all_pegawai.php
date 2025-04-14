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

    <!-- Dropdown untuk memilih cabang -->
    <form method="get" action="<?= site_url('sekretaris_acc_jadwal/view_jadwal') ?>">
      <div class="form-group">
        <label for="id_unit">Pilih Unit:</label>
        <select name="id_unit" id="id_unit" class="form-control" onchange="this.form.submit()">
          <option value="">-- Pilih Unit --</option>
          <?php if (isset($data_unit) && !empty($data_unit)): ?>
            <?php foreach ($data_unit as $unit): ?>
              <option value="<?= $unit['id_unit']; ?>" <?= ($selected_unit == $unit['id_unit']) ? 'selected' : ''; ?>>
                <?= $unit['nama_unit']; ?>
              </option>
            <?php endforeach; ?>
          <?php else: ?>
            <option value="">Data unit tidak tersedia</option>
          <?php endif; ?>

        </select>
      </div>
    </form>

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
              <td><img src="<?= base_url('fotokegiatan/' . $value['foto_kegiatan']) ?>" class="img-circle" width="80px" height="80px"><a href="<?= base_url('pegawai_kelola_jadwal/view_foto/' . $value['id_pegawai']) ?>"> Lihat Foto</a></td>
              <td style="text-align: center; vertical-align: center;">
                <a href="<?= base_url('pegawai_kelola_jadwal/view_dokumen/' . $value['id_pegawai']) ?>">
                  <i class="fa fa-file-pdf-o fa-4x label-danger" aria-hidden="true"></i>
                </a>
              </td>
              <td>
                <a href="<?= base_url('sekretaris_acc_jadwal/edit/' . $value['id_pegawai']) ?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>