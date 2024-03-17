
<?php

include 'includes/connect.php';

if (empty($session_login))
    header('location: login.php');


// submit to database
// php add kategori
if (isset($_POST['add-kategori'])) {

  $nama_kategori = $_POST['nama-kategori'];

  if ($stok->cek_nama_kategori($nama_kategori)) {
      $msg = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">Nama kategori sudah terdaftar, silahkan gunakan nama yang lain.</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
  } else {
      $insert_data = $stok->insert_kategori([
          $_SESSION['login'],
          $nama_kategori
      ]);

      if ($insert_data) {
          $msg = '<div class="row alert alert-success alert-dismissable">
      <div class="col-11">Data berhasil ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
      } else {
          $msg = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">Data gagal ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
      }
  }
}
// end php add kategori
// php add barang
if (isset($_POST['add-barang'])) {

  $nama_barang = $_POST['nama-barang'];
  $id_kategori = $_POST['nama-kategori'];
  $kode_barang = $_POST['kode-barang'];
  $pack_primer = $_POST['pack-primer'];
  $pack_sekunder = $_POST['pack-sekunder'];
  $pack_tersier = $_POST['pack-tersier'];
  $primer_sekunder = $_POST['isi-pack-primer'];
  $sekunder_tersier = $_POST['isi-pack-sekunder'];

  if ($stok->cek_kode_barang($kode_barang)) {
      $msg = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">kode_barang sudah terdaftar, silahkan gunakan nama yang lain.</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
  } else {
      $insert_data = $stok->insert_barang_baru([
          $_SESSION['login'],
          $id_kategori,
          $nama_barang,
          $kode_barang,
          $pack_primer,
          $pack_sekunder,
          $pack_tersier,
          $primer_sekunder,
          $sekunder_tersier
      ]);

      if ($insert_data) {
          $msg1 = '<div class="row alert alert-success alert-dismissable">
      <div class="col-11">Data berhasil ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
      } else {
          $msg1 = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">Data gagal ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
      }
  }
  $id_item = 0;
  $data = $stok->tampil_data_barang_khusus($id_kategori)->fetchAll();
    foreach($data as $row):
      if($row['nama_item'] == $nama_barang)
        $id_item = $row['id'];
    endforeach;

  if($pack_primer!=null){
    $insert_data = $stok->insert_stok_primer([
      $_SESSION['login'],
      $id_kategori,
      $id_item,
    ]);
  }
  if($pack_sekunder!=null){
    $insert_data = $stok->insert_stok_sekunder([
      $_SESSION['login'],
      $id_kategori,
      $id_item,
    ]);
  }
  if($pack_tersier!=null){
    $insert_data = $stok->insert_stok_tersier([
      $_SESSION['login'],
      $id_kategori,
      $id_item,
    ]);
  }


}
// end php add barang


// php stok in
if (isset($_POST['stok-in'])) {

  $id_kategori = $_POST['nama-kategori'];
  $id_barang = $_POST['nama-barang'];
  $jenis_pack = $_POST['jenis-packing'];
  $jumlah = $_POST['jml-barang'];
  $harga = $_POST['harga-barang'];
  $harga_jual = $_POST['harga-jual'];  
  $supplier = $_POST['nama-supplier'];



      $insert_data = $stok->insert_stok_in([
          $_SESSION['login'],
          $id_kategori,
          $id_barang,
          $jenis_pack,
          $jumlah,
          $supplier,
          $harga,
          $harga_jual
      ]);

      if($jenis_pack==1){
    foreach ($stok->tampil_data_primer()->fetchAll(PDO::FETCH_ASSOC) as $dataP):
      if($dataP['item_id'] == $id_barang){
        $awal = $dataP['jumlah'];
      }
    endforeach; 
    
        $insert_data = $stok->update_stok_primer([
          $awal+$jumlah,
          $harga,
          $harga_jual,
          $id_barang,
          $_SESSION['login'],
          $id_kategori,

        ]);
      }elseif($jenis_pack==2){
        foreach ($stok->tampil_data_sekunder()->fetchAll(PDO::FETCH_ASSOC) as $dataP):
          if($dataP['item_id'] == $id_barang){
            $awal = $dataP['jumlah'];
          }
        endforeach; 
        $insert_data = $stok->update_stok_sekunder([
          $awal+$jumlah,
          $harga,
          $harga_jual,
          $id_barang,
          $_SESSION['login'],
          $id_kategori
        ]);
        
      }elseif($jenis_pack==3){
        foreach ($stok->tampil_data_sekunder()->fetchAll(PDO::FETCH_ASSOC) as $dataP):
          if($dataP['item_id'] == $id_barang){
            $awal = $dataP['jumlah'];
          }
        endforeach; 
        $insert_data = $stok->update_stok_tersier([
          $awal+$jumlah,
          $harga,
          $harga_jual,
          $id_barang,
          $_SESSION['login'],
          $id_kategori
        ]);
        
      }
      

      if ($insert_data) {
          $msg1 = '<div class="row alert alert-success alert-dismissable">
      <div class="col-11">Data berhasil ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
      } else {
          $msg1 = '<div class="row alert alert-danger alert-dismissable">
      <div class="col-11">Data gagal ditambahkan</div> 
      <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
      }

      
}
// end php stok in



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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <!-- nav -->
    <?php include("includes/navbar.php")?>
    <!-- end nav -->
    <!-- container-fluid -->
    <div class="container-fluid">
        <br>
        <!-- row1 -->
        <div class="row" style="text-align: center;">
            <!--button kategori, in out stok -->
            <div class="col-md-3">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#kategori-modal" >Add Kategori</button>
            </div>
            <div class="col-md-3">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#barang-modal" >Add Barang</button>
            </div>
            <div class="col-md-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stok-in-modal" >Stok Masuk</button>
            </div>
            <div class="col-md-3">
                <a href="stok_out.php" class="btn btn-danger">Stok Keluar</a>
            </div>
            <!-- end button -->
        </div>
        <!-- end row1 -->


    <!-- show data kategori -->
    <h2>Kategori</h2>
    <!-- row2 -->
    <div class="row" style="margin: 20px;">
        <!-- table -->
        <table class="table table-bordered table-light border-primary">
                <?=isset($msg) ? $msg : ''?>

                <caption>List of Categories</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Date Created</th>
                            <th style="width: 100px;">Edit/Hapus</th>
                        </tr>
                    </thead>
                    <?php
                      $check_data = "SELECT * FROM `kategori` ORDER BY id ASC";
                      $check_data = $connect->prepare($check_data);
                      $check_data->execute(); 
                      
                      
                      if ($check_data->rowCount() == 0): ?>    

                      <p>Tidak ada data kategori.</p>

                      <?php else: ?>

                    <tbody>
                        <!-- fetch php from database by ajax -->
                        <?php
                        foreach($stok->tampil_data_kategori()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                        
                        <tr>
                        <td><?=$data['id']?></td>
                          <td><?=$data['nama_kategori']?></td>
                          <td><?=$data['waktu_ditambahkan']?></td>
                          <td><a href="edit_kat.php?id=<?=$data['id']?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="hapus_kat.php?id=<?=$data['id']?>"  class="btn btn-danger btn-sm">Hapus</a></td>
                        </tr>

                        <?php endforeach ?>
                      
                    </tbody>
                    <?php endif ?>
        </table>
        <!-- end table -->
    </div>
    <!-- end row2 -->
    <!-- end data kategori -->


    <!-- show data barang -->
    <h2>Barang</h2>
    <!-- row3 -->
    <div class="row" style="margin: 20px;">
        <!-- table -->
        <table class="table table-bordered table-light border-primary">
                <?=isset($msg1) ? $msg1 : ''?>

                <caption>List of Barang</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Kategori</th>
                            <th>Stok primer / Harga Jual</th>
                            <th>Stok sekunder / Harga Jual</th>
                            <th>Stok tersier / Harga Jual</th>
                            <th>Date Created</th>
                            <th style="width: 100px;">Edit/Hapus</th>
                        </tr>
                    </thead>
                    <?php
                      $check_data = "SELECT * FROM `packing_items` ORDER BY id ASC";
                      $check_data = $connect->prepare($check_data);
                      $check_data->execute(); 
                      
                      
                      if ($check_data->rowCount() == 0): ?>    

                      <p>Tidak ada data kategori.</p>

                      <?php else: ?>

                    <tbody>
                        <!-- fetch php from database by ajax -->
                        <?php
                        foreach($stok->tampil_data_barang1()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                        
                        <tr>
                          <td><?=$data['id']?></td>
                          <td><?=$data['nama_item']?></td>
                          <td><?=$data['kode_item']?></td>
                          <td>
                          <?php foreach($stok->tampil_data_kategori()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data2):?>
                                  <?php if  ($data['kategori_id'] == $data2['id']){?>
                                      <?=$data2['nama_kategori']?>
                            <?php } endforeach ?>
                          </td>
                          <td> 
                            <?php foreach($stok->tampil_data_primer()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $dataP):?>
                                  <?php if  ($data['id'] == $dataP['item_id']){?>
                                      <?=$dataP['jumlah']?> <?= $data['pack_primer']?>
                                    / <?=$dataP['harga_jual']?>
                          <?php } endforeach ?>
                          </td>
                          <td>

                          <?php foreach($stok->tampil_data_sekunder()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $dataS):?>
                                  <?php if  ($data['id'] == $dataS['item_id']){?>
                                      <?=$dataS['jumlah']?>
                                      <?=$data['pack_sekunder']?>
                                    / <?=$dataS['harga_jual']?>
                          <?php } endforeach ?>
                          
                        
                          </td>

                          <td>

                          <?php foreach($stok->tampil_data_tersier()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $dataS):?>
                                  <?php if  ($data['id'] == $dataS['item_id']){?>
                                      <?=$dataS['jumlah']?>
                                      <?=$data['pack_tersier']?>
                                    / <?=$dataS['harga_jual']?>
                          <?php } endforeach ?>
                          
                        
                          </td>

                          <td><?=$data['waktu_ditambahkan']?></td>
                          <td><a href="edit_brg.php?id=<?=$data['id']?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="hapus_brg.php?id=<?=$data['id']?>"  class="btn btn-danger btn-sm">Hapus</a></td>
                        </tr>

                        <?php endforeach ?>
                      
                    </tbody>
                    <?php endif ?>
        </table>
        <!-- end table -->
    </div>
    <!-- end row3 -->
    <!-- end data barag -->


    </div>
    <!-- end container-fluid -->
    
    









<!-- modal kategori-->
<div class="modal fade" id="kategori-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data Kategori baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
          <form method="post">

            <p>Nama Kategori</p>
            <input type="text" class="form-control form-control-lg" name="nama-kategori"> <br />
            
            <div class="d-grid gap-2">
              <button class="btn btn-dark btn-lg" name="add-kategori">Add</button>
            </div>  
          </form>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- end modal kategori-->

<!-- modal new barang -->
<div class="modal fade" id="barang-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data Barang baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
          <form method="post">

            <p>Nama Barang</p>
            <input type="text" class="form-control form-control-lg" name="nama-barang"> <br />
            <p>Nama Kategori</p>
              <select class="form-control" name="nama-kategori" id="kategori" onchange="getbarang()">
              <option value="">--pilih kategori--</option>
              <?php foreach($stok->tampil_data_kategori()
                    ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                  <option value="<?=$data['id']?>">
                      <?=$data['nama_kategori']?>
                  </option>
              <?php endforeach ?>
              </select>
            <p>Kode Barang</p>
            <input type="text" class="form-control form-control-lg" name="kode-barang"> <br />
            <p>Nama Packing Primer</p>
            <input type="text" class="form-control form-control-lg" name="pack-primer"> <br />
            <p>Nama Packing sekunder</p>
            <input type="text" class="form-control form-control-lg" name="pack-sekunder"> <br />
            <p>Nama Packing Tersier</p>
            <input type="text" class="form-control form-control-lg" name="pack-tersier"> <br />
            <p>Isi packing primer</p>
            <input type="text" class="form-control form-control-lg" placeholder="misal dos ke strip : 50" name="isi-pack-primer"> <br />
            <p>Isi packing sekunder</p>
            <input type="text" class="form-control form-control-lg"  placeholder="misal strip ke biji : 50" name="isi-pack-sekunder"> <br />
            
            <div class="d-grid gap-2">
              <button class="btn btn-dark btn-lg" name="add-barang">Add</button>
            </div>  
          </form>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- end modal new barang -->

<!-- modal add stok in barang -->

<div class="modal fade" id="stok-in-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Stok Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
          <form method="post">
          <b>Supplier</b>
              <select class="form-control" name="nama-supplier" id="supplier" >
              <option value="">--pilih supplier--</option>
              <?php foreach($stok->tampil_data_supplier()
                      ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                    <option value="<?=$data['id']?>"  >
                        <?=$data['nama_supplier']?>
                    </option>
                <?php endforeach ?>
              </select>
<br>
            <b>Nama Kategori</b>
              <select class="form-control" name="nama-kategori" id="kategori" onchange="getbarang(this)">
              <option value="">--pilih kategori--</option>
              <?php foreach($stok->tampil_data_kategori()
                      ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                    <option value="<?=$data['id']?>"  >
                        <?=$data['nama_kategori']?>
                    </option>
                <?php endforeach ?>
              </select>
              <br>
            <b>Nama Barang</b>
              <select class="form-control" name="nama-barang" id="barang" onchange="getpacking(this)">
              <option value="">--pilih barang--</option>
              </select>
<br>
            <b>Jenis Packing</b>
              <select class="form-control" name="jenis-packing" id="packing"  onchange="getprev(this)">
              <option value="">--pilih packing--</option>
              </select>

              <table id="prev_price"></table>
<br>
            <b>Jumlah Barang</b>
            <input type="text" class="form-control form-control-lg" name="jml-barang"> <br />
            
            <b>Harga Beli</b>
            <input type="text" class="form-control form-control-lg" name="harga-barang"> <br />
            
            <b>Harga Jual</b>
            <input type="text" class="form-control form-control-lg" name="harga-jual"> <br />
            
            

            <div class="d-grid gap-2">
              <button class="btn btn-dark btn-lg" name="stok-in">Add</button>
            </div>  
          </form>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<!-- end modal add barang-->


</body>

</html>

<script>

var $tmp1;
var $tmp2;
  function getbarang(id)
  {
    var idkategori = id.value;
    $tmp1=idkategori;
    

    console.log($tmp1+"kat");
    $.ajax({
      type: "POST",
      url: "ajax_getbarang.php",
      data: {
        idkategori: idkategori
      },
      success: function(data) {
        console.log(data);
        $("#barang").html(data);
      }
    });
  }
  function getpacking(id)
  {
    var idbarang = id.value;
    $tmp2 = idbarang;

    console.log(idbarang+"hahaha");
    $.ajax({
      type: "POST",
      url: "ajax_getpack.php",
      data: {
        idbarang: idbarang
      },
      success: function(data) {
        console.log(data);
        $("#packing").html(data);
      }
    });
  }
  function getprev(id) 
  {
    var idpack = id.value;
    console.log(idpack+"hahaha");
    // var idbarang = document.getElementById("#barang").value;
    // var idkategori = document.getElementById("#kategori").value;

    console.log("pack: "+idpack+"\nbarang: "+$tmp2+"\nkategori: "+$tmp1);
    $.ajax({
      type: "POST",
      url: "ajax_getprev_price.php",
      data: {
        idpack: idpack,
        idbarang: $tmp2,
        idkategori: $tmp1
      },
      success: function(data) {
        console.log(data);
        $("#prev_price").html(data);
      }
    });
  }
</script>