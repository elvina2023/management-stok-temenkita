<?php

include 'includes/connect.php';

if (empty($session_login))
    header('location: login.php');
  
// submit to database
if (isset($_POST['add-supplier'])){

  $nama_supplier  = $_POST['nama-supplier'];
  $telp_supplier = $_POST['telp-supplier'];
  $alamat_supplier = $_POST['alamat-supplier'];
  $deskripsi_supplier = $_POST['deskripsi-supplier'];
  $tanggal = $_POST['tanggal'];

  if ($stok->cek_nama_supplier($nama_supplier)){
    $msg = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">Nama Supplier sudah terdaftar, silahkan gunakan nama yang lain.</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
  }
  else{
    $insert_data = $stok->insert_supplier([
      $_SESSION['login'],
      $nama_supplier,
      $telp_supplier,
      $alamat_supplier,
      $deskripsi_supplier,
      $tanggal
    ]);

      // $msg = 'berhasil_ditambahkan';
      // header('location: supplier.php?msg=data_ditambahkan');
    if($insert_data){
      $msg = '<div class="row alert alert-success alert-dismissable">
      <div class="col-11">Data berhasil ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
    }
    else{
      $msg = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">Data gagal ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
    }
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temenkita</title>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- nav -->
    <?php include("includes/navbar.php")?>
    <!-- end nav -->
    <h2>Data Supplier</h2>
    <!--  container-fluid -->
    <div class="container-fluid">
        <button style="width:100px;float:right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#supplier-modal" >Add Supplier</button>
        <br><br><br>
        <!-- table -->
        <table class="table table-bordered table-light border-primary">
                <?=isset($msg) ? $msg : ''?>

                <caption>List of Suppliers</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Supplier</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th style="width: 150px;">Tgl</th>
                            <th style="width: 100px;">Edit/Hapus</th>
                        </tr>
                    </thead>
                    <?php
                      $check_data = "SELECT * FROM `d_supplier` ORDER BY id ASC";
                      $check_data = $connect->prepare($check_data);
                      $check_data->execute(); 
                      
                      
                      if ($check_data->rowCount() == 0): ?>    

                      <p>Tidak ada data supplier.</p>

                      <?php else: ?>

                    <tbody>
                        <!-- fetch php from database by ajax -->
                        <?php
                        foreach($stok->tampil_data_supplier()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                        
                        <tr>
                          <td><?=$data['id']?></td>
                          <td><?=$data['nama_supplier']?></td>
                          <td><?=$data['telp_supplier']?></td>
                          <td><?=$data['alamat_supplier']?></td>
                          <td><?=$data['deskripsi_supplier']?></td>
                          <td><?=$data['tanggal']?></td>
                          <td><a href="edit_sup.php?id=<?=$data['id']?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="hapus_sup.php?id=<?=$data['id']?>"  class="btn btn-danger btn-sm">Hapus</a></td>
                        </tr>

                        <?php endforeach ?>
                      
                    </tbody>
                    <?php endif ?>
        </table>
        <!-- end table -->
    </div>
    <!-- end container-fluid -->
<!-- modal -->
<div class="modal fade" id="supplier-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data supplier baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
          <form method="post">

            <p>Nama Supplier</p>
            <input type="text" class="form-control form-control-lg" name="nama-supplier"> <br />

            <p>No Telp</p>
            <input type="text" class="form-control" name="telp-supplier"> <br />

            <p>Alamat</p>
            <input type="text" class="form-control" name="alamat-supplier"> <br />

            <p>Deskripsi</p>
            <input type="text" class="form-control" name="deskripsi-supplier"> <br />
            
            <p>Tanggal</p>
            <input type="date" name="tanggal" id="" class="form-control"><br />
            
            <div class="d-grid gap-2">
              <button class="btn btn-dark btn-lg" name="add-supplier">Add</button>
            </div>
          </form>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- end modal -->
</body>

</html>