<?php

namespace App\Controllers;

use App\Models\M_pegawai_jadwal;

class Home_pegawai extends BaseController
{
    protected $M_pegawai_jadwal;


    public function __construct()
    {
        $this->M_pegawai_jadwal = new M_pegawai_jadwal();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Jadwal Pegawai',
            'title2' => 'Data Jadwal',
            'data_jadwal' => $this->M_pegawai_jadwal->get_jadwal(),
        ];
        return view('v_home_pegawai', $data);
    }
    public function view_dokumen($id_pegawai)
    {
        $data = [
            'title' => 'View Dokumen Pegawai',
            'title2' => 'Data Dokumen',
            'data_jadwal' => $this->M_pegawai_jadwal->detailJadwal($id_pegawai),
            'isi' => 'pegawai/data_pegawai/v_dokumen',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function view_foto($id_pegawai)
    {
        $data = [
            'title' => 'View Foto Pegawai',
            'title2' => 'Data Foto',
            'data_jadwal' => $this->M_pegawai_jadwal->detailJadwal($id_pegawai),
            'isi' => 'pegawai/data_pegawai/v_foto',
        ];
        return view('layout/v_wrapper', $data);
    }
}
