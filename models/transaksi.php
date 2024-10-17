<?php

    class Transaksi{
        private $id_barang;
        private $jumlah;
        private $tgl_transaksi;
        private $tipe_transaksi;

        public function __construct($i='',$k='',$l='',$m='')
        {
            $this->id_barang = $i;
            $this->jumlah = $k;
            $this->tgl_transaksi = $l;
            $this->tipe_transaksi = $m;
        }

        public function store($conn){
            $stmt = mysqli_prepare($conn, "INSERT INTO `transaksi`(`id`, `id_barang`, `jumlah`, `tgl_transaksi`, `tipe_transaksi`, `created_at`, `updated_at`) VALUES (NULL,?,?,?,?,NULL,NULL)");

            mysqli_stmt_bind_param($stmt, 'iiss', $this->id_barang, $this->jumlah, $this->tgl_transaksi, $this->tipe_transaksi);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "success";
            } else {
                echo "error";
            }
        }

        public function update($conn,$id){
            $stmt = mysqli_prepare($conn, "UPDATE `transaksi` SET `id_barang`=?,`jumlah`=?,`tgl_transaksi`=?,`tipe_transaksi`=? WHERE id=?");

            mysqli_stmt_bind_param($stmt, 'iissi', $this->id_barang, $this->jumlah, $this->tgl_transaksi, $this->tipe_transaksi,$id);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0 || !mysqli_stmt_error($stmt)) {
                echo 'success';
            } else if (mysqli_stmt_error($stmt)) {
                echo 'error';
            }
        }

        public function delete($conn,$id){
            $stmt = mysqli_prepare($conn, "DELETE FROM transaksi WHERE id = ?");

            mysqli_stmt_bind_param($stmt, 'i', $id);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: ../indexTransaksi.php");
            } else {
                echo "Data Gagal Dihapus!";
            }
        }

    }

?>