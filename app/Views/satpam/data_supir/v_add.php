<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <!-- pop up alert -->
                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php echo form_open_multipart('satpam_kelola_data/save_supir'); ?>

                <div class="form-group">
                    <label>Nama Supir</label>
                    <input name="nama_supir" class="form-control" placeholder="Masukkan Nama Supir" required>
                </div>

                <div class="form-group">
                    <label>No Telpon Supir</label>
                    <input name="notelpon_supir" class="form-control" placeholder="Masukkan No Telpon Supir" required>
                </div>

                <div class="form-group">
                    <label>Alamat Supir</label>
                    <input type="text" name="alamat_supir" class="form-control" placeholder="Masukkan Alamat Supir" required>
                </div>

                <!-- Input Hidden untuk status_kegiatan -->
                <input type="hidden" name="stok_supir" value="1">

                <div class="form-group">
                    <label>Status Supir</label>
                    <select id="status_supir" name=" status_supir" class="form-control">
                        <option value="">--Pilih Status--</option>
                        <option value="1">Tidak</option>
                        <option value="2">Dinas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Foto Supir</label>
                    <input type="file" class="form-control" name="foto_supir" id="preview_gambar" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('satpam_kelola_data/data_supir') ?>" class="btn btn-primary">Kembali</a>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>