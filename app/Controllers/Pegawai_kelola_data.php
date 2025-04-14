<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_pegawai_jadwal;
use App\Models\M_pegawai_dinas;

class Pegawai_kelola_data extends BaseController
{
    protected $M_pegawai_jadwal;
    protected $M_pegawai_dinas;

    public function __construct()
    {
        $this->M_pegawai_jadwal = new M_pegawai_jadwal();
        $this->M_pegawai_dinas = new M_pegawai_dinas();
    }

    public function data_jadwal()
    {
        $data = [
            'title' => 'Daftar Jadwal Pegawai',
            'title2' => 'Data Jadwal',
            'data_jadwal' => $this->M_pegawai_jadwal->get_jadwal(),
            'isi' => 'pegawai/data_pegawai/v_pegawai',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_dokumen($id_pegawai)
    {
        $data = [
            'title' => 'View Dokumen Pegawai',
            'title2' => 'Data Dokumen',
            'data_jadwal' => $this->M_pegawai_jadwal->detailJadwal($id_pegawai),
            'isi' => 'pegawai/data_pegawai/v_dokumen',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_foto($id_pegawai)
    {
        $data = [
            'title' => 'View Foto Pegawai',
            'title2' => 'Data Foto',
            'data_jadwal' => $this->M_pegawai_jadwal->detailJadwal($id_pegawai),
            'isi' => 'pegawai/data_pegawai/v_foto',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_jadwal()
    {
        $id_user = session()->get('id_user'); // Ambil id_user dari session

        // Cari nama berdasarkan id_user
        $nama = $this->M_pegawai_jadwal->get_user_by_id($id_user);

        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session

        // Cari nama unit berdasarkan id_unit
        $unit = $this->M_pegawai_jadwal->get_unit_by_id($id_unit);

        $data = [
            'title' => 'Tambah Jadwal',
            'title2' => ' Data Jadwal',
            'data_jadwal' => $this->M_pegawai_jadwal->get_jadwal(),
            'nama_lengkap' => $nama ? $nama['nama_lengkap'] : 'Nama Lengkap Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'nama_unit' => $unit ? $unit['nama_unit'] : 'Unit Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'isi' => 'pegawai/data_pegawai/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save_jadwal()
    {
        if ($this->validate([
            'nama_perusahaan' => [
                'label' => 'Nama Perusahaan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'nama_kegiatan' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'tanggal_mulai' => [
                'label' => 'Tanggal Mulai',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'tanggal_berakhir' => [
                'label' => 'Tanggal Berakhir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'alamat_kegiatan' => [
                'label' => 'Alamat kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'foto_kegiatan' => [
                'label' => 'Foto Kegiatan',
                'rules' => 'uploaded[foto_kegiatan]|max_size[foto_kegiatan,1024]|mime_in[foto_kegiatan,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG !!!',
                ]
            ],
            'dokumen_kegiatan' => [
                'label' => 'Dokumen Kegiatan',
                'rules' => 'uploaded[dokumen_kegiatan]|max_size[dokumen_kegiatan,61440]|mime_in[dokumen_kegiatan,application/pdf]',
                'errors' => [
                    'max_size' => '{field} Max 61440 KB !!!',
                    'mime_in' => 'Format {field} Wajib PDF !!!',
                ]
            ],
        ])) {
            $foto = $this->request->getFile('foto_kegiatan');
            $nama_foto = $foto->getRandomName();

            $dokumen = $this->request->getFile('dokumen_kegiatan');
            $nama_dokumen = $dokumen->getRandomName();

            // Ambil id_unit dari session
            $id_user = session()->get('id_user');
            // Ambil id_unit dari session
            $id_unit = session()->get('id_unit');

            $data = [
                'id_user' => $id_user, // Gunakan id_unit dari session
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir'),
                'alamat_kegiatan' => $this->request->getPost('alamat_kegiatan'),
                'status_kegiatan' => $this->request->getPost('status_kegiatan'),
                'id_unit' => $id_unit, // Gunakan id_unit dari session
                'foto_kegiatan' => $nama_foto,
                'dokumen_kegiatan' => $nama_dokumen,
            ];

            $foto->move('fotokegiatan', $nama_foto);
            $dokumen->move('dokumenkegiatan', $nama_dokumen);

            $this->M_pegawai_jadwal->add($data);

            session()->setFlashdata('pesan', 'Data Jadwal Berhasil Ditambahkan!');
            return redirect()->to(base_url('pegawai_kelola_data/data_jadwal'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pegawai_kelola_data/add_jadwal'));
        }
    }

    public function edit_jadwal($id_pegawai)
    {
        $id_user = session()->get('id_user'); // Ambil id_user dari session

        // Cari nama berdasarkan id_user
        $nama = $this->M_pegawai_jadwal->get_user_by_id($id_user);

        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session

        // Cari nama unit berdasarkan id_unit
        $unit = $this->M_pegawai_jadwal->get_unit_by_id($id_unit);

        $data = [
            'title' => 'Edit Data Jadwal Pegawai',
            'title2' => 'Edit Data Jadwal',
            'data_jadwal' => $this->M_pegawai_jadwal->detailJadwal($id_pegawai),
            'nama_lengkap' => $nama ? $nama['nama_lengkap'] : 'Nama Lengkap Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'nama_unit' => $unit ? $unit['nama_unit'] : 'Unit Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'isi' => 'pegawai/data_pegawai/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update_jadwal($id_pegawai)
    {
        // Validasi input
        if ($this->validate([
            'nama_perusahaan' => [
                'label' => 'Nama Perusahaan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'nama_kegiatan' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'tanggal_mulai' => [
                'label' => 'Tanggal Mulai',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'tanggal_berakhir' => [
                'label' => 'Tanggal Berakhir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'alamat_kegiatan' => [
                'label' => 'Alamat Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi!']
            ],
            'foto_kegiatan' => [
                'label' => 'Foto Kegiatan',
                'rules' => 'if_exist|max_size[foto_kegiatan,1024]|mime_in[foto_kegiatan,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG !!!',
                ]
            ],
            'dokumen_kegiatan' => [
                'label' => 'Dokumen Kegiatan',
                'rules' => 'if_exist|max_size[dokumen_kegiatan,6144]|mime_in[dokumen_kegiatan,application/pdf]',
                'errors' => [
                    'max_size' => '{field} Max 6 MB !!!',
                    'mime_in' => 'Format {field} Wajib PDF !!!',
                ]
            ],
        ])) {
            // Mengambil file dari form input
            $foto = $this->request->getFile('foto_kegiatan');
            $dokumen = $this->request->getFile('dokumen_kegiatan');

            // Ambil data lama
            $data_jadwal = $this->M_pegawai_jadwal->detailJadwal($id_pegawai);

            // Data untuk update
            $data = [
                'id_pegawai' => $id_pegawai,
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir'),
                'alamat_kegiatan' => $this->request->getPost('alamat_kegiatan'),
            ];

            // Proses file foto_kegiatan
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                if (!empty($data_jadwal['foto_kegiatan'])) {
                    unlink('fotokegiatan/' . $data_jadwal['foto_kegiatan']);
                }
                $nama_foto = $foto->getRandomName();
                $foto->move('fotokegiatan', $nama_foto);
                $data['foto_kegiatan'] = $nama_foto;
            }

            // Proses file dokumen_kegiatan
            if ($dokumen && $dokumen->isValid() && !$dokumen->hasMoved()) {
                // Pastikan format file PDF
                if ($dokumen->getMimeType() !== 'application/pdf') {
                    session()->setFlashdata('errors', ['dokumen_kegiatan' => 'Format file wajib PDF!']);
                    return redirect()->to(base_url('pegawai_kelola_data/edit_jadwal/' . $id_pegawai))->withInput();
                }

                if (!empty($data_jadwal['dokumen_kegiatan'])) {
                    unlink('dokumenkegiatan/' . $data_jadwal['dokumen_kegiatan']);
                }
                $nama_dokumen = $dokumen->getRandomName();
                $dokumen->move('dokumenkegiatan', $nama_dokumen);
                $data['dokumen_kegiatan'] = $nama_dokumen;
            }

            // Update data di database
            $this->M_pegawai_jadwal->edit($data);

            session()->setFlashdata('pesan', 'Data Jadwal Berhasil Diupdate!');
            return redirect()->to(base_url('pegawai_kelola_data/data_jadwal'));
        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pegawai_kelola_data/edit_jadwal/' . $id_pegawai))->withInput();
        }
    }

    public function delete_jadwal($id_pegawai)
    {
        $data = [
            'id_pegawai' => $id_pegawai,
        ];
        $this->M_pegawai_jadwal->delete_data($data);
        session()->setFlashdata('pesan', 'Data Jadwal Pegawai Ini Berhasil Di Hapus !');
        return redirect()->to(base_url('pegawai_kelola_data/data_jadwal'));
    }

    public function data_dinas()
    {
        $data = [
            'title' => 'Daftar Dinas Pegawai',
            'title2' => 'Data Dinas',
            'data_dinas' => $this->M_pegawai_dinas->get_dinas(),
            'isi' => 'pegawai/data_dinas/v_dinas',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_dinas()
    {
        $id_user = session()->get('id_user'); // Ambil id_user dari session

        // Cari nama berdasarkan id_user
        $nama = $this->M_pegawai_dinas->get_user_by_id($id_user);

        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session

        // Cari nama unit berdasarkan id_unit
        $unit = $this->M_pegawai_dinas->get_unit_by_id($id_unit);

        // Ambil data jadwal berdasarkan id_user
        $data_jadwal = $this->M_pegawai_dinas->get_jadwal_by_user($id_user);

        // Mengambil data unik untuk nama_perusahaan dan alamat_kegiatan dan nama_kegiatan
        $nama_kegiatan = array_unique(array_column($data_jadwal, 'nama_kegiatan'));
        $nama_perusahaan = array_unique(array_column($data_jadwal, 'nama_perusahaan'));
        $alamat_kegiatan = array_unique(array_column($data_jadwal, 'alamat_kegiatan'));
       
        $data = [
            'title' => 'Tambah Dinas',
            'title2' => ' Data Dinas',
            'data_dinas' => $this->M_pegawai_dinas->get_dinas(),
            'data_jadwal' => $data_jadwal,
            'data_kendaraan' => $this->M_pegawai_dinas->all_kendaraan(),
            'data_supir' => $this->M_pegawai_dinas->all_supir(),
            'nama_kegiatan' => $nama_kegiatan, // Kirim nama_kegiatan yang unik
            'nama_perusahaan' => $nama_perusahaan, // Kirim nama_perusahaan yang unik
            'alamat_kegiatan' => $alamat_kegiatan, // Kirim alamat_kegiatan yang unik
            'nama_lengkap' => $nama ? $nama['nama_lengkap'] : 'Nama Lengkap Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'nama_unit' => $unit ? $unit['nama_unit'] : 'Nama Unit Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'isi' => 'pegawai/data_dinas/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save_dinas()
    {
        if ($this->validate([
            'nama_kegiatan' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'tanggal_mulai' => [
                'label' => 'Tanggal Mulai',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'tanggal_berakhir' => [
                'label' => 'Tanggal Berakhir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'nama_perusahaan' => [
                'label' => 'Nama Perusahaan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'alamat_kegiatan' => [
                'label' => 'Alamat Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'id_kendaraan' => [
                'label' => 'Nama Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
            'id_supir' => [
                'label' => 'Nama Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
        ])) {
            // Ambil id_unit dari session
            $id_user = session()->get('id_user');
            // Ambil id_unit dari session
            $id_unit = session()->get('id_unit');

            $id_kendaraan = $this->request->getPost('id_kendaraan');
            $id_supir = $this->request->getPost('id_supir');

            // Cek stok kendaraan
            $kendaraan = $this->M_pegawai_dinas->get_kendaraan_by_id($id_kendaraan);
            if ($kendaraan['stok_kendaraan'] <= 0) {
                session()->setFlashdata('error', 'Stok kendaraan tidak mencukupi.');
                return redirect()->to(base_url('pegawai_kelola_data/add_dinas'));
            }

            // Cek stok supir
            $supir = $this->M_pegawai_dinas->get_supir_by_id($id_supir);
            if ($supir['stok_supir'] <= 0) {
                session()->setFlashdata('error', 'Stok supir tidak mencukupi.');
                return redirect()->to(base_url('pegawai_kelola_data/add_dinas'));
            }

            // Kurangi stok kendaraan
            $this->M_pegawai_dinas->kurangiStokKendaraan($id_kendaraan);

            // Kurangi stok supir 
            $this->M_pegawai_dinas->kurangiStokSupir($id_supir);
            
            $data = [
                'id_user' => $id_user, // Gunakan id_unit dari session
                'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir'),
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'alamat_kegiatan' => $this->request->getPost('alamat_kegiatan'),
                'id_kendaraan' => $id_kendaraan,
                'id_supir' => $id_supir,
                'id_unit' => $id_unit, // Gunakan id_unit dari session
            ];

            $this->M_pegawai_dinas->add($data);

            session()->setFlashdata('pesan', 'Data Dinas Berhasil Ditambahkan!');
            return redirect()->to(base_url('pegawai_kelola_data/data_dinas'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pegawai_kelola_data/add_dinas'));
        }
    }

    public function edit_dinas($id_dinas)
    {
        $id_user = session()->get('id_user'); // Ambil id_user dari session

        // Cari nama berdasarkan id_user
        $nama = $this->M_pegawai_dinas->get_user_by_id($id_user);

        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session

        // Cari nama unit berdasarkan id_unit
        $unit = $this->M_pegawai_dinas->get_unit_by_id($id_unit);

        // Ambil data jadwal berdasarkan id_user
        $data_jadwal = $this->M_pegawai_dinas->get_jadwal_by_user($id_user);

        // Mengambil data unik untuk nama_perusahaan dan alamat_kegiatan dan nama_kegiatan
        $nama_kegiatan = array_unique(array_column($data_jadwal, 'nama_kegiatan'));
        $nama_perusahaan = array_unique(array_column($data_jadwal, 'nama_perusahaan'));
        $alamat_kegiatan = array_unique(array_column($data_jadwal, 'alamat_kegiatan'));
        
        $data = [
            'title' => 'Edit Dinas',
            'title2' => 'Data Dinas',
            'data_dinas' => $this->M_pegawai_dinas->detailDinas($id_dinas),
            'data_jadwal' => $data_jadwal,
            'data_kendaraan' => $this->M_pegawai_dinas->all_kendaraan(),
            'data_supir' => $this->M_pegawai_dinas->all_supir(),
            'nama_kegiatan' => $nama_kegiatan, // Kirim nama_kegiatan yang unik
            'nama_perusahaan' => $nama_perusahaan, // Kirim nama_perusahaan yang unik
            'alamat_kegiatan' => $alamat_kegiatan, // Kirim alamat_kegiatan yang unik
            'nama_lengkap' => $nama ? $nama['nama_lengkap'] : 'Nama Lengkap Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'nama_unit' => $unit ? $unit['nama_unit'] : 'Unit Tidak Ditemukan', // Fallback jika nama unit tidak ditemukan
            'isi' => 'pegawai/data_dinas/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update_dinas($id_dinas)
    {
        $rules = [
            'nama_kegiatan' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'tanggal_mulai' => [
                'label' => 'Tanggal Mulai',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'tanggal_berakhir' => [
                'label' => 'Tanggal Berakhir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'nama_perusahaan' => [
                'label' => 'Nama Perusahaan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'alamat_kegiatan' => [
                'label' => 'Alamat Kegiatan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'id_kendaraan' => [
                'label' => 'Nama Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
            'id_supir' => [
                'label' => 'Nama Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('pegawai_kelola_data/edit_dinas/' . $id_dinas));
        }

        // Ambil id_unit dari session
        $id_user = session()->get('id_user');
        $id_unit = session()->get('id_unit');

        $id_kendaraan = $this->request->getPost('id_kendaraan');
        $id_supir = $this->request->getPost('id_supir');

        // Ambil data jadwal sebelumnya
        $dinas = $this->M_pegawai_dinas->detailDinas($id_dinas);

        // Jika kendaraan berubah, periksa stoknya
        if ($dinas['id_kendaraan'] != $id_kendaraan) {
            $kendaraan = $this->M_pegawai_dinas->get_kendaraan_by_id($id_kendaraan);
            if ($kendaraan['stok_kendaraan'] <= 0) {
                session()->setFlashdata('error', 'Stok kendaraan tidak mencukupi.');
                return redirect()->to(base_url('pegawai_kelola_data/edit_dinas/' . $id_dinas));
            }
            // Kurangi stok kendaraan jika ada perubahan
            $this->M_pegawai_dinas->kurangiStokKendaraan($id_kendaraan);
        }

        // Jika supir berubah, periksa stoknya
        if ($dinas['id_supir'] != $id_supir) {
            $supir = $this->M_pegawai_dinas->get_supir_by_id($id_supir);
            if ($supir['stok_supir'] <= 0) {
                session()->setFlashdata('error', 'Stok supir tidak mencukupi.');
                return redirect()->to(base_url('pegawai_kelola_data/edit_dinas/' . $id_dinas));
            }
            // Kurangi stok supir jika ada perubahan
            $this->M_pegawai_dinas->kurangiStokSupir($id_supir);
        }

        $data = [
            'id_dinas' => $id_dinas,
            'id_user' => $id_user, // Gunakan id_unit dari session
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir'),
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat_kegiatan' => $this->request->getPost('alamat_kegiatan'),
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'id_supir' => $this->request->getPost('id_supir'),
            'id_unit' => $id_unit, // Gunakan id_unit dari session
        ];

        // Update data di database
        $this->M_pegawai_dinas->edit($data);

        session()->setFlashdata('pesan', 'Data Dinas Berhasil Diupdate!');
        return redirect()->to(base_url('pegawai_kelola_data/data_dinas'));
    }

    public function return_stok($id_dinas)
    {
        // Mengambil data dinas berdasarkan id_dinas
        $dinas = $this->M_pegawai_dinas->find($id_dinas);

        if ($dinas) {
            // Mengecek apakah stok sudah dikembalikan melalui session
            if (session()->get('stok_dikembalikan_' . $id_dinas)) {
                // Jika sudah dikembalikan, tampilkan pesan error
                session()->setFlashdata('pesan', 'Stok kendaraan dan supir sudah dikembalikan sebelumnya, tidak bisa mengembalikan lagi.');
            } else {
                // Mengembalikan stok kendaraan dan supir
                $this->M_pegawai_dinas->tambahStokKendaraan($dinas['id_kendaraan']);
                $this->M_pegawai_dinas->tambahStokSupir($dinas['id_supir']);

                // Tandai stok sudah dikembalikan di session
                $this->M_pegawai_dinas->setStokDikembalikan($id_dinas);

                session()->setFlashdata('pesan', 'Stok berhasil dikembalikan.');
            }
        } else {
            session()->setFlashdata('pesan', 'Data dinas tidak ditemukan.');
        }

        return redirect()->to(base_url('pegawai_kelola_data/data_dinas'));
    }

    public function delete_dinas($id_dinas)
    {
        $data = [
            'id_dinas' => $id_dinas,
        ];
        $this->M_pegawai_dinas->delete_data($data);
        session()->setFlashdata('pesan', 'Data Dinas Pegawai Ini Berhasil Di Hapus !');
        return redirect()->to(base_url('pegawai_kelola_data/data_dinas'));
    }
}
