 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <!-- <h1 class="m-0"> Data Kendaraan Dinas <small>NAVARA</small></h1> -->
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <div class="content">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <?php if ($kend != '') : ?>
                 <div class="card">
                     <div class="card-header" style="background-color:#4a2f3a;">
                         <h3 style="font-weight:bold;color:white;">Data Kendaraan Dinas Anda</h3>
                     </div>
                     <div class="card-body">
                         <table class="table table-striped">
                             <tr>
                                 <th width="30%">ID Aset</th>
                                 <th>:</th>
                                 <th><?= $kend['id_assets'] ?></th>
                             </tr>
                             <tr>
                                 <th>No. Polisi</th>
                                 <th>:</th>
                                 <th><?= strtoupper($kend['no_polisi']) ?></th>
                             </tr>
                             <tr>
                                 <th>Jenis</th>
                                 <th>:</th>
                                 <th><?= strtoupper($kend['jenis']) ?></th>
                             </tr>
                             <tr>
                                 <th>Merk</th>
                                 <th>:</th>
                                 <th><?= strtoupper($kend['merk']) ?></th>
                             </tr>
                             <tr>
                                 <th>Tipe</th>
                                 <th>:</th>
                                 <th><?= strtoupper($kend['tipe']) ?></th>
                             </tr>
                             <tr>
                                 <th>Bahan Bakar</th>
                                 <th>:</th>
                                 <th><?= strtoupper($kend['jenis_bb']) ?></th>
                             </tr>
                             <tr>
                                 <th>Masa Berlaku STNK</th>
                                 <th>:</th>
                                 <th><?= date('d-m-Y', strtotime($kend['masa_berlaku_stnk'])) ?></th>
                             </tr>
                         </table>
                     </div>
                     <div class="card-footer">
                         <a href="<?= site_url('pemakai/riwayatkondisi?id=' . $kend['idk'] . '') ?>"
                             class="btn btn-primary">Riwayat Kondisi</a>
                         <a href="<?= site_url('pemakai/riwayatservis?id=' . $kend['idk'] . '') ?>"
                             class="btn btn-warning">Riwayat Servis</a>
                         <a href="<?= site_url('pemakai/riwayatbbm?id=' . $kend['idk'] . '') ?>"
                             class="btn btn-secondary">Riwayat BBM</a>
                         <a href="<?= site_url('pemakai/riwayatpajak?id=' . $kend['idk'] . '') ?>"
                             class="btn btn-danger">Riwayat Pajak</a>
                         <a href="#" class="btn btn-success" onClick="alert('Coming Soon')">Form Pengajuan</a>
                     </div>
                 </div>
                 <?php else : ?>
                 <div class="card">
                     <div class="card-header" style="background-color:#4a2f3a;">
                         <h3 style="font-weight:bold;color:white;">Data Kendaraan Dinas Anda</h3>
                     </div>
                     <div class="card-body">
                         <h5 class="text-center">Anda Belum Memiliki Kendaraan Aktif</h5>
                     </div>
                     <div class="card-footer">
                     </div>
                 </div>
                 <?php endif ?>
             </div>
         </div>
         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->

 <div class="modal fade" id="modal-xl">
     <div class="modal-dialog modal-xl">
         <form method="post" action="<?= site_url('home/prosestambahkondisi?id=' . $kend['idk'] . '') ?>"
             enctype="multipart/form-data">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Form Riwayat Kondisi</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Foto Tampak Depan</label>
                                 <input type="file" class="form-control" name="depan" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Foto Tampak Belakang</label>
                                 <input type="file" class="form-control" name="blkg" required>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Foto Tampak Kiri</label>
                                 <input type="file" class="form-control" name="kiri" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Foto Tampak Kanan</label>
                                 <input type="file" class="form-control" name="kanan" required>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="sumbit" class="btn btn-primary">Simpan</button>

                 </div>
         </form>
     </div>
     <!-- /.modal-content -->
 </div>
 <!-- /.modal-dialog -->
 </div>