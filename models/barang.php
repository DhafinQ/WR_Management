<?php

class Barang
{

    private $nama_barang;
    private $id_pemasok;
    private $kategori;
    private $deskripsi;
    private $harga;
    private $jumlah_stok;
    private $lokasi_gudang;
    private $tgl_kadaluwarsa;


    public function __construct($n='', $i='', $k='', $d='', $h='', $j='', $l='', $t='')
    {
        $this->nama_barang = $n;
        $this->id_pemasok = $i;
        $this->kategori = $k;
        $this->deskripsi = $d;
        $this->harga = $h;
        $this->jumlah_stok = $j;
        $this->lokasi_gudang = $l;
        $this->tgl_kadaluwarsa = $t;
    }

    public function store($conn)
    {
        $stmt = mysqli_prepare($conn, "INSERT INTO barang (id, nama_barang, kategori, deskripsi, harga, jumlah_stok, lokasi_gudang, tgl_kadaluwarsa, id_pemasok) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($stmt, 'sssiissi', $this->nama_barang, $this->kategori, $this->deskripsi, $this->harga, $this->jumlah_stok, $this->lokasi_gudang, $this->tgl_kadaluwarsa, $this->id_pemasok);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "success";
        } else {
            echo "error";
        }
    }

    public function update($conn,$id_barang)
    {
        $stmt = mysqli_prepare($conn, "UPDATE barang SET nama_barang = ?, kategori = ?, deskripsi = ?, harga = ?, jumlah_stok = ?, lokasi_gudang = ?, tgl_kadaluwarsa = ?, id_pemasok = ? WHERE id = ?");

        mysqli_stmt_bind_param($stmt, 'sssiissii', $this->nama_barang, $this->kategori, $this->deskripsi, $this->harga, $this->jumlah_stok, $this->lokasi_gudang, $this->tgl_kadaluwarsa, $this->id_pemasok, $id_barang);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0 || !mysqli_stmt_error($stmt)) {
            echo 'success';
        } else if (mysqli_stmt_error($stmt)) {
            echo 'error';
        }
    }

    public function delete($conn, $id)
    {
        $stmt = mysqli_prepare($conn, "DELETE FROM barang WHERE id = ?");

        mysqli_stmt_bind_param($stmt, 'i', $id);

        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("location: ../indexBarang.php");
        } else {
            echo "Data Gagal Dihapus!";
        }
    }
}
