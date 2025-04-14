<div class="box box-primary box-solid">
    <div class="box-header">
        <a href="<?= base_url('satpam_kelola_data/data_kendaraan') ?>" class="btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Daftar Kendaraan</a>
    </div>

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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="1%">No</th>
                        <th>Nama Kendaraan</th>
                        <th>Jenis Kendaraan</th>
                        <th>Plat Kendaraan</th>
                        <th>Stok Kendaraan</th>
                        <th>Foto Kendaraan</th>
                        <th scope="col" width="auto">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1;
                    foreach ($data_kendaraan_dihapus as $key => $value) {
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
                                <td><img src="<?= base_url('fotokendaraan/' . $value['foto_kendaraan']) ?>" class="img-circle" width="80px" height="80px"></td>
                                <td>
                                    <a href="<?= base_url('satpam_kelola_data/restore_kendaraan/' . $value['id_kendaraan']) ?>" class="btn btn-success btn-sm">
                                        <i class="fa fa-fw fa-undo"></i>Restore
                                    </a>
                                </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>