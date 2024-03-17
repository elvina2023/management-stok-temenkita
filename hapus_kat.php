<?php

include 'includes/connect.php';

$id = $_GET['id'];

$array_data = [
    $_SESSION['login'],
    $id
];


if (!$stok->cek_kategori($array_data))
    header('location: stok_barang.php?msg=data_tidak_ditemukan');


$fetch_data = $stok->fetch_kategori($array_data);



if (isset($_POST['delete']))
{

    $delete_data2 = $stok->delete_kategori_stokout($array_data);
    $delete_data3 = $stok->delete_kategori_stokT($array_data);
    $delete_data4 = $stok->delete_kategori_stokS($array_data);
    $delete_data5 = $stok->delete_kategori_stokP($array_data);
    $delete_data6 = $stok->delete_kategori_stokin($array_data);
    $delete_data = $stok->delete_kategori($array_data);

    if ($delete_data && $delete_data2 && $delete_data3 && $delete_data4 && $delete_data5 && $delete_data6)
        header('location: stok_barang.php?msg=data_berhasil_dihapus');

    else
        $msg = '<div class="alert alert-danger">Data gagal dihapus.</div>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>
<body>
    
    <div class="container mt-5 mb-5">
        <form method="post">
            <h4>Hapus Data kategori</h4>
            <p>Apakah anda ingin menghapus Data kategori berikut ini?</p>

            <?=isset($msg) ? $msg : ''?>

            <b>Nama Kategori</b>
            <p><?=$fetch_data->nama_kategori?></p>
            <b>Waktu ditambahkan</b>
            <p><?=$fetch_data->waktu_ditambahkan?></p>


            <br/>

            <a href="stok_barang.php" class="btn btn-secondary">&laquo; kembali</a>
            <button name="delete" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</body>
</html>