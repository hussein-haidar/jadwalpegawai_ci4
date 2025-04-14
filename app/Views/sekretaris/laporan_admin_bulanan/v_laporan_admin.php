<div class="box box-primary box-solid">
    <div class="box-header">
    </div>
    <div class="box-body">
        <form action="<?= base_url('pegawai_laporan_bulanan/filter_by_month') ?>" method="post">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="start_month">Dari Bulan:</label>
                        <input type="month" name="start_month" class="form-control" value="<?= $start_month ?>" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="end_month">Sampai Bulan:</label>
                        <input type="month" name="end_month" class="form-control" value="<?= $end_month ?>" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control">Filter</button>
                    </div>
                </div>
            </div>

            <?php if ($start_month && $end_month) : ?>
                <a href="<?= base_url('pegawai_laporan_bulanan/cetak_laporan?start_month=' . $start_month . '&end_month=' . $end_month) ?>" class="btn btn-sm btn-success mt-3" target="_blank">
                    <i class="fa fa-print" aria-hidden="true"></i> Cetak Data
                </a>
                <a href="<?= base_url('pegawai_laporan_bulanan/reset_filter') ?>" class="btn btn-sm btn-secondary mt-3">
                    <i class="fa fa-refresh" aria-hidden="true"></i> Reset Filter
                </a>
            <?php endif; ?>

        </form>
        <p></p>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
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
                    foreach ($data_laporan_pegawai as $key => $value) {
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
                            <td><img src="<?= base_url('fotokegiatan/' . $value['foto_kegiatan']) ?>" class="img-circle" width="80px" height="80px"></td>
                            <td style="text-align: center; vertical-align: center;">
                                <i class="fa fa-file-pdf-o fa-4x label-danger" aria-hidden="true"></i>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>