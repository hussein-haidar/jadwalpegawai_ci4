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

                <?php echo form_open_multipart('satpam_kelola_data/save_kendaraan'); ?>

                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input name="nama_kendaraan" class="form-control" placeholder="Masukkan Nama Kendaraan" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <select id="jenis_kendaraan" name=" jenis_kendaraan" class="form-control">
                        <option value="">--Pilih Jenis--</option>
                        <option value="1">Roda 2</option>
                        <option value="2">Roda 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Plat Nomer</label>
                    <input name=" plat_kendaraan" class="form-control" placeholder="Masukkan Plat Nomer" required>
                </div>

                <div class="form-group">
                    <label>Stok Kendaraan</label>
                    <input name=" stok_kendaraan" class="form-control" placeholder="Masukkan Stok Kendaraan" required>
                </div>

                <div class="form-group">
                    <label>Status Kendaraan</label>
                    <select id="status_kendaraan" name=" status_kendaraan" class="form-control">
                        <option value="">--Pilih Status--</option>
                        <option value="1">Tidak</option>
                        <option value="2">Dinas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pilih Foto Kendaraan</label>
                    <input type="file" class="form-control" name="foto_kendaraan" id="preview_gambar" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('satpam_kelola_data/data_kendaraan') ?>" class="btn btn-primary">Kembali</a>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>