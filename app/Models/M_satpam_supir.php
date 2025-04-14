<?php

namespace App\Models;

use CodeIgniter\Model;

class M_satpam_supir extends Model
{
    protected $table = 'tbl_data_supir'; // Nama tabel
    protected $primaryKey = 'id_supir'; // Primary key
    protected $allowedFields = ['nama_supir', 'notelpon_supir', 'alamat_supir', 'stok_supir', 'status_kendaraan','foto_supir','deleted_at'];

    public function get_data()
    {
        return $this->db->table('tbl_data_supir')
            ->where('deleted_at', 0) // Hanya ambil data yang belum dihapus
            ->get()->getResultArray();
    }

    public function get_supir_dihapus()
    {
        return $this->db->table('tbl_data_supir')
            ->where('deleted_at', 1) // Hanya ambil data yang sudah dihapus
            ->get()->getResultArray();
    }

    public function detailSupir($id_supir)
    {
        return $this->db->table('tbl_data_supir')
            ->where('id_supir', $id_supir)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_data_supir')
            ->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_data_supir')
            ->where('id_supir', $data['id_supir'])
            ->update($data);
    }

    public function delete_data($id_supir)
    {
        return $this->db->table('tbl_data_supir')
            ->where('id_supir', $id_supir)
            ->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function restore($id_supir)
    {
        return $this->db->table('tbl_data_supir')
            ->where('id_supir', $id_supir)
            ->update(['deleted_at' => null]);
    }
}
