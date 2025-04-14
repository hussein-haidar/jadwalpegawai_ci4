<?php

namespace App\Models;

use CodeIgniter\Model;

class M_home_pegawai extends Model
{

    protected $table = 'tbl_jadwal'; // Nama tabel
    protected $primaryKey = 'id_pegawai'; // Primary key
    protected $allowedFields = ['nama_pegawai', 'nama_perusahaan', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_berakhir', 'alamat_kegiatan', 'status_kegiatan', 'foto_kegiatan', 'id_unit', 'dokumen_kegiatan'];

    public function get_jadwal()
    {
        $id_unit = session()->get('id_unit'); // Ambil id_caba
        return $this->db->table('tbl_jadwal')
        ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit=tbl_jadwal.id_unit', 'left')
        ->where('tbl_jadwal.id_unit', $id_unit)
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
