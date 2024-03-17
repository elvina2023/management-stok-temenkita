<?php


include 'includes/connect.php';


$fetch_user = "SELECT * FROM `user_admin` WHERE id = ?";
$fetch_user = $connect->prepare($fetch_user);
$fetch_user->execute([ $_SESSION['login'] ]);

$fetch_user = $fetch_user->fetch();


$id = $_GET['id'];

$array_data = [
    $_SESSION['login'],
    $id
];


if (!$stok->cek_sup($array_data))
    header('location: supplier.php');


$fetch_data = $stok->fetch_supplier($array_data);


if (isset($_POST['simpan']))
{
    $nama_supplier  = $_POST['nama-supplier'];
    $telp_supplier = $_POST['telp-supplier'];
    $alamat_supplier = $_POST['alamat-supplier'];
    $deskripsi_supplier = $_POST['deskripsi-supplier'];


    $update_data = $stok->update_supplier([
        $nama_supplier,
        $telp_supplier,
        $alamat_supplier,
        $deskripsi_supplier,
        $_SESSION['login'],
        $id
    ]);


    if ($update_data)
        header('location: supplier.php?id='.$id.'&msg=success');

    else
        $msg = 'Data gagal diperbarui';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>

<body>

    <!-- nav -->
    <?php include("includes/navbar.php")?>
    <!-- end nav -->



    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <h3>Ubah Data Supplier</h3>

                <?php


                if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
                    echo '<div class="alert alert-success">Data supplier berhasil diperbarui.</div>';
                }
                else
                {
                    if (isset($msg))
                        echo $msg;
                }

                ?>

                <form method="post">
                    <p>Nama Supplier</p>
                    <input type="text" class="form-control form-control-lg" name="nama-supplier"> <br />

                    <p>No Telp</p>
                    <input type="text" class="form-control" name="telp-supplier"> <br />

                    <p>Alamat</p>
                    <input type="text" class="form-control" name="alamat-supplier"> <br />

                    <p>Deskripsi</p>
                    <input type="text" class="form-control" name="deskripsi-supplier"> <br />

                    <a href="supplier.php" class="btn btn-secondary">&laquo; Kembali</a>
                    <button name="simpan" class="btn btn-primary">Simpan Catatan</button>
                </form>
            </div>

            <div class="col-md-6"></div>
        </div>
    </div>
</body>
</html>