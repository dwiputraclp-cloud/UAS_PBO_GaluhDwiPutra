<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan khusus Mahasiswa Mandiri
    private $golonganUkt;
    private $namaWali;

    // Constructor Kelas Anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan, $golonganUkt, $namaWali) {
        // Memanggil constructor milik kelas induk (Mahasiswa)
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // Implementasi Method Abstrak 1: Hitung Tagihan
    public function hitungTagihanSemester() {
        // Mahasiswa mandiri membayar UKT penuh sesuai tarif nominalnya
        return $this->tarifUktNominal;
    }

    // Implementasi Method Abstrak 2: Tampilkan Spesifikasi
    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Mandiri | Golongan UKT: {$this->golonganUkt} | Nama Wali: {$this->namaWali}";
    }

    // =========================================================================
    // Method Spesifik: Query SELECT-WHERE untuk mencari data berdasarkan Golongan UKT
    // =========================================================================
    public static function ambilBerdasarkanGolongan($dbKoneksi, $golongan) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri' AND golongan_ukt = :golongan";
        $stmt = $dbKoneksi->prepare($sql);
        $stmt->execute(['golongan' => $golongan]);
        return $stmt->fetchAll(); // Mengembalikan data berupa array of objects PDO
    }

    // Getter untuk properti spesifik
    public function getGolonganUkt() { return $this->golonganUkt; }
    public function getNamaWali() { return $this->namaWali; }
}
?>