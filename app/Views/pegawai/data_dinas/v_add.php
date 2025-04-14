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
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open_multipart('pegawai_kelola_data/save_dinas'); ?>

                <div class="form-group">
                    <label>Unit Kerja</label>
                    <input type="text" value="<?= esc($nama_unit) ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" value="<?= esc($nama_lengkap) ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Kegiatan Pegawai</label>
                    <select class="form-control" name="nama_kegiatan" required>
                        <option value="">Pilih Kegiatan</option>
                        <?php foreach ($nama_kegiatan as $kegiatan): ?>
                            <option value="<?= esc($kegiatan) ?>"><?= esc($kegiatan) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Mulai Dinas</label>
                    <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Berakhir Dinas</label>
                    <input type="datetime-local" name="tanggal_berakhir" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <select class="form-control" name="nama_perusahaan" required>
                        <option value="">Pilih Perusahaan</option>
                        <?php foreach ($nama_perusahaan as $perusahaan): ?>
                            <option value="<?= esc($perusahaan) ?>"><?= esc($perusahaan) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat Kegiatan</label>
                    <select class="form-control" name="alamat_kegiatan" required>
                        <option value="">Pilih Alamat</option>
                        <?php foreach ($alamat_kegiatan as $alamat): ?>
                            <option value="<?= esc($alamat) ?>"><?= esc($alamat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <select id="id_kendaraan" name="id_kendaraan" class="form-control" required>
                        <option value="">--Pilih Kendaraan--</option>
                        <?php foreach ($data_kendaraan as $key => $value) { ?>
                            <option value="<?= $value['id_kendaraan'] ?>" data-plat="<?= esc($value['plat_kendaraan']) ?>">
                                <?= esc($value['nama_kendaraan']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Plat Kendaraan</label>
                    <input type="text" id="plat_kendaraan" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Supir</label>
                    <select id="id_supir" name="id_supir" class="form-control" required>
                        <option value="">--Pilih Supir--</option>
                        <?php foreach ($data_supir as $key => $value) { ?>
                            <option value="<?= $value['id_supir'] ?>">
                                <?= esc($value['nama_supir']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('pegawai_kelola_data/data_dinas') ?>" class="btn btn-primary">Kembali</a>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
    </div>
</div>

<script>
    document.getElementById('id_kendaraan').addEventListener('change', function() {
        // Ambil opsi yang dipilih
        const selectedOption = this.options[this.selectedIndex];
        // Ambil data-plat dari opsi yang dipilih
        const platKendaraan = selectedOption.getAttribute('data-plat');
        // Tampilkan data plat di input field
        document.getElementById('plat_kendaraan').value = platKendaraan || '';
    });
</script>