       <!-- Pop up alert berhasil -->
       <?php
        if (session()->getFlashdata('pesan')) {
          echo '<div class="alert alert-success" role="alert">';
          echo session()->getFlashdata('pesan');
          echo '</div>';
        }
        ?>
       </p>
       <!-- Pop up alert peringatan -->
       <?php
        // Tampilkan alert warning hanya jika tidak ada pesan sukses
        if (session()->getFlashdata('message') && !session()->getFlashdata('pesan')) {
          echo '<div class="alert alert-warning" role="alert">';
          echo session()->getFlashdata('message');
          echo '</div>';
        }
        ?>
       </br>
       <!-- Run text -->
       <div class="card-body">
         <marquee style="font-family:arial; font-size:30px; color:#000000;">Selamat Datang Di <?= $title ?></marquee>
       </div>
       </br>
       <div class="row">
         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-green">
             <div class="inner">
               <h3><?= $tot_unit ?></h3>
               <p>Data Unit Kerja</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
           </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-yellow">
             <div class="inner">
               <h3><?= count($tot_dinas_unit) ?></h3>
               <p>Data Dinas Pegawai </p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
           </div>
         </div>
         <!-- ./col -->

         <!-- Small boxes (Stat box) -->
         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-red">
             <div class="inner">
               <h3><?= count($tot_jadwal_tolak) ?></h3>
               <p>Data Jadwal Kegiatan Tolak</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
           </div>
         </div>
         <!-- ./col -->

         <div class="row">
           <div class="col-lg-3 col-xs-6">
             <!-- small box -->
             <div class="small-box bg-aqua">
               <div class="inner">
                 <h3><?= count($tot_jadwal_sukses) ?></h3>
                 <p>Data Jadwal Kegiatan Selesai</p>
               </div>
               <div class="icon">
                 <i class="ion ion-stats-bars"></i>
               </div>
             </div>
           </div>
           <!-- ./col -->

         </div>
         <!-- /.row -->

         <!-- /.row -->
       </div>