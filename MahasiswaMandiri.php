<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    private $golonganUkt;
    private $namaWali;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan, $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // =========================================================
    // POLYMORPHISM OVERRIDING - Hitung Tagihan Mandiri
    // =========================================================
    public function hitungTagihanSemester() {
        // Logika: Tarif UKT Nominal + Biaya Operasional/Praktikum Rp100.000
        return $this->tarifUktNominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Mandiri | Golongan UKT: {$this->golonganUkt} | Nama Wali: {$this->namaWali}";
    }

    public static function ambilBerdasarkanGolongan($dbKoneksi, $golongan) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri' AND golongan_ukt = :golongan";
        $stmt = $dbKoneksi->prepare($sql);
        $stmt->execute(['golongan' => $golongan]);
        return $stmt->fetchAll();
    }

    public function getGolonganUkt() { return $this->golonganUkt; }
    public function getNamaWali() { return $this->namaWali; }
}
?>