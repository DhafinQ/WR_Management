<?php
if(isset($_GET['model'])){
    require_once '../koneksi.php';
    if($_GET['model'] == 'barang'){
        getBarang($conn,$_GET['id']);
    }
    else if($_GET['model'] == 'pemasok'){
        getPemasok($conn, $_GET['id']);
    }
    else if($_GET['model'] == 'transaksi'){
        getTransaksi($conn, $_GET['id']);
    }
    else if($_GET['model'] == 'gudang'){
        getGudang($conn, $_GET['id']);
    }
    else if($_GET['model'] == 'user'){
        getUser($conn, $_GET['id']);
    }
}

function getBarang($conn,$id){
    require_once '../controllers.php';
    $controller = new Controller();
    $controller->getBarangJSON($conn,$id);
}

function getPemasok($conn, $id){
    require_once '../controllers.php';
    $controller = new Controller();
    $controller->getPemasokJSON($conn,$id);
}

function getTransaksi($conn,$id){
    require_once '../controllers.php';
    $controller = new Controller();
    $controller->getTransaksiJSON($conn,$id);
}

function getGudang($conn,$id){
    require_once '../controllers.php';
    $controller = new Controller();
    $controller->getGudangJSON($conn,$id);
}
function getUser($conn, $id){
    require_once '../controllers.php';
    $controller = new Controller();
    $controller->getUserJSON($conn,$id);
}

?>