<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pegawai_laporan_bulanan;

class Pegawai_laporan_bulanan extends BaseController
{
    protected $M_pegawai_laporan_bulanan;

    public function __construct()
    {
        $this->M_pegawai_laporan_bulanan = new M_pegawai_laporan_bulanan();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Laporan Jadwal Kegiatan',
            'title2' => 'Data Laporan Kegiatan Pegawai',
            'data_laporan_pegawai' => $this->M_pegawai_laporan_bulanan->get_all_jadwal(),
            'start_month' => null,
            'end_month' => null,
            'isi' => 'sekretaris/laporan_admin_bulanan/v_laporan_admin',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function filter_by_month()
    {
        if ($this->request->getMethod() === 'post') {
            $start_month = $this->request->getPost('start_month');
            $end_month = $this->request->getPost('end_month');

            return redirect()->to(base_url("pegawai_laporan_bulanan/filter_by_month?start_month=$start_month&end_month=$end_month"));
        }

        $start_month = $this->request->getGet('start_month') ?? null;
        $end_month = $this->request->getGet('end_month') ?? null;

        if ($start_month && $end_month) {
            $data_laporan_pegawai = $this->M_pegawai_laporan_bulanan->get_laporan_by_month_range($start_month, $end_month);
        } else {
            $data_laporan_pegawai = $this->M_pegawai_laporan_bulanan->get_all_jadwal();
        }

        $data = [
            'title' => 'Daftar Laporan Jadwal Kegiatan',
            'title2' => 'Data Laporan Kegiatan Pegawai',
            'data_laporan_pegawai' => $data_laporan_pegawai,
            'start_month' => $start_month,
            'end_month' => $end_month,
            'isi' => 'sekretaris/laporan_admin_bulanan/v_laporan_admin',
        ];

        return view('layout/v_wrapper', $data);
    }

    public function cetak_laporan()
    {
        $start_month = $this->request->getGet('start_month');
        $end_month = $this->request->getGet('end_month');

        if ($start_month && $end_month) {
            $data_laporan_pegawai = $this->M_pegawai_laporan_bulanan->get_laporan_by_month_range($start_month, $end_month);
        } else {
            $data_laporan_pegawai = $this->M_pegawai_laporan_bulanan->get_all_jadwal();
        }

        $data = [
            'title3' => 'Cetak Laporan Kegiatan Pegawai',
            'data_laporan_pegawai' => $data_laporan_pegawai,
            'start_month' => $start_month,
            'end_month' => $end_month,
        ];

        return view('sekretaris/laporan_admin_bulanan/v_cetak_laporan_admin', $data);
    }

    public function reset_filter()
    {
        // Mengarahkan ulang ke halaman utama laporan
        return redirect()->to(base_url('pegawai_laporan_bulanan'));
    }
}
