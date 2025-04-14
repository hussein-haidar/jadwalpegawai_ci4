<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pegawai_dinas extends Model
{
    protected $table = 'tbl_dinas_pegawai'; // Nama tabel
    protected $primaryKey = 'id_dinas'; // Primary key
    protected $allowedFields = ['id_dinas', 'id_jadwal', 'id_user', 'id_kendaraan', 'id_supir', 'id_unit', 'tanggal_mulai', 'tanggal_berakhir', 'alamat_kegiatan'];
    // Method untuk mendapatkan jadwal berdasarkan id_unit yang login
    public function get_dinas()
    {
        $id_user = session()->get('id_user'); // Ambil id_user dari session
        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session
        return $this->db->table('tbl_dinas_pegawai')
        ->select('tbl_dinas_pegawai.*, tbl_unit_kerja.nama_unit')
        ->select('tbl_data_user.nama_lengkap')
        ->select('tbl_data_supir.nama_supir, tbl_data_kendaraan.nama_kendaraan, tbl_data_kendaraan.plat_kendaraan') // Tambahkan kolom plat_kendaraan
        ->join('tbl_data_user', 'tbl_data_user.id_user = tbl_dinas_pegawai.id_user', 'left')
        ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_dinas_pegawai.id_unit', 'left')
        ->join('tbl_data_supir', 'tbl_data_supir.id_supir = tbl_dinas_pegawai.id_supir', 'left')
        ->join('tbl_data_kendaraan', 'tbl_data_kendaraan.id_kendaraan = tbl_dinas_pegawai.id_kendaraan', 'left')
        ->where('tbl_dinas_pegawai.id_user', $id_user) // Filter berdasarkan id_unit pengguna yang login
            ->where('tbl_dinas_pegawai.id_unit', $id_unit) // Filter berdasarkan id_unit pengguna yang login
            ->orderBy('id_dinas', 'DESC')
            ->get()->getResultArray();
    }

    public function get_jadwal_by_user($id_user)
    {
        return $this->db->table('tbl_jadwal')
        ->select('tbl_jadwal.nama_kegiatan, tbl_dinas_pegawai.id_user, tbl_jadwal.nama_perusahaan, tbl_jadwal.tanggal_mulai, tbl_jadwal.tanggal_berakhir, tbl_jadwal.alamat_kegiatan')
        ->join('tbl_dinas_pegawai', 'tbl_jadwal.id_user = tbl_dinas_pegawai.id_user', 'left') // Gabungkan tabel berdasarkan id_user
        ->where('tbl_jadwal.id_user', $id_user) // Filter berdasarkan id_user
            ->get()
            ->getResultArray();
    }

    public function get_user_by_id($id_user)
    {
        return $this->db->table('tbl_data_user')
            ->select('nama_lengkap')
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();
    }

    public function get_unit_by_id($id_unit)
    {
        return $this->db->table('tbl_unit_kerja')
            ->select('nama_unit')
            ->where('id_unit', $id_unit)
            ->get()
            ->getRowArray();
    }

    public function get_kendaraan_by_id($id_kendaraan)
    {
        return $this->db->table('tbl_data_kendaraan')
        ->where('id_kendaraan', $id_kendaraan)
            ->get()
            ->getRowArray();
    }

    public function get_supir_by_id($id_supir)
    {
        return $this->db->table('tbl_data_supir')
        ->where('id_supir', $id_supir)
            ->get()
            ->getRowArray();
    }

    public function setStokDikembalikan($id_dinas)
    {
        session()->set('stok_dikembalikan_' . $id_dinas, true); // Tandai stok sudah dikembalikan
    }

    public function kurangiStokKendaraan($id_kendaraan)
    {
        $this->db->table('tbl_data_kendaraan') // Perbaikan nama tabel
        ->set('stok_kendaraan', 'stok_kendaraan - 1', false)
        ->set('status_kendaraan', 2) // Ubah status menjadi 2 (digunakan)
            ->where('id_kendaraan', $id_kendaraan)
            ->update();
    }

    public function kurangiStokSupir($id_supir)
    {
        $this->db->table('tbl_data_supir') // Perbaikan nama tabel
        ->set('stok_supir', 'stok_supir - 1', false)
        ->set('status_supir', 2) // Ubah status menjadi 2 (digunakan)
            ->where('id_supir', $id_supir)
            ->update();
    }

    public function tambahStokKendaraan($id_kendaraan)
    {
        $this->db->table('tbl_data_kendaraan') // Perbaikan nama tabel
        ->set('stok_kendaraan', 'stok_kendaraan + 1', false)
        ->set('status_kendaraan', 1) // Ubah status menjadi 1 (tersedia)
            ->where('id_kendaraan', $id_kendaraan)
            ->update();
    }

    public function tambahStokSupir($id_supir)
    {
        $this->db->table('tbl_data_supir') // Perbaikan nama tabel
        ->set('stok_supir', 'stok_supir + 1', false)
        ->set('status_supir', 1) // Ubah status menjadi 1 (tersedia)
            ->where('id_supir', $id_supir)
            ->update();
    }
    
    // Method untuk melihat detail jadwal berdasarkan id_pegawai
    public function detailDinas($id_dinas)
    {
        return $this->db->table('tbl_dinas_pegawai')
            ->where('id_dinas', $id_dinas)
            ->get()->getRowArray();
    }

    // Method untuk menambahkan jadwal
    public function add($data)
    {
        $this->db->table('tbl_dinas_pegawai')
            ->insert($data);
    }

    // Method untuk mengedit jadwal
    public function edit($data)
    {
        $this->db->table('tbl_dinas_pegawai')
            ->where('id_dinas', $data['id_dinas'])
            ->update($data);
    }

    // Method untuk menghapus data jadwal
    public function delete_data($data)
    {
        return $this->db->table('tbl_dinas_pegawai')
            ->where('id_dinas', $data['id_dinas'])
            ->delete($data);
    }
    // Method untuk mendapatkan semua unit kerja
    public function all_unit()
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('deleted_at', 0) // Filter hanya data yang belum dihapus
            ->get()
            ->getResultArray();
    }

    public function all_supir()
    {
        return $this->db->table('tbl_data_supir')
        ->where('deleted_at', 0) // Filter hanya data yang belum dihapus
        ->get()
            ->getResultArray();
    }

    public function all_kendaraan()
    {
        return $this->db->table('tbl_data_kendaraan')
        ->where('deleted_at', 0) // Filter hanya data yang belum dihapus
        ->get()
            ->getResultArray();
    }

}
