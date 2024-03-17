<?php
    // echo 'ini respon dari ajax : ' . $_POST['idkategori'];
    require "includes/connect.php";
    $sbarang = $_POST['idbarang'];
    $data = $stok->tampil_data_barang_khusus2($sbarang)->fetchAll();
    $p_id = 1;  
    foreach($data as $row):?>
    
        <option value="<?=$p_id?>"><?=$row['pack_primer']?></option>
        <?php $p_id += 1; ?>

        <?php if($row['pack_sekunder'] != null){?>
    
        <option value="<?=$p_id?>"><?=$row['pack_sekunder']?></option>
        <?php $p_id += 1;} ?>
        
        <?php if ($row['pack_tersier'] != null) { ?>
    
        <option value="<?= $p_id ?>"><?= $row['pack_tersier'] ?></option>
 
<?php } endforeach; ?>
