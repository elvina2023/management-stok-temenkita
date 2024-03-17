<?php
    require "includes/connect.php";
    
    $array_data = [
        $sbarang = $_POST['idbarang'],
        $spack = $_POST['idpack'],
        $skategori = $_POST['idkategori']
    ];
    $data = $stok->tampil_harga_sebelum($array_data)->fetchAll();
    
    foreach($data as $row):?>
    
    <tr>
        <td><?=$row['harga_beli']?></td>
        <td><?=$row['harga_jual']?></td>
        <td><?=$row['waktu_ditambahkan']?></td>
    </tr>
    
<?php endforeach; ?>