<?php

include 'includes/connect.php';

if (empty($session_login))
    header('location: login.php');


// php stok out
if (isset($_POST['stok-out'])) {

    $id_kategori = $_POST['nama-kategori'];
    $id_barang = $_POST['nama-barang'];
    $jenis_pack = $_POST['jenis-packing'];
    $jumlah = $_POST['jml-barang'];
    $metode_bayar = $_POST['metode-bayar'];
    $nota_no = $_POST['nota-no'];

    $total;
  
        
  
        if($jenis_pack==1){
      foreach ($stok->tampil_data_primer()->fetchAll(PDO::FETCH_ASSOC) as $dataP):
        if($dataP['item_id'] == $id_barang){
          $awal = $dataP['jumlah'];
          $total = $jumlah*$dataP['harga'];
        }
      endforeach; 
      
          $insert_data = $stok->update_stok_primer_out([
            $awal-$jumlah,
            $id_barang,
            $_SESSION['login'],
            $id_kategori
          ]);
        }elseif($jenis_pack==2){
          foreach ($stok->tampil_data_sekunder()->fetchAll(PDO::FETCH_ASSOC) as $dataP):
            if($dataP['item_id'] == $id_barang){
              $awal = $dataP['jumlah'];
              $total = $jumlah*$dataP['harga_jual'];
            }
          endforeach; 
          $insert_data = $stok->update_stok_sekunder_out([
            $awal-$jumlah,
            $id_barang,
            $_SESSION['login'],
            $id_kategori
          ]);
          
        }elseif($jenis_pack==3){
          foreach ($stok->tampil_data_sekunder()->fetchAll(PDO::FETCH_ASSOC) as $dataP):
            if($dataP['item_id'] == $id_barang){
              $awal = $dataP['jumlah'];
              $total = $jumlah*$dataP['harga_jual'];
            }
          endforeach; 
          $insert_data = $stok->update_stok_tersier_out([
            $awal-$jumlah,
            $id_barang,
            $_SESSION['login_jual'],
            $id_kategori
          ]);
          
        }
        
        $insert_data = $stok->insert_stok_out([
          $_SESSION['login'],
          $id_kategori,
          $id_barang,
          $jenis_pack,
          $jumlah,
          $total,
          $nota_no,
          $metode_bayar
      ]);
  
        if ($insert_data) {
            $msg1 = '<div class="row alert alert-success alert-dismissable">
        <div class="col-11">Data berhasil diperbarui</div> 
        <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
        } else {
            $msg1 = '<div class="row alert alert-danger alert-dismissable">
        <div class="col-11">Data gagal diperbarui</div> 
        <div class="col-1"><button type="button" class="btn-close" data-bs-dismiss="alert" ></button> </div> </div>';
        }
  
        
  }
  // end php stok out    



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
    <br><br>
    <!-- row1 -->
        <div class="row">
            <!--button add out stok -->
            <div class="col-md-11" style="text-align:right;">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#stok-out-modal" >Add Barang</button>
            </div>
            <!-- end button -->
        </div>
    <!-- end row1 -->
<br>
    <!-- row2 -->
    <div class="row">
        <!-- <div class="col-1">
        
        <?php
        $nota = 0;
        foreach ($stok->tampil_nomor_nota()->fetchAll(PDO::FETCH_ASSOC) as $data):
          if($data['id'] > $nota){
            $nota = $data['id'];
          }
        endforeach;?>

        <span id="no-nota" name="no_nota">Current Nota Number: <?=$nota?></span>
        </div> -->
        <div class="col-12">
        <h2>Data Barang Keluar</h2>
            <table id="cart" class="table table-bordered table-light border-primary">
            <?=isset($msg1) ? $msg1 : ''?>
            <caption>List of Barang Keluar</caption>
            <thead>
              <tr>
                <th>Nota nomor</th>
                <th>Name</th>
                <th>Jumlah</th>
                <th>Metode Bayar</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            <?php
                        foreach($stok->tampil_data_barang_out()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                        
                        <tr>
                          <td><?=$data['nota_no']?></td>
                          <td><?=$data['item_id']?></td>
                          <td><?=$data['jumlah']?></td>
                          <td><?=$data['metode_bayar']?></td>
                          <td><?=$data['total']?></td>
                         </tr>
                        <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4">Grand Total</td>
                <td id="summary">Rp 0</td>
              </tr>
            </tfoot>
            </table>
        </div>
        <div class="col-1"></div>
    </div>
     <!-- end row2 -->


    </div>
    <!-- end container-fluid -->

<!-- modall add stok out -->
<div class="modal fade" id="stok-out-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Stok Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
          <form method="post">
            <p>Nota nomor</p>
            <input type="text" class="form-control form-control-lg" name="nota-no"> <br />
            
            <p>Nama Kategori</p>
              <select class="form-control" name="nama-kategori" id="kategori" onchange="getbarang(this)">
              <option value="">--pilih kategori--</option>
              <?php foreach($stok->tampil_data_kategori()
                      ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                    <option value="<?=$data['id']?>"  >
                        <?=$data['nama_kategori']?>
                    </option>
                <?php endforeach ?>
              </select>
              
            <p>Nama Barang</p>
              <select class="form-control" name="nama-barang" id="barang" onchange="getpacking(this)">
              <option value="">--pilih barang--</option>
              </select>

            <p>Jenis Packing</p>
              <select class="form-control" name="jenis-packing" id="packing">
              <option value="">--pilih packing--</option>
              </select>

            <p>Jumlah Barang</p>
            <input type="text" class="form-control form-control-lg" name="jml-barang"> <br />
            
            <p>Metode Pembayaran</p>
            <input type="text" class="form-control form-control-lg" name="metode-bayar"> <br />
            

            <div class="d-grid gap-2">
              <button class="btn btn-dark btn-lg" name="stok-out">Add</button>
            </div>  
          </form>
      </div>

      <div class="modal-footer"></div>
    </div>
  </div>
</div>
</div>


<!-- end modall add stok out -->


</body>

</html>

<script>
  

    function getbarang(id)
  {
    var idkategori = id.value;

    console.log(idkategori+"kat");
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

</script>