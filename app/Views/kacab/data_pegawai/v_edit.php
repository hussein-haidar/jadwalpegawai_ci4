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
                <?php echo form_open_multipart('sekretaris_kelola_jadwal/update/' . $data_jadwal['id_pegawai']); ?>

                <div class="form-group">
                    <label>Unit Kerja</label>
                    <select name="id_unit" class="form-control">
                        <option value="">--Pilih Unit--</option>
                        <?php foreach ($data_unit as $key => $value) { ?>
                            <option value="<?= $value['id_unit'] ?>" <?= $data_jadwal['id_unit'] == $value['id_unit'] ? 'selected' : '' ?>><?= $value['nama_unit'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input name="nama_pegawai" value="<?= $data_jadwal['nama_pegawai'] ?>" class="form-control" placeholder="Masukkan Nama Pegawai" required>
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
                    <label>Tanggal Mulai</label>
                    <input name="tanggal_mulai" value="<?= $data_jadwal['tanggal_mulai'] ?>" class="form-control" placeholder="Masukkan Tanggal Mulai" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Berakhir</label>
                    <input name="tanggal_berakhir" value="<?= $data_jadwal['tanggal_berakhir'] ?>" class="form-control" placeholder="Masukkan Tanggal Berakhir" required>
                </div>

                <div class="form-group">
                    <label>Alamat Kegiatan</label>
                    <input type="text" name="alamat_kegiatan" value="<?= $data_jadwal['alamat_kegiatan'] ?>" class="form-control" placeholder="Masukkan Alamat Kegiatan" required>
                </div>

                <div class="form-group">
                    <label>Status Kegiatan</label>
                    <select name="status_kegiatan" class="form-control">
                        <option value="<?= $data_jadwal['status_kegiatan'] ?>"><?php if ($data_jadwal['status_kegiatan'] == 1) {
                                                                                            echo 'Proses';
                                                                                        } else {
                                                                                            echo 'Selesai';
                                                                                        }
                                                                                        ?></option>
                        <option value="1">Proses</option>
                        <option value="2">Selesai</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Kegiatan Terkini</label>
                    <p></p>
                    <img src="<?= base_url('fotokegiatan/' . $data_jadwal['foto_kegiatan']) ?>" id="gambar_load" width="100px">
                </div>

                <div class="form-group">
                    <label>Pilih Foto Kegiatan Baru</label>
                    <p></p>
                    <input type="file" class="form-control" name="foto_kegiatan" id="preview_gambar">
                </div>

                <div class="form-group">
                    <label>Pilih Dokumen Kegiatan Baru</label>
                    <p></p>
                    <input type="file" class="form-control" name="dokumen_kegaitan">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('sekretaris_kelola_jadwal') ?>" class="btn btn-primary">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>