<?php
if(isset($_POST['model'])){
    require_once '../koneksi.php';
    if($_POST['model'] == 'barang'){
        editBarang($conn,$_POST['id_barang']);
    }
    else if($_POST['model'] == 'pemasok'){
        editPemasok($conn,$_POST['id']);
    }
    else if($_POST['model'] == 'transaksi'){
        editTransaksi($conn,$_POST['id']);
    }
    else if($_POST['model'] == 'gudang'){
        editGudang($conn,$_POST['id_gudang']);
    }
    else if($_POST['model'] == 'user'){
        editUser($conn,$_POST['id']);
    }
}

function editBarang($conn,$id_barang){
    require_once '../models/barang.php';
    $barang = new Barang($_POST['nama_barang'],$_POST['id_pemasok'],$_POST['kategori'],$_POST['deskripsi'],$_POST['harga'],$_POST['jumlah_stok'],$_POST['lokasi_gudang'],$_POST['tgl_kadaluwarsa'],$_POST['tgl_kadaluwarsa'],$_POST['id_pemasok']);
    $barang->update($conn,$id_barang);
}

function editPemasok($conn, $id){
    require_once '../models/pemasok.php';
    $pemasok = new Pemasok($_POST['nama_pemasok'],$_POST['alamat'],$_POST['email'], $_POST['no_tlp']);
    $pemasok->update($conn,$id);
}

function editTransaksi($conn,$id){
    require_once '../models/transaksi.php';
    $transaksi = new Transaksi($_POST['id_barang'],$_POST['jumlah'],$_POST['tgl_transaksi'], $_POST['tipe_transaksi']);
    $transaksi->update($conn,$id);
}

function editGudang($conn,$id_gudang){
    require_once '../models/gudang.php';
    $gudang = new Gudang($_POST['nama_gudang'],$_POST['alamat'],$_POST['kapasitas']);
    $gudang->update($conn,$id_gudang);
}
function editUser($conn, $id){
    require_once '../models/user.php';
    $password = '';
    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    $user = new User($_POST['nama_lengkap'],$_POST['role'],$_POST['email'], $password);
    $user->update($conn,$id);
}

?>