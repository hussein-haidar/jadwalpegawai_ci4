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
                <?php echo form_open_multipart('pegawai_kelola_data/update_jadwal/' . $data_jadwal['id_pegawai']); ?>
                <div class="form-group">
                    <label>Unit Kerja</label>
                    <input type="text" value="<?= esc($nama_unit) ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Pelaksana</label>
                    <input type="text" value="<?= esc($nama_lengkap) ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input name="nama_perusahaan" value="<?= $data_jadwal['nama_perusahaan'] ?>" class="form-control" placeholder="Masukkan Nama Perusahaan" required>
                </div>

                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <input name="nama_kegiatan" value="<?= $data_jadwal['nama_kegiatan'] ?>" class="form-control" placeholder="Masukkan Nama Kegiatan" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Mulai Kegiatan</label>
                    <input type="datetime-local" name="tanggal_mulai" value="<?= $data_jadwal['tanggal_mulai'] ?>" class="form-control" placeholder="Masukkan Tanggal Mulai" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Berakhir Kegiatan</label>
                    <input type="datetime-local" name="tanggal_berakhir" value="<?= $data_jadwal['tanggal_berakhir'] ?>" class="form-control" placeholder="Masukkan Tanggal Berakhir" required>
                </div>

                <div class="form-group">
                    <label>Alamat Kegiatan</label>
                    <input type="text" name="alamat_kegiatan" value="<?= $data_jadwal['alamat_kegiatan'] ?>" class="form-control" placeholder="Masukkan Alamat Kegiatan" required>
                </div>

                <!-- Input Hidden untuk status_kegiatan -->
                <input type="hidden" name="status_kegiatan" value="1">

                <div class="form-group">
                    <label>Foto Kegiatan Terkini</label>
                    <p></p>
                    <img src="<?= base_url('fotokegiatan/' . $data_jadwal['foto_kegiatan']) ?>" id="gambar_load" width="100px">
                </div>

                <div class="form-group">
                    <label for="foto_kegiatan">Upload Foto Kegiatan (Opsional)</label>
                    <input type="file" name="foto_kegiatan" id="preview_gambar" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <div class="form-group">
                    <label for="dokumen_kegiatan">Upload Dokumen Kegiatan (Opsional)</label>
                    <input type="file" name="dokumen_kegiatan" id="preview_gambar" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti dokumen.</small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('pegawai_kelola_data/data_jadwal') ?>" class="btn btn-primary">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>