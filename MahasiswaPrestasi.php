<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // =========================================================
    // POLYMORPHISM OVERRIDING - Hitung Tagihan Prestasi
    // =========================================================
    public function hitungTagihanSemester() {
        // Logika: Membayar 25% dari tarif UKT asli (Diskon 75%)
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Prestasi | Instansi Sponsor: {$this->namaInstansiBeasiswa} | Syarat Minimal IPK: {$this->minimalIpkSyarat}";
    }

    public static function ambilBerdasarkanInstansi($dbKoneksi, $instansi) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi' AND nama_instansi_beasiswa = :instansi";
        $stmt = $dbKoneksi->prepare($sql);
        $stmt->execute(['instansi' => $instansi]);
        return $stmt->fetchAll();
    }

    public function getNamaInstansiBeasiswa() { return $this->namaInstansiBeasiswa; }
    public function getMinimalIpkSyarat() { return $this->minimalIpkSyarat; }
}
?>