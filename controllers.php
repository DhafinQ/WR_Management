<?php

use function PHPSTORM_META\type;

class Controller
{
    public function getBarangData($conn)
    {
        $query = "SELECT * FROM barang";
        if ($result = $conn->query($query)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $data; 
        } else {
            return [];
        }
    }

    public function getTransaksiData($conn)
    {
        if($_SERVER['REQUEST_URI'] == '/pbo_wr_management/dashboard.php'){
            $query = "SELECT transaksi.*, barang.nama_barang AS nama_barang FROM transaksi,barang WHERE transaksi.id_barang = barang.id ORDER BY transaksi.id DESC LIMIT 5";
        }else{
            $query = "SELECT transaksi.*, barang.nama_barang AS nama_barang FROM transaksi,barang WHERE transaksi.id_barang = barang.id";
        }
        if ($result = $conn->query($query)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $data; 
        } else {
            return [];
        }
    }

    public function getGudangData($conn)
    {
        $query = "SELECT * FROM gudang";
        if ($result = $conn->query($query)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $data; 
        } else {
            return [];
        }
    }

    public function getPemasokData($conn)
    {
        $query = "SELECT * FROM pemasok";
        if ($result = $conn->query($query)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $data; 
        } else {
            return [];
        }
    }
    public function getUserData($conn)
    {
        $query = "SELECT * FROM User";
        if ($result = $conn->query($query)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $data; 
        } else {
            return [];
        }
    }

    public function getBarang($conn,$id){
        $query = "SELECT * FROM barang WHERE id = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            return $data; 
        } else {
            return [];
        }
    }

    public function getPemasok($conn,$id){

        $query = "SELECT * FROM pemasok WHERE id = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            return $data;
        } else {
            return [];
        }
    }
    public function getUser($conn,$id){

        $query = "SELECT * FROM user WHERE id = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            return $data;
        } else {
            return [];
        }
    }

    public function getGudang($conn,$id){
        $query = "SELECT * FROM gudang WHERE id_gudang = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            return $data;
        } else {
            return [];
        }
    }

    public function getKategoriSum($conn){
        $query = "SELECT CASE WHEN kategori IN ('Makanan', 'Minuman', 'Bahan Makanan', 'Kesehatan') THEN kategori ELSE 'DLL'END AS kategoris, SUM(jumlah_stok) AS total_jumlah_stok FROM barang GROUP BY kategoris;";
        if ($result = $conn->query($query)) {
            return $result;
        } else {
            return [];
        }
    }

    public function getTransaksi($conn,$id){
        $query = "SELECT * FROM transaksi WHERE id = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            return $data;
        } else {
            return [];
        }
    }

    public function getBarangJSON($conn,$id){
        $query = "SELECT barang.*, pemasok.nama_pemasok AS nama_pemasok, gudang.nama_gudang AS nama_gudang FROM barang,gudang,pemasok WHERE barang.id = ".$id. " AND pemasok.id = barang.id_pemasok AND gudang.id_gudang = barang.lokasi_gudang";
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function getPemasokJSON($conn,$id){
        $query = "SELECT * FROM pemasok WHERE id = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }
    public function getUserJSON($conn,$id){
        $query = "SELECT * FROM user WHERE id = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function getGudangJSON($conn,$id){
        $query = "SELECT * FROM gudang WHERE id_gudang = ".$id;
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function getTransaksiJSON($conn,$id){
        $query = "SELECT transaksi.*, barang.nama_barang AS nama_barang FROM transaksi,barang WHERE transaksi.id = ".$id ." AND transaksi.id_barang = barang.id";
        if ($result = $conn->query($query)) {
            $data = $result->fetch_assoc();
            $result->free();
            
            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function getNamaGudang($conn, $id, $idGudang) { 
        $query = "SELECT gudang.nama_gudang FROM gudang,barang WHERE barang.id = ? AND gudang.id_gudang = ? AND gudang.id_gudang = barang.lokasi_gudang";
        $namaGudang = '';
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ii", $id, $idGudang);
            $stmt->execute();
            $stmt->bind_result($namaGudang);
            if ($stmt->fetch()) {
                return $namaGudang;
            }
            $stmt->close();
        }
        return null;
    }

}
