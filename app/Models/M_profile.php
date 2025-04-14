<?php

namespace App\Models;

use CodeIgniter\Model;

class M_profile extends Model
{
    protected $table = 'tbl_data_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'notelpon', 'jobdesk', 'level', 'id_unit','foto_user'];

    public function get_profile()
    {
        return $this->db->table($this->table)
            ->select('tbl_data_user.*, tbl_unit_kerja.nama_unit')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_data_user.id_unit', 'left')
            ->get()->getResultArray();
    }

    public function detailProfile($id_user)
    {
        return $this->db->table($this->table)
            ->select('tbl_data_user.*, tbl_unit_kerja.nama_unit')
            ->join('tbl_unit_kerja', 'tbl_unit_kerja.id_unit = tbl_data_user.id_unit', 'left')
            ->where($this->primaryKey, $id_user)
            ->get()->getRowArray();
    }

    public function edit($id_user, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where($this->primaryKey, $id_user);
        $result = $builder->update($data);
    
        if (!$result) {
            log_message('error', 'Error saat mengupdate data pengguna: ' . $this->db->error()['message']);
            return false;
        }
    
        return true;
    }
}
