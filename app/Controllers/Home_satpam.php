<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_home_satpam;

class Home_satpam extends BaseController
{
    protected $M_home_satpam;

    public function __construct()
    {
        $this->M_home_satpam = new M_home_satpam();
    }

    public function index()
    {
        $user = session()->get();
        $title = "Dashboard " . ($user['nama_title']);
        $title3 = "Wellcome";

        $data = [
            'title' => $title,
            'title2' => 'Index',
            'title3' => $title3,
            'tot_supir_keluar' => $this->M_home_satpam->tot_supir_keluar(),
            'tot_supir_masuk' => $this->M_home_satpam->tot_supir_masuk(),
            'tot_kendaraan_masuk' => $this->M_home_satpam->tot_kendaraan_masuk(),
            'tot_kendaraan_keluar' => $this->M_home_satpam->tot_kendaraan_keluar(),
            'isi' => 'v_home_satpam',
        ];
        return view('layout/v_wrapper', $data);
    }

}
