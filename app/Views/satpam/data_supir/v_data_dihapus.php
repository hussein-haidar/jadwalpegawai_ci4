<div class="box box-primary box-solid">
    <div class="box-header">
        <a href="<?= base_url('satpam_kelola_data/data_supir') ?>" class="btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Daftar Supir</a>
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
                        <th>Nama Supir</th>
                        <th>No Telpon Supir</th>
                        <th>Alamat Supir</th>
                        <th>Foto Supir</th>
                        <th scope="col" width="auto">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1;
                    foreach ($data_supir_dihapus as $key => $value) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['nama_supir']; ?></td>
                            <td><?= $value['notelpon_supir']; ?></td>
                            <td><?= $value['alamat_supir']; ?></td>
                            <td><img src="<?= base_url('fotosupir/' . $value['foto_supir']) ?>" class="img-circle" width="80px" height="80px"></td>
                            <td>
                                <a href="<?= base_url('satpam_kelola_data/restore_supir/' . $value['id_supir']) ?>" class="btn btn-success btn-sm">
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