<div class="box box-primary box-solid">
    <div class="box-header">
        <a href="<?= base_url('sekretaris_kelola_unit') ?>" class="btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali ke Daftar Unit</a>
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
                        <th>Unit Kerja</th>
                        <th scope="col" width="auto">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1;
                    foreach ($data_unit_dihapus as $key => $value) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['nama_unit']; ?></td>
                            <td>
                                <a href="<?= base_url('sekretaris_kelola_unit/restore/' . $value['id_unit']) ?>" class="btn btn-success btn-sm">
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