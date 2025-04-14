<?php

namespace App\Models;

use CodeIgniter\Model;

class M_sekretaris_unit extends Model
{
    protected $table = 'tbl_unit_kerja'; // Nama tabel
    protected $primaryKey = 'id_unit'; // Primary key
    protected $allowedFields = ['nama_unit', 'deleted_at'];

    public function get_unit()
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('deleted_at', 0) // Hanya ambil data yang belum dihapus
            ->get()->getResultArray();
    }

    public function get_unit_dihapus()
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('deleted_at', 1) // Hanya ambil data yang sudah dihapus
            ->get()->getResultArray();
    }

    public function detailUnit($id_unit)
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('id_unit', $id_unit)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_unit_kerja')
            ->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_unit_kerja')
            ->where('id_unit', $data['id_unit'])
            ->update($data);
    }

    public function delete_data($id_unit)
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('id_unit', $id_unit)
            ->update(['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function restore($id_unit)
    {
        return $this->db->table('tbl_unit_kerja')
            ->where('id_unit', $id_unit)
            ->update(['deleted_at' => null]);
    }
}
