<?php
/**
 * Kelas Koneksi Basis Data MySQL
 * Implementasi OOP Murni menggunakan Pola PDO
 */

class Database {
    // Properti konfigurasi privat (hanya bisa diakses di dalam kelas ini)
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "DB_UAS_PBO_TRPL1A_GaluhDwiPutra";
    
    // Tempat menyimpan instance koneksi PDO
    private $koneksi;

    /**
     * Method untuk membuat dan mengambil koneksi database
     * @return PDO
     */
    public function hubungkan() {
        // Mengosongkan koneksi terlebih dahulu sebelum membuat yang baru
        $this->koneksi = null;

        try {
            // Proses instansiasi objek PDO internal
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=utf8";
            $this->koneksi = new PDO($dsn, $this->username, $this->password);
            
            // Atur konfigurasi error dan fetch mode standar OOP
            $this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->koneksi->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
        } catch (PDOException $exception) {
            // Tangani error jika koneksi gagal
            die("Koneksi database gagal: " . $exception->getMessage());
        }

        return $this->koneksi;
    }
}

// =================================================================
// Cara Penggunaan / Instansiasi Kelas Database di File Lain Kelak:
// =================================================================
// $db = new Database();
// $conn = $db->hubungkan(); 
// =================================================================
?>