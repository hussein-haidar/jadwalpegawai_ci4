<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_auth_login;


class Auth extends BaseController
{
    protected $M_auth_login;

    public function __construct()
    {
        $this->M_auth_login = new M_auth_login();
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
            'title2' => 'Jadwal Pegawai',
        ];
        return view('auth_login/v_login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'password' => [
                'label' => 'Kata Sandi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Cek apakah username ada
            $user = $this->M_auth_login->findByUsername($username);
            if ($user) {
                // Jika username ada, cek password
                if ($user['password'] === $password) {
                    // Login berhasil
                    $userData = [
                        'id_user' => $user['id_user'],
                        'username' => $user['username'],
                        'password' => $user['password'],
                        'nama_lengkap' => $user['nama_lengkap'],
                        'nama_title' => $user['nama_title'],
                        'id_unit' => $user['id_unit'],
                        'jobdesk' => $user['jobdesk'],
                        'notelpon' => $user['notelpon'],
                        'foto_user' => $user['foto_user'],
                        'level' => $user['level'],
                        'last_login' => $user['last_login'],
                    ];

                    session()->set('log', true);
                    session()->set($userData);

                    // Update waktu login terakhir
                    $this->M_auth_login->updateLastLogin($user['id_user']);
                    session()->setFlashdata('pesan', 'Selamat Datang, ' . $user['nama_lengkap'] . '!');

                    // Redirect berdasarkan level
                    switch ($user['level']) {
                        case 1:
                            return redirect()->to(base_url('home_sekretaris'));
                        case 2:
                            return redirect()->to(base_url('home_pegawai'));
                        case 3:
                            return redirect()->to(base_url('home_satpam'));
                        default:
                            return redirect()->to(base_url('auth/login'));
                    }
                } else {
                    // Password salah
                    session()->setFlashdata('pesan_warning', 'Login Gagal, Password Salah!');
                    return redirect()->to(base_url('auth/login'));
                }
            } else {
                // Username tidak ditemukan
                session()->setFlashdata('pesan_warning', 'Login Gagal, Username Tidak Ditemukan!');
                return redirect()->to(base_url('auth/login'));
            }
        } else {
            // Validasi form gagal
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/login'));
        }
    }

    // Menampilkan halaman untuk form lupa password
    public function lupa_password()
    {
        $data = [
            'title' => 'Lupa Password',
            'title2' => 'Jadwal Pegawai',
        ];
        return view('auth_login/v_lupa_password', $data);
    }

    // Proses untuk mengecek username dan lanjut ke halaman reset password
    public function proses_lupa_password()
    {
        // Validasi dan cek jika form dipost
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');

            // Validasi jika username tidak kosong
            if (empty($username)) {
                return redirect()->back()->with('error_username', 'Username tidak boleh kosong.');
            }

            // Cek apakah username ada di database
            $user = $this->M_auth_login->where('username', $username)->first();

            // Jika username ditemukan, lanjut ke halaman reset password
            if ($user) {
                return redirect()->to(base_url('auth/reset_password/' . $user['id_user']));
            } else {
                // Jika username tidak ditemukan, tampilkan pesan error
                return redirect()->back()->with('error_username', 'Username tidak ditemukan.');
            }
        }

        // Menampilkan halaman lupa password jika tidak ada request post
        return view('auth_login/v_lupa_password');
    }

    // Menampilkan halaman untuk reset password
    public function reset_password($id_user = null)
    {
        // Jika id_user tidak ada, redirect kembali ke halaman lupa password
        if ($id_user === null) {
            return redirect()->to(base_url('auth/lupa_password'));
        }

        // Ambil data user berdasarkan id_user
        $user = $this->M_auth_login->find($id_user);

        // Jika user tidak ditemukan, redirect kembali ke halaman lupa password
        if (!$user) {
            return redirect()->to(base_url('auth/lupa_password'));
        }

        // Validasi jika form reset password dipost
        if ($this->request->getMethod() === 'post') {
            $newPassword = $this->request->getPost('new_password');
            $confirmPassword = $this->request->getPost('confirm_password');

            // Validasi jika password dan konfirmasi password tidak cocok
            if ($newPassword !== $confirmPassword) {
                return redirect()->back()->with('error_password', 'Password tidak cocok.');
            }

            // Update password baru tanpa enkripsi
            $this->M_auth_login->update($id_user, [
                'password' => $newPassword  // Menyimpan password baru tanpa enkripsi
            ]);

            // Beri pesan sukses setelah berhasil update password
            session()->setFlashdata('pesan_success', 'Password berhasil diperbarui.');
            return redirect()->to(base_url('auth/login'));
        }

        // Menampilkan halaman reset password dengan data user
        $data = [
            'title' => 'Reset Password - ' . $user['username'],
            'title2' => 'Jadwal Pegawai',
            'user' => $user
        ];
        return view('auth_login/v_reset_password', $data);
    }
   
    public function logout()
    {
        // Mengambil semua data sesi yang ada
        $session_data = session()->get();

        // Menghapus semua data sesi menggunakan remove()
        foreach ($session_data as $key => $value) {
            session()->remove($key);
        }

        // Set flashdata pesan_success setelah menghapus sesi
        session()->setFlashdata('pesan_success', 'Logout Berhasil !');

        // Redirect ke halaman login
        return redirect()->to(base_url('auth/login'));
    }

}
