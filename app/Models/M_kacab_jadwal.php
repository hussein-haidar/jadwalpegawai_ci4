<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kacab_jadwal extends Model
{
    protected $table = 'tbl_jadwal'; // Nama tabel
    protected $primaryKey = 'id_pegawai'; // Primary key
    protected $allowedFields = ['nama_pegawai', 'nama_perusahaan', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_berakhir', 'alamat_kegiatan', 'status_kegiatan', 'foto_kegiatan', 'dokumen_kegiatan'];

    public function get_jadwal()
    {
        $id_unit = session()->get('id_unit'); // Ambil id_unit dari session
        return $this->db->table('tbl_jadwal')
        ->select('tbl_jadwal.*, tbl_unit_kerja.nama_unit')
        ->select('tbl_jadwal.*, tbl_data_user.nama_lengkap')
        ->join('tbl_data_user', 'tbl_data_user.id_user = tbl_jadwal.id_user', 'left')
        ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_jadwal.id_unit', 'left')
            ->where('tbl_jadwal.id_unit', $id_unit) // Filter berdasarkan id_unit pengguna yang login
            ->orderBy('id_pegawai', 'DESC')
            ->get()->getResultArray();
    }

    public function get_all_jadwal()
    {
        return $this->db->table('tbl_jadwal')
            ->orderBy('id_pegawai', 'DESC')
            ->get()->getResultArray();
    }

    public function detailJadwal($id_pegawai)
    {
        return $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $id_pegawai)
            ->get()->getRowArray();
    }

    public function all_unit()
    {
        return $this->db->table('tbl_unit_kerja')
            ->get()->getResultArray();
    }
}
