<?php

session_start();

try {

    $connect = new PDO('mysql:host=localhost;dbname=temenkita', 'root', '');

} catch(PDOException $e) 
{
    die('Tidak berhasil terkoneksi ke database!<br/>Error: '.$e);
}


include 'temenkita.php';


$session_login = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$stok = new temenkita($connect);


if (isset($session_login))
{
    $fetch_admin = "SELECT * FROM `user_admin` WHERE id = ?";
    $fetch_admin = $connect->prepare($fetch_admin);
    $fetch_admin->execute([ $session_login ]);
    $fetch_admin = $fetch_admin->fetch();
}

?>
