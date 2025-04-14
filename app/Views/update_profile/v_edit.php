<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
            </div>

            <!-- /.box-header -->
            <div class="box-body">
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

                <?= form_open_multipart(base_url('update_profile/update_profile/' . $data_profil['id_user'])) ?>

                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input name="username" value="<?= session()->get('username') ?>" class="form-control" placeholder="Masukkan Nama Pengguna" readonly>
                </div>

                <div class="form-group">
                    <label>Kata Sandi</label>
                    <input name="password" type="text" value="<?= session()->get('password') ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama_lengkap" value="<?= session()->get('nama_lengkap') ?>" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div class="form-group">
                    <label>No Telepon User</label>
                    <input type="number" name="notelpon_user" value="<?= session()->get('notelpon') ?>" class="form-control" placeholder="Masukkan No Telepon User" required>
                </div>

                <div class="form-group">
                    <label>Jobdesk User</label>
                    <input type="text" name="jobdesk_user" value="<?= session()->get('jobdesk') ?>" class="form-control" placeholder="" required>
                </div>

                <div class="form-group">
                    <label>Foto Profil Terkini</label>
                    <p></p>
                    <img src="<?= base_url('fotouser/' . session()->get('foto_user')) ?>" class="img-circle" id="gambar_load" width="100px" height="100px">
                </div>

                <div class="form-group">
                    <label>Upload Foto Profil Baru</label>
                    <p></p>
                    <input type="file" class="form-control" name="foto_user" id="preview_gambar">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('update_profile') ?>" class="btn btn-primary">Kembali</a>
                </div>

                <?= form_close() ?>

            </div>
        </div>

    </div>
    <div class="col-md-3">
    </div>
</div>