<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pegawai_jadwal extends Model
{
    protected $table = 'tbl_jadwal'; // Nama tabel
    protected $primaryKey = 'id_pegawai'; // Primary key
    protected $allowedFields = ['id_user', 'nama_perusahaan', 'nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'alamat_kegiatan', 'status_kegiatan', 'foto_kegiatan', 'id_unit', 'dokumen_kegiatan'];

    // Method untuk mendapatkan jadwal berdasarkan id_unit yang login
    public function get_jadwal()
    {
        $id_user = session()->get('id_user'); // Ambil id_user dari session
        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session
        return $this->db->table('tbl_jadwal')
            ->select('tbl_jadwal.*, tbl_unit_kerja.nama_unit')
            ->select('tbl_jadwal.*, tbl_data_user.nama_lengkap')
            ->join('tbl_data_user', 'tbl_data_user.id_user = tbl_jadwal.id_user', 'left')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_jadwal.id_unit', 'left')
            ->where('tbl_jadwal.id_user', $id_user) // Filter berdasarkan id_unit pengguna yang login
            ->where('tbl_jadwal.id_unit', $id_unit) // Filter berdasarkan id_unit pengguna yang login
            ->orderBy('id_pegawai', 'DESC')
            ->get()->getResultArray();
    }

    public function get_user_by_id($id_user)
    {
        return $this->db->table('tbl_data_user')
            ->select('nama_lengkap')
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();
    }

    public function get_jadwal_by_id($id_jadwal)
    {
        return $this->db->table('tbl_jadwal')
            ->select('nama_kegiatan')
            ->select('tanggal_mulai')
            ->select('tanggal_berakhir')
            ->select('alamat_kegiatan')
            ->where('id_jadwal', $id_jadwal)
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

    // Method untuk melihat detail jadwal berdasarkan id_pegawai
    public function detailJadwal($id_pegawai)
    {
        return $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $id_pegawai)
            ->get()->getRowArray();
    }

    // Method untuk menambahkan jadwal
    public function add($data)
    {
        $this->db->table('tbl_jadwal')
            ->insert($data);
    }

    // Method untuk mengedit jadwal
    public function edit($data)
    {
        $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $data['id_pegawai'])
            ->update($data);
    }

    // Method untuk menghapus data jadwal
    public function delete_data($data)
    {
        return $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $data['id_pegawai'])
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
    
}
