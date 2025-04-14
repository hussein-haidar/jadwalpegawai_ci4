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
                <?php echo form_open_multipart('pegawai_kelola_data/update_dinas/' . $data_dinas['id_dinas']); ?>
                <div class="form-group">
                    <label>Unit Kerja</label>
                    <input type="text" value="<?= esc($nama_unit) ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" value="<?= esc($nama_lengkap) ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <select id="nama_kegiatan" name="nama_kegiatan" class="form-control" required>
                        <option value="">--Pilih Kegiatan--</option>
                        <?php foreach ($nama_kegiatan as $kegiatan_value) { ?>
                            <option value="<?= esc($kegiatan_value) ?>" <?= $data_dinas['nama_kegiatan'] == $kegiatan_value ? 'selected' : '' ?>>
                                <?= esc($kegiatan_value) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="datetime-local" name="tanggal_mulai" value="<?= $data_dinas['tanggal_mulai'] ?>" class="form-control" placeholder="Masukkan Tanggal Mulai" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Berakhir</label>
                    <input type="datetime-local" name="tanggal_berakhir" value="<?= $data_dinas['tanggal_berakhir'] ?>" class="form-control" placeholder="Masukkan Tanggal Berakhir" required>
                </div>

                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <select id="nama_perusahaan" name="nama_perusahaan" class="form-control" required>
                        <option value="">--Pilih Perusahaan--</option>
                        <?php foreach ($nama_perusahaan as $nama_perusahaan_value) { ?>
                            <option value="<?= esc($nama_perusahaan_value) ?>" <?= $data_dinas['nama_perusahaan'] == $nama_perusahaan_value ? 'selected' : '' ?>>
                                <?= esc($nama_perusahaan_value) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat Kegiatan</label>
                    <select id="alamat_kegiatan" name="alamat_kegiatan" class="form-control" required>
                        <option value="">--Pilih Alamat Kegiatan--</option>
                        <?php foreach ($alamat_kegiatan as $alamat_value) { ?>
                            <option value="<?= esc($alamat_value) ?>" <?= $data_dinas['alamat_kegiatan'] == $alamat_value ? 'selected' : '' ?>>
                                <?= esc($alamat_value) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Kendaraan</label>
                    <select id="id_kendaraan" name="id_kendaraan" class="form-control" required>
                        <option value="">--Pilih Kendaraan--</option>
                        <?php foreach ($data_kendaraan as $key => $value) { ?>
                            <option value="<?= $value['id_kendaraan'] ?>"
                                data-plat="<?= esc($value['plat_kendaraan']) ?>"
                                <?= $data_dinas['id_kendaraan'] == $value['id_kendaraan'] ? 'selected' : '' ?>>
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
                            <option value="<?= $value['id_supir'] ?>" <?= $data_dinas['id_supir'] == $value['id_supir'] ? 'selected' : '' ?>><?= $value['nama_supir'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= base_url('pegawai_kelola_data/data_dinas') ?>" class="btn btn-primary">Kembali</a>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<script>
    // Fungsi untuk memperbarui field "Plat Kendaraan"
    function updatePlatKendaraan() {
        const kendaraanDropdown = document.getElementById('id_kendaraan');
        const selectedOption = kendaraanDropdown.options[kendaraanDropdown.selectedIndex];
        const platKendaraan = selectedOption.getAttribute('data-plat');
        document.getElementById('plat_kendaraan').value = platKendaraan || '';
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        updatePlatKendaraan();
    });

    // Perbarui saat dropdown berubah
    document.getElementById('id_kendaraan').addEventListener('change', updatePlatKendaraan);
</script>