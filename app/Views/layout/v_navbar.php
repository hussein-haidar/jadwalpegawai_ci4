 <!-- Left side column. contains the sidebar -->
 <aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="<?= base_url('fotouser/' . session()->get('foto_user')) ?>" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p><?= session()->get('nama_lengkap') ?></p>
         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
       </div>
     </div>

     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">MAIN NAVIGATION</li>
         <li>
           <a href="<?= base_url('home_sekretaris/index') ?>">
             <i class="fa fa-dashboard"></i> <span>Dashboard</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 2) { ?>
         <li class="header">MAIN NAVIGATION</li>
         <li>
           <a href="<?= base_url('home_pegawai/index') ?>">
             <i class="fa fa-dashboard"></i> <span>Dashboard</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 3) { ?>
         <li class="header">MAIN NAVIGATION</li>
         <li>
           <a href="<?= base_url('home_satpam/index') ?>">
             <i class="fa fa-dashboard"></i> <span>Dashboard</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 2) { ?>
         <li class="header">LIST SCHEDULE </li>
         <li>
           <a href="<?= base_url('kacab_view_jadwal/index') ?>">
             <i class="fa fa-folder"></i> <span>Daftar View Jadwal</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">WORK UNIT</li>
         <li>
           <a href="<?= base_url('sekretaris_kelola_unit/index') ?>">
             <i class="fa fa-folder"></i> <span>Data Unit Kerja</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">LIST SCHEDULE</li>
         <li>
           <a href="<?= base_url('pegawai_kelola_data/data_jadwal') ?>">
             <i class="fa fa-folder"></i> <span>Data Jadwal Pegawai</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 2) { ?>
         <li class="header">LIST SCHEDULE</li>
         <li>
           <a href="<?= base_url('pegawai_kelola_data/data_jadwal') ?>">
             <i class="fa fa-folder"></i> <span>Data Jadwal Pegawai</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">LIST ALL SCHEDULE</li>
         <li>
           <a href="<?= base_url('sekretaris_acc_jadwal/view_jadwal') ?>">
             <i class="fa fa-folder"></i> <span>Daftar Semua Jadwal</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 3) { ?>
         <li class="header">LIST VEHICLE</li>
         <li>
           <a href="<?= base_url('satpam_kelola_data/data_kendaraan') ?>">
             <i class="fa fa-folder"></i> <span>Data Kendaraan</span>
           </a>
         </li>

         <li class="header">LIST DRIVER</li>
         <li>
           <a href="<?= base_url('satpam_kelola_data/data_supir') ?>">
             <i class="fa fa-folder"></i> <span>Data Supir</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">LIST OFICIAL TRAVEL</li>
         <li>
           <a href="<?= base_url('pegawai_kelola_data/data_dinas') ?>">
             <i class="fa fa-folder"></i> <span>Data Perjalanan Dinas</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 2) { ?>
         <li class="header">LIST OFICIAL TRAVEL</li>
         <li>
           <a href="<?= base_url('pegawai_kelola_data/data_dinas') ?>">
             <i class="fa fa-folder"></i> <span>Data Perjalanan Dinas</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">REPORT NAVIGATION</li>
         <li class="treeview">
           <a href="#">
             <i class="fa fa-folder"></i>
             <span>Laporan Jadwal Pegawai</span>
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">
             <li><a href="<?= base_url('pegawai_laporan_mingguan/index') ?>"><i class="fa fa-circle-o"></i>Laporan Jadwal Mingguan</a></li>
             <li><a href="<?= base_url('pegawai_laporan_bulanan/index') ?>"><i class="fa fa-circle-o"></i>Laporan Jadwal Bulanan</a></li>
           </ul>
         </li>

         <li class="header">USERS NAVIGATION</li>
         <li>
           <a href="<?= base_url('sekretaris_kelola_user/index') ?>">
             <i class="fa fa-users"></i> <span>Pengguna Sistem</span>
           </a>
         </li>
       <?php } ?>

       <?php if (session()->get('level') == 1) { ?>
         <li class="header">BACKUP DB</li>
         <li>
           <a href="<?= base_url('sekretaris_kelola_unit/backup_db') ?>">
             <i class="fa fa-folder"></i> <span>Backup DB</span>
           </a>
         </li>
       <?php } ?>

     </ul>
   </section>
   <!-- /.sidebar -->
 </aside>

 <!-- =============================================== -->