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
                 <div class="card">
                     <div class="card-header" style="background-color:#4a2f3a;">
                         <h3 style="font-weight:bold;color:white;">Data Kendaraan Dinas</h3>
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
                                 <th>CC</th>
                                 <th>:</th>
                                 <th><?php if ($kend['besar_cc'] == '') :  ?> -
                                     <?php else : ?><?= strtoupper($kend['besar_cc']) ?> CC <?php endif ?></th>
                             </tr>
                             <tr>
                                 <th>Bahan Bakar</th>
                                 <th>:</th>
                                 <th><?= strtoupper($kend['jenis_bb']) ?></th>
                             </tr>
                             <tr>
                                 <th>Pagu Kendaraan Tahun <?= date('Y') ?></th>
                                 <th>:</th>
                                 <th>Rp. <?= number_format($kend['pagu_awal'], 2, ',', '.') ?></th>
                             </tr>
                             <?php
                                $terpakai = $kend['total_biaya_pajak'] + $kend['total_biaya_servis'] + $kend['total_biaya_bbm'];
                                $sisa = $kend['pagu_awal'] - $terpakai; ?>
                             <tr>
                                 <th>Pagu Terpakai</th>
                                 <th>:</th>
                                 <th>Rp. <?= number_format($terpakai, 2, ',', '.') ?></th>
                             </tr>
                             <tr>
                                 <th>Sisa Pagu</th>
                                 <th>:</th>
                                 <th>Rp. <?= number_format($sisa, 2, ',', '.') ?></th>
                             </tr>
                         </table>
                     </div>
                 </div>
             </div>
             <div class="col-lg-12">
                 <div class="card">
                     <div class="card-header" style="background-color:#4a2f3a;">
                         <h3 style="font-weight:bold;color:white;"><?= $title ?></h3>
                     </div>
                     <div class="card-header">
                         <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                             data-target="#modalTambah">
                             Tambah Riwayat Servis
                         </button>
                     </div>
                     <div class="card-body">
                         <table class="table table-bordered table-striped example" width="100%" height="auto">
                             <thead>
                                 <tr>
                                     <th class="text-center">No</th>
                                     <th class="text-center" width="5%">Aksi</th>
                                     <th class="text-center">Tgl Service</th>
                                     <th class="text-center">Bengkel Service</th>
                                     <th class="text-center">Keluhan</th>
                                     <th class="text-center">Perbaikan</th>
                                     <th class="text-center">Lain-Lain</th>
                                     <th class="text-center">Total Biaya</th>
                                     <th class="text-center">Foto Service</th>
                                     <th class="text-center">Foto Nota</th>
                                     <th class="text-center">Status</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    if ($rs != '') :
                                        $no = 1;
                                        foreach ($rs as $value) : ?>
                                 <tr>
                                     <td class="text-center"><?= $no; ?></td>
                                     <td class="text-center">
                                         <?php if ($value['status_srs'] == 'Wait') : ?>
                                         <a onclick="editConfirm('#')" href="#"
                                             class="btn btn-sm btn-warning jedatombol disabled"><i class="fas fa-pen"
                                                 title="Edit Riwayat Servis <?= $kend['no_polisi'] ?>"></i></a>
                                         <?php elseif ($value['status_srs'] == 'Yes') : ?>
                                         <a onclick="editConfirm('#')" href="#"
                                             class="btn btn-sm btn-warning jedatombol disabled"><i class="fas fa-pen"
                                                 title="Edit Riwayat Servis <?= $kend['no_polisi'] ?>"></i></a>
                                         <?php else : ?>
                                         <a style="display: none" onclick="deleteConfirm('#')" href="#"
                                             class="btn btn-sm btn-danger jedatombol disabled"><i class="fas fa-trash"
                                                 title="Hapus Riwayat Servis <?= $kend['no_polisi'] ?>"></i></a>
                                         <a onclick="editConfirm('<?= site_url('pemakai/editriwayatservis?id=' . $value['id_rs'] . '&idkend=' . $value['id_kendaraan']) ?>')"
                                             href="#" class="btn btn-warning btn-sm jedatombol"
                                             title="Edit Riwayat Servis <?= $kend['no_polisi'] ?>"><i
                                                 class="fas fa-pen"></i></a>
                                         <?php endif ?>
                                     </td>
                                     <td class="text-center"><?= date('d-m-Y', strtotime($value['tgl_servis'])) ?></td>
                                     <td class="text-center"><?= $value['lokasi'] ?></td>
                                     <td><?= $value['keluhan'] ?></td>
                                     <td><?= $value['perbaikan'] ?></td>
                                     <td><?= $value['lain_lain'] ?></td>
                                     <td class="text-left">
                                         <?= "Rp. " . number_format($value['total_biaya'], 2, ',', '.'); ?></td>
                                     <td class="text-center">
                                         <img width="100%"
                                             src="<?= base_url('assets/upload/foto_servis/' . $value['foto_servis'] . '') ?>"
                                             data-toggle="modal" data-target="#servisModal<?php echo $no ?>">
                                     </td>
                                     <td class="text-center"><img width="100%"
                                             src="<?= base_url('assets/upload/foto_nota/' . $value['foto_nota'] . '') ?>"
                                             data-toggle="modal" data-target="#notaModal<?php echo $no ?>">
                                     </td>
                                     <td class="text-center" width="10%">
                                         <?php if ($value['status_srs'] == 'Wait') : ?>
                                         <p>Sedang Diverifikasi</p>
                                         <?php elseif ($value['status_srs'] == 'No') : ?>
                                         Ditolak<br><i style="color:red;font-size:12px">
                                             <?= $value['reject_reason'] ?>.
                                             Silakan melakukan input/edit data kembali.<br>Reject on
                                             <?= date('d-m-Y H:i:s', strtotime($value['datetime_approve'])) ?></i>
                                         <?php else : ?>
                                         Disetujui
                                         <br><i style="color:green;font-size:12px">Approved on
                                             <?= date('d-m-Y H:i:s', strtotime($value['datetime_approve'])) ?></i>
                                         <?php endif ?>
                                     </td>
                                 </tr>
                                 <?php $no++;
                                        endforeach;
                                    endif; ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->

 <!-- Modal Foto Servis & Nota -->
 <?php
    if ($rs != '') :
        $no = 1;
        foreach ($rs as $value) : ?>
 <center>
     <!-- Modal -->
     <div class="modal fade" id="servisModal<?php echo $no ?>" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                             aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <center>
                         <img src="<?= base_url('assets/upload/foto_servis/' . $value['foto_servis'] . '') ?>"
                             alt="Foto Servis" class="img-responsive" width="70%" height="auto">
                     </center>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal fade" id="notaModal<?php echo $no ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                             aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <center>
                         <img src="<?= base_url('assets/upload/foto_nota/' . $value['foto_nota'] . '') ?>"
                             alt="Foto Nota" class="img-responsive" width="70%" height="auto">
                     </center>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
 </center>
 <?php $no++;
        endforeach;
    endif ?>

 <!-- Modal Input -->
 <div class="modal fade" id="modalTambah" role="dialog">
     <div class="modal-dialog modal-xl">
         <form method="post" action="<?= site_url('pemakai/prosestambahservis?id=' . $kend['idk'] . '') ?>"
             enctype="multipart/form-data">
             <?php
                echo form_hidden('tipe', $kend['tipe']);
                echo form_hidden('no_pol', $kend['no_polisi']);
                ?>
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title">Form Riwayat Servis</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Tanggal Service</label>
                                 <input type="text" class="form-control pilihtanggal" name="tgl"
                                     placeholder="Tanggal Servis" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Nama Bengkel Service</label>
                                 <input type="text" class="form-control" name="bengkel" placeholder="Nama Bengkel"
                                     required>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Keluhan</label>
                                 <textarea class="form-control" name="keluhan" placeholder="Keluhan Kendaraan"
                                     required></textarea>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Perbaikan</label>
                                 <textarea class="form-control" name="perbaikan" placeholder="Perbaikan Kendaraan"
                                     required></textarea>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Lain Lain</label>
                                 <textarea class="form-control" name="lain_lain"
                                     placeholder="Tambahan/Lain-Lain"></textarea>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Total Biaya</label>
                                 <input type="number" class="form-control" name="biaya" placeholder="Total Biaya"
                                     required>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Foto Nota</label>
                                 <input type="file" class="form-control" name="nota" accept="image/*" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Foto Service</label>
                                 <input type="file" class="form-control" name="foto" accept="image/*" required>
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
 </div>