<?php

namespace App\Controllers;

use App\Models\M_home_sekretaris;

class Home_sekretaris extends BaseController
{
    protected $M_home_sekretaris;
    
    public function __construct()
    {
        $this->M_home_sekretaris = new M_home_sekretaris();
    }
    public function index()
    {
        $user = session()->get();
        $title = "Dashboard " . ($user['nama_title']);
        $title3 = "Wellcome";
        
        $data=[
            'title' => $title,
            'title2' => 'Index',
            'title3' => $title3,
            'tot_unit' => $this->M_home_sekretaris->tot_unit(),
            'tot_jadwal_sukses' => $this->M_home_sekretaris->tot_jadwal_sukses(),
            'tot_dinas_unit' => $this->M_home_sekretaris->tot_dinas_by_unit(),
            'tot_jadwal_tolak' => $this->M_home_sekretaris->tot_jadwal_tolak(),
            'isi' =>'v_home_sekretaris',
        ];
        return view('layout/v_wrapper', $data);
    }
}
