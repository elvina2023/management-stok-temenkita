<?php

include 'includes/connect.php';

$id = $_GET['id'];

$array_data = [
    $_SESSION['login'],
    $id
];


if (!$stok->cek_sup($array_data))
    header('location: supplier.php');


$fetch_data = $stok->fetch_supplier($array_data);



if (isset($_POST['delete']))
{
    $delete_data = $stok->delete_supplier($array_data);

    if ($delete_data)
        header('location: supplier.php?msg=data_berhasil_dihapus');

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
    <title>Hapus Data Supplier</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>
<body>
    
    <div class="container mt-5 mb-5">
        <form method="post">
            <h4>Hapus Data Supplier</h4>
            <p>Apakah anda ingin menghapus Data Supplier berikut ini?</p>

            <?=isset($msg) ? $msg : ''?>

            <b>Nama</b>
            <p><?=$fetch_data->nama_supplier?></p>


            <b>No Telpon</b>
            <p><?=$fetch_data->telp_supplier?></p>


            <b>Alamat</b>
            <p><?=$fetch_data->alamat_supplier?></p>

            <b>Deskripsi</b>
            <p><?=$fetch_data->deskripsi_supplier?></p>

            <br/>

            <a href="supplier.php" class="btn btn-secondary">&laquo; kembali</a>
            <button name="delete" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</body>
</html>