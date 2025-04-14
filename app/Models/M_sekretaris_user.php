<?php

namespace App\Models;

use CodeIgniter\Model;

class M_sekretaris_user extends Model
{
    protected $table = 'tbl_data_user'; // Adjust the table name accordingly
    protected $primaryKey = 'id_user'; // Adjust the primary key if necessary
    protected $allowedFields = ['username','password','nama_lengkap',
        'nama_title','notelpon','jobdesk','level', 'id_unit', 'last_login' // Add other fields that are allowed
];

    public function get_user()
    {
        return $this->db->table($this->table)
            ->select('tbl_data_user.*, tbl_unit_kerja.nama_unit')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_data_user.id_unit', 'left')
            ->get()->getResultArray();
    }

    public function detailUser($id_user)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_data_user')
        ->insert($data);
    }

    public function edit($data)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $data['id_user'])
            ->delete($data);
    }

    public function all_unit()
    {
        return $this->db->table('tbl_unit_kerja')
        ->where('deleted_at', 0) // Filter hanya data yang belum dihapus
        ->get()
        ->getResultArray();
    }

}
