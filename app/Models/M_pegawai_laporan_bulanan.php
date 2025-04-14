<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pegawai_laporan_bulanan extends Model
{
    protected $table = 'tbl_jadwal'; // Nama tabel
    protected $primaryKey = 'id_pegawai'; // Primary key
    protected $allowedFields = ['id_user', 'nama_perusahaan', 'nama_kegiatan', 'waktu_mulai', 'waktu_selesai', 'alamat_kegiatan', 'status_kegiatan', 'foto_kegiatan', 'id_unit', 'dokumen_kegiatan'];

    public function get_all_jadwal()
    {
        return $this->db->table('tbl_jadwal')
            ->select('tbl_jadwal.*, tbl_unit_kerja.nama_unit')
            ->select('tbl_jadwal.*, tbl_data_user.nama_lengkap')
            ->join('tbl_data_user', 'tbl_data_user.id_user = tbl_jadwal.id_user', 'left')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_jadwal.id_unit', 'left')
            ->orderBy('id_pegawai', 'DESC')
            ->get()->getResultArray();
    }

    public function all_unit()
    {
        return $this->db->table('tbl_unit_kerja')
            ->get()->getResultArray();
    }
    // Filter by month range
    public function get_laporan_by_month_range($start_month, $end_month)
    {
        $start_date = date('Y-m-01', strtotime($start_month));
        $end_date = date('Y-m-t', strtotime($end_month));
        return $this->db->table('tbl_jadwal')
            ->select('tbl_jadwal.*, tbl_unit_kerja.nama_unit')
            ->select('tbl_jadwal.*, tbl_data_user.nama_lengkap')
            ->join('tbl_data_user', 'tbl_data_user.id_user = tbl_jadwal.id_user', 'left')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_jadwal.id_unit', 'left')
            ->orderBy('id_pegawai', 'DESC')
            ->where('tanggal_mulai >=', $start_date)
            ->where('tanggal_berakhir <=', $end_date)
            ->get()->getResultArray();
    }
}
