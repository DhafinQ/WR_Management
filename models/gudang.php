<?php

    class Gudang{
        private $nama_gudang;
        private $alamat;
        private $kapasitas;

        public function __construct($i='',$k='',$d='')
        {
            $this->nama_gudang = $i;
            $this->alamat = $k;
            $this->kapasitas = $d;
        }

        public function store($conn){
            $stmt = mysqli_prepare($conn, "INSERT INTO `gudang`(`id_gudang`, `nama_gudang`, `alamat`, `kapasitas`, `created_at`, `updated_at`) VALUES (NULL,?,?,?,NULL,NULL)");
            mysqli_stmt_bind_param($stmt, 'ssi', $this->nama_gudang, $this->alamat, $this->kapasitas);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "success";
            } else {
                echo "error";
            }
        }

        public function update($conn,$id_gudang){
            $stmt = mysqli_prepare($conn, "UPDATE `gudang` SET `nama_gudang`=?,`alamat`=?,`kapasitas`=? WHERE id_gudang = ?");
            
            mysqli_stmt_bind_param($stmt, 'ssii', $this->nama_gudang, $this->alamat, $this->kapasitas,$id_gudang);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0 || !mysqli_stmt_error($stmt)) {
                echo 'success';
            } else if (mysqli_stmt_error($stmt)) {
                echo 'error';
            }
        }

        public function delete($conn,$id){
            $stmt = mysqli_prepare($conn, "DELETE FROM gudang WHERE id_gudang = ?");

            mysqli_stmt_bind_param($stmt, 'i', $id);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: ../indexGudang.php");
            } else {
                echo "Data Gagal Dihapus!";
            }
        }

    }

?>