<?php

namespace App\Models;

use CodeIgniter\Model;

class M_sekretaris_jadwal extends Model
{
    protected $table = 'tbl_jadwal'; // Nama tabel
    protected $primaryKey = 'id_pegawai'; // Primary key
    protected $allowedFields = ['id_user', 'nama_perusahaan', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_berakhir', 'alamat_kegiatan', 'status_kegiatan', 'foto_kegiatan', 'id_unit', 'dokumen_kegiatan'];

    // Method untuk mendapatkan semua jadwal
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
    
    public function get_jadwal_by_unit($id_unit)
    {
        return $this->db->table('tbl_jadwal')
            ->select('tbl_jadwal.*, tbl_unit_kerja.nama_unit')
            ->select('tbl_jadwal.*, tbl_data_user.nama_lengkap')
            ->join('tbl_data_user', 'tbl_data_user.id_user = tbl_jadwal.id_user', 'left')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit=tbl_jadwal.id_unit', 'left')
            ->where('tbl_jadwal.id_unit', $id_unit)
            ->orderBy('id_pegawai', 'DESC')
            ->get()->getResultArray();
    }

    public function detailJadwal($id_pegawai)
    {
        return $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $id_pegawai)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_jadwal')
            ->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $data['id_pegawai'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_jadwal')
            ->where('id_pegawai', $data['id_pegawai'])
            ->delete($data);
    }

    public function all_user()
    {
        return $this->db->table('tbl_data_user')
        ->get()
            ->getResultArray();
    }

    public function all_unit()
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('deleted_at', 0) // Filter hanya data yang belum dihapus
            ->get()
            ->getResultArray();
    }
}
