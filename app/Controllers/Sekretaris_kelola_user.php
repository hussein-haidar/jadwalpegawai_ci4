<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_sekretaris_user;

class Sekretaris_kelola_user extends BaseController
{
    protected $M_sekretaris_user;

    public function __construct()
    {
        $this->M_sekretaris_user = new M_sekretaris_user();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'title2' => 'Data Pengguna',
            'data_user' => $this->M_sekretaris_user->get_user(),
            'isi' => 'sekretaris/data_user/v_user',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'title2' => 'Daftar Pengguna',
            'data_unit' => $this->M_sekretaris_user->all_unit(),
            'isi' =>
            'sekretaris/data_user/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required|is_unique[tbl_data_user.username]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'is_unique' => '{field} Sudah Ada, Input {field} Lain !!!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_title' => [
                'label' => 'Nama Title',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'notelpon' => [
                'label' => 'No Telepon Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'jobdesk' => [
                'label' => 'Jobdesk User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'id_unit' => [
                'label' => 'Pilih Unit Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'foto_user' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto_user]|max_size[foto_user,1024]|mime_in[foto_user,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!',
                ]
            ],
        ])) {
            // Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_user');
            // Mengganti nama file foto
            $nama_file = $foto->getRandomName();

            // Jika valid, menambahkan data pengguna baru
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nama_title' => $this->request->getPost('nama_title'),
                'notelpon' => $this->request->getPost('notelpon'),
                'jobdesk' => $this->request->getPost('jobdesk'),
                'level' => $this->request->getPost('level'),
                'id_unit' => $this->request->getPost('id_unit'),
                'foto_user' => $nama_file,
                'last_login' => date('Y-m-d H:i:s'),  // Menambahkan last_login dengan waktu saat ini
            ];

            // File foto disimpan di folder foto_user
            $foto->move('fotouser', $nama_file);

            // Menambahkan data ke database
            $this->M_sekretaris_user->add($data);

            session()->setFlashdata('pesan', 'Data Pengguna Berhasil Ditambahkan !');
            return redirect()->to(base_url('sekretaris_kelola_user'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('sekretaris_kelola_user/add'));
        }
    }

    public function edit($id_user)
    {
        $data = [
            'title' => 'Edit Pengguna',
            'title2' => 'Daftar Pengguna',
            'data_unit' => $this->M_sekretaris_user->all_unit(),
            'user' => $this->M_sekretaris_user->detailUser($id_user),
            'isi' => 'sekretaris/data_user/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_user)
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'notelpon' => [
                'label' => 'No Telepon Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'jobdesk' => [
                'label' => 'Jobdesk User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'foto_user' => [
                'label' => 'Foto User',
                'rules' => 'max_size[foto_user,1024]|mime_in[foto_user,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!'
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_user');

            if ($foto->getError() == 4) {
                //Jika foto tidak diganti
                $data = [
                    'id_user' => $id_user,
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'notelpon' => $this->request->getPost('notelpon'),
                    'jobdesk' => $this->request->getPost('jobdesk'),
                    'level' => $this->request->getPost('level'),
                    'id_unit' => $this->request->getPost('id_unit'),
                ];
                $this->M_sekretaris_user->edit($data);
            } else {
                //Menghapus foto lama
                $data_user = $this->M_sekretaris_user->detailUser($id_user);
                if ($data_user['foto_user'] != "") {
                    unlink('fotouser/' . $data_user['foto_user']);
                }
                //Mengganti nama file foto
                $nama_file = $foto->getRandomName();
                // Jika valid
                $data = [
                    'id_user' => $id_user,
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'notelpon' => $this->request->getPost('notelpon'),
                    'jobdesk' => $this->request->getPost('jobdesk'),
                    'level' => $this->request->getPost('level'),
                    'id_unit' => $this->request->getPost('id_unit'),
                    'foto_user' => $nama_file,
                ];
                // File foto disimpan di folder foto_produk
                $foto->move('fotouser', $nama_file);
                $this->M_sekretaris_user->edit($data);
            }

            // Update session data
            session()->set('username', $data['username']);
            session()->set('password', $data['password']); 
            session()->set('notelpon', $data['notelpon']);
            session()->set('jobdesk', $data['jobdesk']);
            if (isset($data['foto_user'])) {
                session()->set('foto_user', $data['foto_user']);
            }

            session()->setFlashdata('pesan', 'Data Pengguna Ini Berhasil Di Ganti !');
            return redirect()->to(base_url('sekretaris_kelola_user'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('sekretaris_kelola_user/edit/' . $id_user));
        }
    }

    public function delete($id_user)
    {
        //Menghapus foto lama
        $data_user = $this->M_sekretaris_user->detailUser($id_user);
        if ($data_user['foto_user'] != "") {
            unlink('fotouser/' . $data_user['foto_user']);
        }
        $data = [
            'id_user' => $id_user,
        ];
        $this->M_sekretaris_user->delete_data($data);
        session()->setFlashdata('pesan', 'Data Pengguna Ini Berhasil Di Hapus !');
        return redirect()->to(base_url('sekretaris_kelola_user'));
    }
}
