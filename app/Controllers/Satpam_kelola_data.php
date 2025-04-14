<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_satpam_supir;
use App\Models\M_satpam_kendaraan;

class Satpam_kelola_data extends BaseController
{
    protected $M_satpam_supir;
    protected $M_satpam_kendaraan;

    public function __construct()
    {
        $this->M_satpam_supir = new M_satpam_supir();
        $this->M_satpam_kendaraan = new M_satpam_kendaraan();
    }

    public function data_supir()
    {
        $data = [
            'title' => 'Daftar Supir',
            'title2' => 'Data Supir',
            'data_supir' => $this->M_satpam_supir->get_data(),
            'isi' => 'satpam/data_supir/v_supir',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_supir()
    {
        $data = [
            'title' => 'Tambah Supir',
            'title2' => ' Data Supir',
            'data_supir' => $this->M_satpam_supir->get_data(),
            'isi' => 'satpam/data_supir/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save_supir()
    {
        if ($this->validate([
            'nama_supir' => [
                'label' => 'Nama Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'notelpon_supir' => [
                'label' => 'No Telpon Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'alamat_supir' => [
                'label' => 'Alamat Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'status_supir' => [
                'label' => 'Status Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
            'foto_supir' => [
                'label' => 'Foto Supir',
                'rules' => 'uploaded[foto_supir]|max_size[foto_supir,1024]|mime_in[foto_supir,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!',
                ]
            ],
        ])) {
            // Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_supir');
            // Mengganti nama file foto
            $nama_file = $foto->getRandomName();
            //JIka valid
            $data = [
                'nama_supir' => $this->request->getPost('nama_supir'),
                'notelpon_supir' => $this->request->getPost('notelpon_supir'),
                'alamat_supir' => $this->request->getPost('alamat_supir'),
                'stok_supir' => $this->request->getPost('stok_supir'),
                'status_supir' => $this->request->getPost('status_supir'),
                'foto_supir' => $nama_file,
            ];
            // File foto disimpan di folder foto_user
            $foto->move('fotosupir', $nama_file);
            // Menambahkan ke database
            $this->M_satpam_supir->add($data);

            session()->setFlashdata('pesan', 'Data Supir Berhasil Ditambahkan!');
            return redirect()->to(base_url('satpam_kelola_data/data_supir'));
        } else {
              // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('satpam_kelola_data/add_supir'));
        }
    }
    public function edit_supir($id_supir)
    {
        $data = [
            'title' => 'Edit Supir',
            'title2' => 'Data Supir',
            'data_supir' => $this->M_satpam_supir->detailSupir($id_supir),
            'isi' => 'satpam/data_supir/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update_supir($id_supir)
    {
        if ($this->validate(['nama_supir' => [
                'label' => 'Nama Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'notelpon_supir' => [
                'label' => 'No Telpon Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'alamat_supir' => [
                'label' => 'Alamat Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'status_supir' => [
                'label' => 'Status Supir',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
            'foto_supir' => [
                'label' => 'Foto Supir',
                'rules' => 'if_exist|max_size[foto_supir,1024]|mime_in[foto_supir,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!',
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_supir');

            if ($foto->getError() == 4) {
                //Jika foto tidak diganti
                $data = [
                    'id_supir' => $id_supir,
                    'nama_supir' => $this->request->getPost('nama_supir'),
                    'notelpon_supir' => $this->request->getPost('notelpon_supir'),
                    'alamat_supir' => $this->request->getPost('alamat_supir'),
                    'stok_supir' => $this->request->getPost('stok_supir'),
                    'status_supir' => $this->request->getPost('status_supir'),
                ];
                $this->M_satpam_supir->edit($data);
            } else {
                //Menghapus foto lama
                $data_supir = $this->M_satpam_supir->detailSupir($id_supir);
                if ($data_supir['foto_supir'] != "") {
                    unlink('fotosupir/' . $data_supir['foto_supir']);
                }
                //Mengganti nama file foto
                $nama_file = $foto->getRandomName();
                // Jika valid
                $data = [
                    'id_supir' => $id_supir,
                    'nama_supir' => $this->request->getPost('nama_supir'),
                    'notelpon_supir' => $this->request->getPost('notelpon_supir'),
                    'alamat_supir' => $this->request->getPost('alamat_supir'),
                    'stok_supir' => $this->request->getPost('stok_supir'),
                    'foto_supir' => $nama_file,
                ];
                // File foto disimpan di folder foto_produk
                $foto->move('fotosupir', $nama_file);
                $this->M_satpam_supir->edit($data);
            }

            session()->setFlashdata('pesan', 'Data Supir Ini Berhasil Di Ganti !');
            return redirect()->to(base_url('satpam_kelola_data/data_supir'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('satpam_kelola_data/edit_supir/' . $id_supir));
        }
    }

    public function data_supir_dihapus()
    {
        $data = [
            'title' => 'Daftar Supir Dihapus',
            'title2' => 'Data Supir Dihapus',
            'data_supir_dihapus' => $this->M_satpam_supir->get_supir_dihapus(), // Ambil data produk yang sudah dihapus
            'isi' => 'satpam/data_supir/v_data_dihapus', // Ganti dengan view yang sesuai
        ];
        return view('layout/v_wrapper', $data);
    }

    public function delete_supir($id_supir)
    {
        // Soft delete produk, menandai produk sebagai terhapus
        $this->M_satpam_supir->update($id_supir, ['deleted_at' => 1]);
        return redirect()->to(base_url('satpam_kelola_data/data_supir'))->with('pesan', 'Data Supir Ini berhasil dihapus !');
    }

    public function restore_supir($id_supir)
    {
        // Restore produk yang telah dihapus
        $this->M_satpam_supir->update($id_supir, ['deleted_at' => 0]);
        return redirect()->to(base_url('satpam_kelola_data/data_supir'))->with('pesan', 'Data Supir Ini berhasil direstore !');
    }

    public function data_kendaraan()
    {
        $data = [
            'title' => 'Daftar Kendaraan',
            'title2' => 'Data Kendaraan',
            'data_kendaraan' => $this->M_satpam_kendaraan->get_data(),
            'isi' => 'satpam/data_kendaraan/v_kendaraan',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add_kendaraan()
    {
        $data = [
            'title' => 'Tambah Kendaraan',
            'title2' => 'Data Kendaraan',
            'data_kendaraan' => $this->M_satpam_kendaraan->get_data(),
            'isi' => 'satpam/data_kendaraan/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save_kendaraan()
    {
        if ($this->validate([
            'nama_kendaraan' => [
                'label' => 'Nama Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'jenis_kendaraan' => [
                'label' => 'Jenis Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'plat_kendaraan' => [
                'label' => 'Plat Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'stok_kendaraan' => [
                'label' => 'Stok Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'status_kendaraan' => [
                'label' => 'Status Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Dipilih !!!']
            ],
            'foto_kendaraan' => [
                'label' => 'Foto Supir',
                'rules' => 'uploaded[foto_kendaraan]|max_size[foto_kendaraan,1024]|mime_in[foto_kendaraan,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!',
                ]
            ],
        ])) {
            // Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_kendaraan');
            // Mengganti nama file foto
            $nama_file = $foto->getRandomName();
            //JIka valid
            $data = [
                'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
                'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
                'plat_kendaraan' => $this->request->getPost('plat_kendaraan'),
                'stok_kendaraan' => $this->request->getPost('stok_kendaraan'),
                'status_kendaraan' => $this->request->getPost('status_kendaraan'),
                'foto_kendaraan' => $nama_file,
            ];
            // File foto disimpan di folder foto_user
            $foto->move('fotokendaraan', $nama_file);
            // Menambahkan ke database
            $this->M_satpam_kendaraan->add($data);

            session()->setFlashdata('pesan', 'Data Kendaraan Berhasil Ditambahkan!');
            return redirect()->to(base_url('satpam_kelola_data/data_kendaraan'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('satpam_kelola_data/add_kendaraan'));
        }
    }
    public function edit_kendaraan($id_kendaraan)
    {
        $data = [
            'title' => 'Edit Kendaraan',
            'title2' => 'Data Kendaraan',
            'data_kendaraan' => $this->M_satpam_kendaraan->detailKendaraan($id_kendaraan),
            'isi' => 'satpam/data_kendaraan/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update_kendaraan($id_kendaraan)
    {
        if ($this->validate(['nama_kendaraan' => [
                'label' => 'Nama Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'jenis_kendaraan' => [
                'label' => 'Jenis Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'plat_kendaraan' => [
                'label' => 'Plat Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'stok_kendaraan' => [
                'label' => 'Stok Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'status_kendaraan' => [
                'label' => 'Status Kendaraan',
                'rules' => 'required',
                'errors' => ['required' => '{field} Wajib Diisi !!!']
            ],
            'foto_kendaraan' => [
                'label' => 'Foto Kendaraan',
                'rules' => 'if_exist|max_size[foto_kendaraan,1024]|mime_in[foto_kendaraan,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!',
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_kendaraan');

            if ($foto->getError() == 4) {
                //Jika foto tidak diganti
                $data = [
                    'id_kendaraan' => $id_kendaraan,
                    'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
                    'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
                    'plat_kendaraan' => $this->request->getPost('plat_kendaraan'),
                    'stok_kendaraan' => $this->request->getPost('stok_kendaraan'),
                    'status_kendaraan' => $this->request->getPost('status_kendaraan'),
                ];
                $this->M_satpam_kendaraan->edit($data);
            } else {
                //Menghapus foto lama
                $data_kendaraan = $this->M_satpam_kendaraan->detailKendaraan($id_kendaraan);
                if ($data_kendaraan['foto_kendaraan'] != "") {
                    unlink('fotokendaraan/' . $data_kendaraan['foto_kendaraan']);
                }
                //Mengganti nama file foto
                $nama_file = $foto->getRandomName();
                // Jika valid
                $data = [
                    'id_kendaraan' => $id_kendaraan,
                    'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
                    'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
                    'plat_kendaraan' => $this->request->getPost('plat_kendaraan'),
                    'stok_kendaraan' => $this->request->getPost('stok_kendaraan'),
                    'status_kendaraan' => $this->request->getPost('status_kendaraan'),
                    'foto_kendaraan' => $nama_file,
                ];
                // File foto disimpan di folder foto_produk
                $foto->move('fotokendaraan', $nama_file);
                $this->M_satpam_kendaraan->edit($data);
            }

            session()->setFlashdata('pesan', 'Data Kendaraan Ini Berhasil Di Ganti !');
            return redirect()->to(base_url('satpam_kelola_data/data_kendaraan'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('satpam_kelola_data/edit_kendaraan/' . $id_kendaraan));
        }
    }

    public function data_kendaraan_dihapus()
    {
        $data = [
            'title' => 'Daftar Kendaraan Dihapus',
            'title2' => 'Data Kendaraan Dihapus',
            'data_kendaraan_dihapus' => $this->M_satpam_kendaraan->get_kendaraan_dihapus(), // Ambil data produk yang sudah dihapus
            'isi' => 'satpam/data_kendaraan/v_data_dihapus', // Ganti dengan view yang sesuai
        ];
        return view('layout/v_wrapper', $data);
    }

    public function delete_kendaraan($id_kendaraan)
    {
        // Soft delete produk, menandai produk sebagai terhapus
        $this->M_satpam_kendaraan->update($id_kendaraan, ['deleted_at' => 1]);
        return redirect()->to(base_url('satpam_kelola_data/data_kendaraan'))->with('pesan', 'Data Kendaraan Ini berhasil dihapus !');
    }

    public function restore_kendaraan($id_kendaraan)
    {
        // Restore produk yang telah dihapus
        $this->M_satpam_kendaraan->update($id_kendaraan, ['deleted_at' => 0]);
        return redirect()->to(base_url('satpam_kelola_data/data_kendaraan'))->with('pesan', 'Data Kendaraan Ini berhasil direstore !');
    }
}
