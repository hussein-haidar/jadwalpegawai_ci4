<?php

namespace App\Models;

use CodeIgniter\Model;

class M_auth_login extends Model
{
    protected $table = 'tbl_data_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'id_user',
        'username',
        'password',
        'nama_lengkap',
        'jobdesk',
        'notelpon',
        'level',
        'id_unit',
        'last_login',
        'foto_user',
    ];

    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    public function updateLastLogin($userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }

}
