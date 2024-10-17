<?php

    class Pemasok{
        private $nama_pemasok;
        private $alamat;
        private $email;
        private $no_tlp;


        public function __construct ($i='',$k='',$d='',$f='')
        {
            $this->nama_pemasok = $i;
            $this->alamat = $k;
            $this->email = $d;
            $this->no_tlp = $f;
        }

        public function store($conn){
            $stmt = mysqli_prepare($conn, "INSERT INTO `pemasok`(`id`, `nama_pemasok`, `alamat`, `email`, `no_tlp`, `created_at`, `updated_at`) VALUES (NULL,?,?,?,?,NULL,NULL)");

            mysqli_stmt_bind_param($stmt, 'ssss', $this->nama_pemasok, $this->alamat, $this->email, $this->no_tlp);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "success";
            } else {
                echo "error";
            }
        }

        public function update($conn, $id){
            $stmt = mysqli_prepare($conn, "UPDATE `pemasok` SET `nama_pemasok`=?,`alamat`=?,`email`=?,`no_tlp`=? WHERE id = ?");

            mysqli_stmt_bind_param($stmt, 'sssii', $this->nama_pemasok, $this->alamat, $this->email, $this->no_tlp, $id);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0 || !mysqli_stmt_error($stmt)) {
                echo 'success';
            } else if (mysqli_stmt_error($stmt)) {
                echo 'error';
            }
        }

        public function delete($conn,$id){
            $stmt = mysqli_prepare($conn, "DELETE FROM pemasok WHERE id = ?");

            mysqli_stmt_bind_param($stmt, 'i', $id);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: ../indexPemasok.php");
            } else {
                echo "Data Gagal Dihapus!";
            }
        }

    }

?>