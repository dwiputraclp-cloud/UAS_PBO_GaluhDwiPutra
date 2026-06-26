<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan khusus Mahasiswa Prestasi
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    // Constructor Kelas Anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Implementasi Method Abstrak 1: Hitung Tagihan
    public function hitungTagihanSemester() {
        // Mahasiswa prestasi mendapatkan potongan penuh, tagihan menjadi 0
        return 0;
    }

    // Implementasi Method Abstrak 2: Tampilkan Spesifikasi
    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Prestasi | Instansi Sponsor: {$this->namaInstansiBeasiswa} | Syarat Minimal IPK: {$this->minimalIpkSyarat}";
    }

    // =========================================================================
    // Method Spesifik: Query SELECT-WHERE mencari mahasiswa dari Instansi Beasiswa tertentu
    // =========================================================================
    public static function ambilBerdasarkanInstansi($dbKoneksi, $instansi) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi' AND nama_instansi_beasiswa = :instansi";
        $stmt = $dbKoneksi->prepare($sql);
        $stmt->execute(['instansi' => $instansi]);
        return $stmt->fetchAll();
    }

    // Getter untuk properti spesifik
    public function getNamaInstansiBeasiswa() { return $this->namaInstansiBeasiswa; }
    public function getMinimalIpkSyarat() { return $this->minimalIpkSyarat; }
}
?>