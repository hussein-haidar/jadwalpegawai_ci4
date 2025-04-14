<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_sekretaris_jadwal;

class Sekretaris_acc_jadwal extends BaseController
{
    protected $M_sekretaris_jadwal;

    public function __construct()
    {
        $this->M_sekretaris_jadwal = new M_sekretaris_jadwal();
    }

    public function view_jadwal()
    {
        // Ambil ID cabang dari request
        $id_unit = $this->request->getVar('id_unit');

        // Jika ID cabang tidak ada di request, coba ambil dari sesi
        if (!$id_unit) {
            $id_unit = session()->get('selected_unit');
        } else {
            // Jika ID cabang ditemukan di request, simpan ke sesi
            session()->set('selected_unit', $id_unit);
        }

        // Jika id_unit tidak ada, ambil semua data permintaan
        if ($id_unit) {
            $data_jadwal = $this->M_sekretaris_jadwal->get_jadwal_by_unit($id_unit);
        } else {
            $data_jadwal = $this->M_sekretaris_jadwal->get_all_jadwal();
        }
        $data = [
            'title' => 'Daftar Jadwal Pegawai',
            'title2' => 'Data Jadwal',
            'data_jadwal' => $data_jadwal,
            'data_unit' => $this->M_sekretaris_jadwal->all_unit(),
            'selected_unit' => $id_unit, // Kirim id_unit ke view
            'isi' => 'sekretaris/data_pegawai/v_all_pegawai',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_dokumen($id_pegawai)
    {
        $data = [
            'title' => 'View Dokumen Pegawai',
            'title2' => 'Data Dokumen',
            'data_jadwal' => $this->M_sekretaris_jadwal->detailJadwal($id_pegawai),
            'isi' => 'sekretaris/data_pegawai/v_dokumen',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_foto($id_pegawai)
    {
        $data = [
            'title' => 'View Foto Pegawai',
            'title2' => 'Data Foto',
            'data_jadwal' => $this->M_sekretaris_jadwal->detailJadwal($id_pegawai),
            'isi' => 'sekretaris/data_pegawai/v_foto',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function edit($id_pegawai)
    {
        $data = [
            'title' => 'Edit Jadwal Pegawai',
            'title2' => 'Data Jadwal',
            'data_jadwal' => $this->M_sekretaris_jadwal->detailJadwal($id_pegawai),
            'data_user' => $this->M_sekretaris_jadwal->all_user(),
            'data_unit' => $this->M_sekretaris_jadwal->all_unit(),
            'isi' => 'sekretaris/data_pegawai/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_pegawai)
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
            $data_jadwal = $this->M_sekretaris_jadwal->detailJadwal($id_pegawai);

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
            $this->M_sekretaris_jadwal->edit($data);

            session()->setFlashdata('pesan', 'Data Jadwal Berhasil Diupdate!');
            return redirect()->to(base_url('sekretaris_acc_jadwal/data_jadwal'));
        } else {
            // Jika validasi gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('sekretaris_acc_jadwal/edit_jadwal/' . $id_pegawai))->withInput();
        }
    }
}
