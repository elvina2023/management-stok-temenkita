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


if (!$stok->cek_barang($array_data))
    header('location: stok_barang.php?msg=data_tidak_ditemukan');


$fetch_data = $stok->fetch_barang($array_data);


if (isset($_POST['simpan']))
{
    $nama_barang = $_POST['nama-barang'];
    $kode_barang = $_POST['kode-barang'];
    $pack_primer = $_POST['pack-primer'];
    $pack_sekunder = $_POST['pack-sekunder'];
    $pack_tersier = $_POST['pack-tersier'];
    $primer_sekunder = $_POST['isi-pack-primer'];
    $sekunder_tersier = $_POST['isi-pack-sekunder'];
  

    $update_data = $stok->update_barang([
        $nama_barang,
        $kode_barang,
        $pack_primer,
        $pack_sekunder,
        $pack_tersier,
        $primer_sekunder,
        $sekunder_tersier,
        $_SESSION['login'],
        $id
    ]);


    if ($update_data)
        header('location: stok_barang.php?id='.$id.'&msg=success');

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
                <h3>Ubah Data Barang</h3>
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
                    <p>Nama Barang</p>
                    <input type="text" class="form-control form-control-lg" name="nama-barang"> <br />
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
                
                    <a href="stok_barang.php" class="btn btn-secondary">&laquo; Kembali</a>
                    <button name="simpan" class="btn btn-primary">Simpan Catatan</button>
                </form>
            </div>

            <div class="col-md-6"></div>
        </div>
    </div>
</body>
</html>