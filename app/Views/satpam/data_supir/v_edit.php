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

                <!-- Form to update cabang -->
                <?php echo form_open_multipart('satpam_kelola_data/update_supir/' . $data_supir['id_supir']); ?>

                <div class="form-group">
                    <label>Nama Supir</label>
                    <input name="nama_supir" class="form-control" value="<?= $data_supir['nama_supir'] ?>" placeholder="Masukkan Nama Supir" required>
                </div>

                <div class="form-group">
                    <label>No Telpon Supir</label>
                    <input name="notelpon_supir" class="form-control" value="<?= $data_supir['notelpon_supir'] ?>" placeholder="Masukkan No Telpon Supir" required>
                </div>

                <div class="form-group">
                    <label>Alamat Supir</label>
                    <input type="text" name="alamat_supir" class="form-control" value="<?= $data_supir['alamat_supir'] ?>" placeholder="Masukkan Alamat Supir" required>
                </div>

                <!-- Input Hidden untuk status_kegiatan -->
                <input type="hidden" name="stok_supir" value="1">

                <div class="form-group">
                    <label>Status Supir</label>
                    <select id="status_supir" name=" status_supir" class="form-control">
                        <option value="<?= $data_supir['status_supir'] ?>"> <?php if ($data_supir['status_supir'] == 1) {
                                                                                    echo 'Tidak';
                                                                                } else if ($data_supir['status_supir'] == 2) {
                                                                                    echo 'Dinas';
                                                                                }
                                                                                ?></option>
                        <option value="1">Tidak</option>
                        <option value="2">Dinas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Supir Terkini</label>
                    <p></p>
                    <img src="<?= base_url('fotosupir/' . $data_supir['foto_supir']) ?>" id="gambar_load" width="100px">
                </div>

                <div class="form-group">
                    <label>Upload Foto Supir Baru</label>
                    <p></p>
                    <input type="file" class="form-control" name="foto_supir" id="preview_gambar">
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('satpam_kelola_data/data_supir') ?>" class="btn btn-primary">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>