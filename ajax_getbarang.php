<?php
    require "includes/connect.php";
    $skategori = $_POST['idkategori'];
    $data = $stok->tampil_data_barang_khusus($skategori)->fetchAll();
    
    foreach($data as $row):?>
    
    <option value="<?=$row['id']?>"><?=$row['nama_item']?></option>
    
<?php endforeach; ?>
   