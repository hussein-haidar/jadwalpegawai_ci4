<?php

namespace App\Models;

use CodeIgniter\Model;

class M_home_sekretaris extends Model
{
    public function tot_unit()
    {
        return $this->db->table('tbl_unit_kerja')->countAll();
    }

    public function tot_user()
    {
        return $this->db->table('tbl_data_user')->countAll();
    }

    public function tot_dinas_by_unit()
    {
        $id_unit = session()->get('id_unit'); // Ambil id_cabang dari sesi
        return $this->db->table('tbl_dinas_pegawai')
        ->select('tbl_dinas_pegawai.*')
        ->join('tbl_unit_kerja', 'tbl_dinas_pegawai.id_unit = tbl_unit_kerja.id_unit')
        ->where('tbl_dinas_pegawai.id_unit', $id_unit) // Filter berdasarkan id_cabang
            ->get()
            ->getResultArray();
    }

    public function tot_jadwal_sukses()
    {
        return $this->db->table('tbl_jadwal')
            ->select('tbl_jadwal.*')
            ->join('tbl_unit_kerja', 'tbl_jadwal.id_unit = tbl_unit_kerja.id_unit')
            ->where('tbl_jadwal.status_kegiatan', '2')
            ->get()
            ->getResultArray();
    }

    public function tot_jadwal_tolak()
    {
        return $this->db->table('tbl_jadwal')
            ->select('tbl_jadwal.*')
            ->join('tbl_unit_kerja', 'tbl_jadwal.id_unit = tbl_unit_kerja.id_unit')
            ->where('tbl_jadwal.status_kegiatan', '3')
            ->get()
            ->getResultArray();
    }
}
