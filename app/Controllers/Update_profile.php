<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_profile;

class Update_profile extends BaseController
{
    protected $M_profile;

    public function __construct()
    {
        $this->M_profile = new M_profile();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Profil',
            'title2' => 'Profil Saya',
            'data_profil' => $this->M_profile->get_profile(),
            'isi' => 'update_profile/v_profil',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function edit($id_user)
    {
        $data = [
            'title' => 'Data Profile',
            'title2' => 'Edit Profile',
            'data_profil' => $this->M_profile->detailProfile($id_user),
            'isi' => 'update_profile/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update_profile($id_user)
    {
        $session_id_user = session()->get('id_user');

        // Mengambil file foto dari form input
        $foto = $this->request->getFile('foto_user');
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'notelpon' => $this->request->getPost('notelpon'),
            'jobdesk' => $this->request->getPost('jobdesk')
        ];

        if ($foto->getError() != 4) {
            // Menghapus foto lama
            $data_profil = $this->M_profile->detailProfile($session_id_user);
            if ($data_profil['foto_user'] != "") {
                unlink('fotouser/' . $data_profil['foto_user']);
            }
            // Generate a unique name for the file
            $nama_file = $foto->getRandomName();
            $data['foto_user'] = $nama_file;

            // Move the uploaded file to the specified directory
            $foto->move('fotouser', $nama_file);
        }

        $sukses = $this->M_profile->edit($session_id_user, $data);

        if ($sukses) {
            // Update session data
            session()->set('username', $data['username']);
            session()->set('password', $data['password']);
            session()->set('nama_lengkap', $data['nama_lengkap']);
            session()->set('notelpon', $data['notelpon']);
            session()->set('jobdesk', $data['jobdesk']);
            if (isset($data['foto_user'])) {
                session()->set('foto_user', $data['foto_user']);
            }

            session()->setFlashdata('pesan', 'Data Profil Berhasil Diubah !!!');
            return redirect()->to(base_url('update_profile'));
        } else {
            session()->setFlashdata('pesan', 'Gagal Mengubah Data Profil !!!');
            return redirect()->to(base_url('update_profile/edit/' . $session_id_user));
        }
    }
}
