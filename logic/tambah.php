<?php
if(isset($_POST['model'])){
    require_once '../koneksi.php';
    if($_POST['model'] == 'barang'){
        tambahBarang($conn);
    }
    else if($_POST['model'] == 'pemasok'){
        tambahPemasok($conn);
    }
    else if($_POST['model'] == 'tran
    saksi'){
        tambahTransaksi($conn);
    }
    else if($_POST['model'] == 'gudang'){
        tambahGudang($conn);
    }
    else if($_POST['model'] == 'user'){
        tambahUser($conn);
    }
}

function tambahBarang($conn){
    require_once '../models/barang.php';
    $barang = new Barang($_POST['nama_barang'],$_POST['id_pemasok'],$_POST['kategori'],$_POST['deskripsi'],$_POST['harga'],$_POST['jumlah_stok'],$_POST['lokasi_gudang'],$_POST['tgl_kadaluwarsa'],$_POST['tgl_kadaluwarsa'],$_POST['id_pemasok']);
    $barang->store($conn);
}

function tambahPemasok($conn){
    require_once '../models/pemasok.php';
    $pemasok = new Pemasok($_POST['nama_pemasok'],$_POST['alamat'],$_POST['email'], $_POST['no_tlp']);
    $pemasok->store($conn);
}

function tambahTransaksi($conn){
    require_once '../models/transaksi.php';
    $transaksi = new Transaksi($_POST['id_barang'],$_POST['jumlah'],$_POST['tgl_transaksi'], $_POST['tipe_transaksi']);
    $transaksi->store($conn);
}

function tambahGudang($conn){
    require_once '../models/gudang.php';
    $gudang = new gudang($_POST['nama_gudang'],$_POST['alamat'],$_POST['kapasitas']);
    $gudang->store($conn);
}
function tambahUser($conn){
    require_once '../models/user.php';
    $user = new user($_POST['nama_lengkap'],$_POST['role'],$_POST['email'],$_POST['password']);
    $user->store($conn);
}

?>