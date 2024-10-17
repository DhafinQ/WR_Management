 <?php

    class User{
        private $nama_lengkap;
        private $role;
        private $email;
        private $password;


        public function __construct ($i='',$k='',$d='',$p='')
        {
            $this->nama_lengkap = $i;
            $this->role = $k;
            $this->email = $d;
            $this->password = $p;
        }

        public function store($conn){
            $stmt = mysqli_prepare($conn, "INSERT INTO `user`(`id`, `nama_lengkap`, `role`, `email`,`password`, `created_at`, `updated_at`) VALUES (NULL,?,?,?,MD5(?),NULL,NULL)");

            mysqli_stmt_bind_param($stmt, 'ssss', $this->nama_lengkap, $this->role, $this->email, $this->password);
      
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "success";
            } else {
                echo "error";
            }
        }

        public function update($conn, $id){
            if(empty($this->password)){
                $stmt = mysqli_prepare($conn, "UPDATE `user` SET `nama_lengkap`=?,`role`=?,`email`=? WHERE id = ?");
                mysqli_stmt_bind_param($stmt, 'sssi', $this->nama_lengkap, $this->role, $this->email, $id);
            }else{
                $stmt = mysqli_prepare($conn, "UPDATE `user` SET `nama_lengkap`=?,`role`=?,`email`=?,password=MD5(?) WHERE id = ?");
                mysqli_stmt_bind_param($stmt, 'ssssi', $this->nama_lengkap, $this->role, $this->email,$this->password, $id);
            }

    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0 || !mysqli_stmt_error($stmt)) {
                echo 'success';
            } else if (mysqli_stmt_error($stmt)) {
                echo 'error';
            }
        }

        public function delete($conn,$id){
            $stmt = mysqli_prepare($conn, "DELETE FROM user WHERE id = ?");

            mysqli_stmt_bind_param($stmt, 'i', $id);
    
            mysqli_stmt_execute($stmt);
    
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: ../indexUser.php");
            } else {
                echo "Data Gagal Dihapus!";
            }
        }

    }

?>