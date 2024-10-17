<?php
if(isset($_GET['m'])){
    require_once '../koneksi.php';
    if($_GET['m'] == 'barang'){
        deleteBarang($conn,$_GET['id']);
    }
    else if($_GET['m'] == 'pemasok'){
        deletePemasok($conn,$_GET['id']);
    }
    else if($_GET['m'] == 'transaksi'){
        deleteTransaksi($conn,$_GET['id']);
    }
    else if($_GET['m'] == 'gudang'){
        deleteGudang($conn,$_GET['id']);
    }
    else if($_GET['m'] == 'user'){
        deleteUser($conn,$_GET['id']);
    }
}

function deleteBarang($conn,$id_barang){
    require_once '../models/barang.php';
    $barang = new Barang();
    $barang->delete($conn,$id_barang);
}

function deletePemasok($conn, $id){
    require_once '../models/pemasok.php';
    $pemasok = new Pemasok();
    $pemasok->delete($conn,$id);
}
function deleteUser($conn, $id){
    require_once '../models/user.php';
    $user = new User();
    $user->delete($conn,$id);
}

function deleteTransaksi($conn,$id){
    require_once '../models/transaksi.php';
    $transaksi = new Transaksi();
    $transaksi->delete($conn,$id);
}

function deleteGudang($conn,$id){
    require_once '../models/gudang.php';
    $gudang = new Gudang();
    $gudang->delete($conn,$id);
}

?>