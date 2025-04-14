<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_kacab_jadwal;

class Kacab_view_jadwal extends BaseController
{
    protected $M_kacab_jadwal;

    public function __construct()
    {
        $this->M_kacab_jadwal = new M_kacab_jadwal();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Jadwal Pegawai',
            'title2' => 'Data Jadwal',
            'data_jadwal' => $this->M_kacab_jadwal->get_jadwal(),
            'isi' => 'kacab/data_pegawai/v_pegawai',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_dokumen($id_pegawai)
    {
        $data = [
            'title' => 'View Dokumen Pegawai',
            'title2' => 'Data Dokumen',
            'data_jadwal' => $this->M_kacab_jadwal->detailJadwal($id_pegawai),
            'isi' => 'kacab/data_pegawai/v_dokumen',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_foto($id_pegawai)
    {
        $data = [
            'title' => 'View Foto Pegawai',
            'title2' => 'Data Foto',
            'data_jadwal' => $this->M_kacab_jadwal->detailJadwal($id_pegawai),
            'isi' => 'kacab/data_pegawai/v_foto',
        ];
        return view('layout/v_wrapper', $data);
    }
}