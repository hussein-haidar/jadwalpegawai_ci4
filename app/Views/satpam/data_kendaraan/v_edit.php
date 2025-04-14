<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border"></div>

            <div class="box-body">
                <!-- Display errors -->
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

                <!-- Form to update -->
                <?php echo form_open_multipart('satpam_kelola_data/update_kendaraan/' . $data_kendaraan['id_kendaraan']); ?>

                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <input name="nama_kendaraan" class="form-control" value="<?= $data_kendaraan['nama_kendaraan'] ?>" placeholder="Masukkan Nama Supir" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kendaraan</label>
                    <select id="jenis_kendaraan" name=" jenis_kendaraan" class="form-control">
                        <option value="<?= $data_kendaraan['jenis_kendaraan'] ?>"> <?php if ($data_kendaraan['jenis_kendaraan'] == 1) {
                                                                                        echo 'Roda 2';
                                                                                    } else if ($data_kendaraan['jenis_kendaraan'] == 2) {
                                                                                        echo 'Roda 4';
                                                                                    }
                                                                                    ?></option>
                        <option value="1">Roda 2</option>
                        <option value="2">Roda 4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Plat Kendaraan</label>
                    <input name="plat_kendaraan" class="form-control" value="<?= $data_kendaraan['plat_kendaraan'] ?>" placeholder="Masukkan Alamat Supir" required>
                </div>

                <div class="form-group">
                    <label>Stok Kendaraan</label>
                    <input name="stok_kendaraan" class="form-control" value="<?= $data_kendaraan['stok_kendaraan'] ?>" placeholder="Masukkan Alamat Supir" required>
                </div>

                <div class="form-group">
                    <label>Status Kendaraan</label>
                    <select id="status_kendaraan" name=" status_kendaraan" class="form-control">
                        <option value="<?= $data_kendaraan['status_kendaraan'] ?>"> <?php if ($data_kendaraan['status_kendaraan'] == 1) {
                                                                                        echo 'Tidak';
                                                                                    } else if ($data_kendaraan['status_kendaraan'] == 2) {
                                                                                        echo 'Dinas';
                                                                                    }
                                                                                    ?></option>
                        <option value="1">Tidak</option>
                        <option value="2">Dinas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Kendaraan Terkini</label>
                    <p></p>
                    <img src="<?= base_url('fotokendaraan/' . $data_kendaraan['foto_kendaraan']) ?>" id="gambar_load" width="100px">
                </div>

                <div class="form-group">
                    <label for="foto_kendaraan">Upload Foto Kendaraan (Opsional)</label>
                    <input type="file" name="foto_kendaraan" id="preview_gambar" class=" form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('satpam_kelola_data/data_kendaraan') ?>" class="btn btn-primary">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>