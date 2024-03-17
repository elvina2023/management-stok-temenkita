  <?php

include 'includes/connect.php';

if (empty($session_login))
    header('location: login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temenkita</title>
    <!-- css -->
    <link rel="stylesheet" href="chart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

</head>
<body>
    <!-- nav -->
    <?php include("includes/navbar.php")?>
    <!-- end nav -->
    <!-- <h2>Beranda</h2> -->
    <div class="container-fluid">
        <!-- class row -->
        <div class="row" style="align:center;">
 <!-- LINE CHART BLOCK (LEFT-CONTAINER) PRR!! DL 1 MGG-->
<!-- 
        <div class="line-chart-block block">
            <div class="line-chart">
                    <div class='grafico'>
                    <ul class='eje-y'>
                        <li data-ejeY='30'></li>
                        <li data-ejeY='20'></li>
                        <li data-ejeY='10'></li>
                        <li data-ejeY='0'></li>
                    </ul>
                    <ul class='eje-x'>
                        <li>Apr</li>
                        <li>May</li>
                        <li>Jun</li>
                    </ul>
                        <span data-valor='25'>
                        <span data-valor='8'>
                        <span data-valor='13'>
                        <span data-valor='5'>   
                        <span data-valor='23'>   
                        <span data-valor='12'>
                        <span data-valor='15'>
                    </div>
            </div>
                        <ul class="time-lenght horizontal-list">
                            <li><a class="time-lenght-btn" href="#14">Week</a></li>
                            <li><a class="time-lenght-btn" href="#15">Month</a></li>
                            <li><a class="time-lenght-btn" href="#16">Year</a></li>
                        </ul>
                        <ul class="month-data clear">
                            <li>
                                <p>APR<span class="scnd-font-color"> 2013</span></p>
                                <p><span class="entypo-plus increment"> </span>21<sup>%</sup></p>
                            </li>
                            <li>
                                <p>MAY<span class="scnd-font-color"> 2013</span></p>
                                <p><span class="entypo-plus increment"> </span>48<sup>%</sup></p>
                            </li>
                            <li>
                                <p>JUN<span class="scnd-font-color"> 2013</span></p>
                                <p><span class="entypo-plus increment"> </span>35<sup>%</sup></p>
                            </li>
                        </ul>
        </div> 
     -->
        <!-- end CHART -->
        </div>
        <!-- end row -->
            <!-- show data barang -->
   
    <!-- row3 -->
    <div class="row" style="margin: 20px;">
    <h2 style="color:black;">Data Penjualan</h2>
        <!-- table -->
        <table class="table table-bordered table-light border-primary">
                <?=isset($msg1) ? $msg1 : ''?>

                <caption>List of Barang Terjual</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Packing</th>
                            <th>Metode Pembayaran</th>
                            <th>Total</th>
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
                        foreach($stok->tampil_data_barang_out()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data):?>
                        
                        <tr>
                          <td><?=$data['id']?></td>
                          <!-- <td><?=$data['nama_item']?></td>
                          <td><?=$data['kode_item']?></td> -->
                          <td>
                          <?php foreach($stok->tampil_data_kategori()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data2):?>
                                  <?php if  ($data['kategori_id'] == $data2['id']){?>
                                      <?=$data2['nama_kategori']?>
                            <?php } endforeach ?>
                          </td>
                          <td>
                          <?php foreach($stok->tampil_data_barang1()
                                  ->fetchAll(PDO::FETCH_ASSOC)as $data2):?>
                                  <?php if  ($data['item_id'] == $data2['id']){?>
                                      <?=$data2['nama_item']?>
                            <?php } endforeach ?>
                          </td>
                          <td> <?=$data['jumlah']?>
                          <?php if($data['packing'] == 1){
                                foreach($stok->tampil_data_barang1()
                                ->fetchAll(PDO::FETCH_ASSOC)as $dataP):?>
                                <?php if  ($data['item_id'] == $dataP['id']){?>
                                <?=$dataP['pack_primer']?>
                                    
                            <?php } endforeach; } ?>
                          </td>
                          <td>

                        
                          </td>

                          <td>

                        
                          </td>

                          <td><?=$data['waktu_ditambahkan']?></td>
                          <td><a href="#" class="btn btn-primary btn-sm">Edit</a>
                          <a href="#"  class="btn btn-danger btn-sm">Hapus</a></td>
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
</body>
<style>
/* body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
} */

#animations-example-3 {
  height: 200px;
  max-width: 300px;
  margin: 0 auto;
}
#animations-example-3 tbody {
  overflow-y: hidden; remove this to see how it works
}
#animations-example-3 tbody th {
  background-color: #fff;
  z-index: 1;
}
#animations-example-3 tbody td {
  animation: moving-bars 4s linear infinite;
}
@keyframes moving-bars {
  0%  { transform: translateY( 100% ); }
  15% { transform: translateY( 0 ); }
}

</style>
</html>