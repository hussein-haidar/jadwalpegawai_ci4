<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pegawai_laporan_mingguan;
use App\Models\M_pegawai_jadwal;

class Pegawai_laporan_mingguan extends BaseController
{
    protected $M_pegawai_laporan_mingguan;

    public function __construct()
    {
        $this->M_pegawai_laporan_mingguan = new M_pegawai_laporan_mingguan();
    }

    public function index()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        if ($start_date && $end_date) {
            $data_laporan_pegawai = $this->M_pegawai_laporan_mingguan->get_laporan_by_date_range($start_date, $end_date);
        } else {
            $data_laporan_pegawai = $this->M_pegawai_laporan_mingguan->get_all_jadwal();
            $start_date = '';
            $end_date = '';
        }

        $data = [
            'title' => 'Daftar Laporan Jadwal Kegiatan',
            'title2' => 'Data Laporan Kegiatan Pegawai',
            'data_laporan_pegawai' => $data_laporan_pegawai,
            'start_date' => $start_date,
            'end_date' => $end_date,
           'isi' => 'sekretaris/laporan_admin_mingguan/v_laporan_admin',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function filter_by_date()
    {
        if ($this->request->getMethod() === 'post') {
            $start_date = $this->request->getPost('start_date');
            $end_date = $this->request->getPost('end_date');

            return redirect()->to(base_url('pegawai_laporan_mingguan?start_date=' . $start_date . '&end_date=' . $end_date));
        }

        return redirect()->to('/pegawai_laporan_mingguan');
    }

    public function cetak_laporan()
    {
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        $data = [
            'title3' => 'Cetak Laporan Kegiatan Pegawai',
            'data_laporan_pegawai' => $this->M_pegawai_laporan_mingguan->get_laporan_by_date_range($start_date, $end_date),
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];

        // Menambahkan pengalihan setelah cetak
        return view('sekretaris/laporan_admin_mingguan/v_cetak_laporan_admin', $data);
    }

    public function reset_filter()
    {
        // Mengarahkan ulang ke halaman utama laporan
        return redirect()->to(base_url('pegawai_laporan_mingguan'));
    }
}
