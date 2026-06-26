<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // =========================================================
    // POLYMORPHISM OVERRIDING - Hitung Tagihan Bidikmisi
    // =========================================================
    public function hitungTagihanSemester() {
        // Logika: Digratiskan penuh (Total Tagihan = 0)
        return 0;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Bidikmisi | No KIP Kuliah: {$this->nomorKipKuliah} | Dana Saku Subsidi: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    public static function cariBerdasarkanKip($dbKoneksi, $noKip) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi' AND nomor_kip_kuliah = :noKip";
        $stmt = $dbKoneksi->prepare($sql);
        $stmt->execute(['noKip' => $noKip]);
        return $stmt->fetch();
    }

    public function getNomorKipKuliah() { return $this->nomorKipKuliah; }
    public function getDanaSakuSubsidi() { return $this->danaSakuSubsidi; }
}
?>