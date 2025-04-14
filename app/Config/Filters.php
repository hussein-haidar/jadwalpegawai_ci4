<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'filter_satpam' => \App\Filters\Filter_satpam::class,
        'filter_sekretaris' => \App\Filters\Filter_sekretaris::class,
        'filter_pegawai' => \App\Filters\Filter_pegawai::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filter_satpam' => ['except' => ['auth', 'auth/*']],
            'filter_sekretaris' => ['except' => ['auth', 'auth/*']],
            'filter_pegawai' => ['except' => ['auth', 'auth/*']],
            //'honeypot',
            //'csrf',
        ],
        'after'  => [
            'filter_satpam' => ['except' => [
                'Home_satpam',
                'Home_satpam/*',
                'update_profile',
                'update_profile/*',
                'satpam_kelola_data',
                'satpam_kelola_data/*',
            ]],

            'filter_sekretaris' => ['except' => [
                'home_sekretaris',
                'home_sekretaris/*',
                'update_profile',
                'update_profile/*',
                'sekretaris_kelola_unit',
                'sekretaris_kelola_unit/*',
                'sekretaris_acc_jadwal',
                'sekretaris_acc_jadwal/*',
                'pegawai_kelola_data',
                'pegawai_kelola_data/*',
                'pegawai_laporan_bulanan',
                'pegawai_laporan_bulanan/*',
                'pegawai_laporan_mingguan',
                'pegawai_laporan_mingguan/*',
                'sekretaris_kelola_user',
                'sekretaris_kelola_user/*',

                //'toolbar',
                //'honeypot',
            ]],

            'filter_pegawai' => ['except' => [
                'Home_pegawai',
                'Home_pegawai/*',
                'update_profile',
                'update_profile/*',
                'pegawai_kelola_data',
                'pegawai_kelola_data/*',
                'kacab_view_jadwal',
                'kacab_view_jadwal/*',
            ]],



        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
