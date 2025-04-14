<?php

namespace App\Models;

use CodeIgniter\Model;

class M_satpam_kendaraan extends Model
{
    protected $table = 'tbl_data_kendaraan'; // Nama tabel
    protected $primaryKey = 'id_kendaraan'; // Primary key
    protected $allowedFields = ['nama_kendaraan', 'jenis_kendaraan', 'plat_kendaraan', 'stok_kendaraan','status_kendaraan','foto_kendaraan','deleted_at'];

    public function get_data()
    {
        return $this->db->table('tbl_data_kendaraan')
            ->where('deleted_at', 0) // Hanya ambil data yang belum dihapus
            ->get()->getResultArray();
    }

    public function get_kendaraan_dihapus()
    {
        return $this->db->table('tbl_data_kendaraan')
            ->where('deleted_at', 1) // Hanya ambil data yang sudah dihapus
            ->get()->getResultArray();
    }

    public function detailKendaraan($id_kendaraan)
    {
        return $this->db->table('tbl_data_kendaraan')
            ->where('id_kendaraan', $id_kendaraan)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_data_kendaraan')
            ->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_data_kendaraan')
            ->where('id_kendaraan', $data['id_kendaraan'])
            ->update($data);
    }

    public function delete_data($id_kendaraan)
    {
        return $this->db->table('tbl_data_kendaraan')
            ->where('id_kendaraan', $id_kendaraan)
            ->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function restore($id_kendaraan)
    {
        return $this->db->table('tbl_data_kendaraan')
            ->where('id_kendaraan', $id_kendaraan)
            ->update(['deleted_at' => null]);
    }
}
