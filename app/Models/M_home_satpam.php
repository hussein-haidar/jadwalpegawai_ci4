<?php

namespace App\Models;

use CodeIgniter\Model;

class M_home_satpam extends Model
{
    public function tot_supir_masuk()
    {
        return $this->db->table('tbl_data_supir')
        ->select('id_supir') // Ambil hanya kolom yang dibutuhkan
        ->where('status_supir', '1') // Sesuaikan dengan kondisi di tabel
            ->get()
            ->getResultArray();
    }

    public function tot_supir_keluar()
    {
        return $this->db->table('tbl_data_supir')
        ->select('id_supir') // Ambil hanya kolom yang dibutuhkan
        ->where('status_supir', '2') // Sesuaikan dengan kondisi di tabel
            ->get()
            ->getResultArray();
    }

    public function tot_kendaraan_masuk()
    {
        return $this->db->table('tbl_data_kendaraan')
        ->select('id_kendaraan') // Ambil hanya kolom yang dibutuhkan
        ->where('status_kendaraan', '1') // Sesuaikan dengan kondisi di tabel
        ->get()
            ->getResultArray();
    }

    public function tot_kendaraan_keluar()
    {
        return $this->db->table('tbl_data_kendaraan')
        ->select('id_kendaraan') // Ambil hanya kolom yang dibutuhkan
        ->where('status_kendaraan', '2') // Sesuaikan dengan kondisi di tabel
            ->get()
            ->getResultArray();
    }
}
