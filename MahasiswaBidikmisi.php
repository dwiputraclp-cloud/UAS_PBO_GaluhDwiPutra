<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan khusus Mahasiswa Bidikmisi
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    // Constructor Kelas Anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // Implementasi Method Abstrak 1: Hitung Tagihan
    public function hitungTagihanSemester() {
        // Mahasiswa Bidikmisi biasanya mendapatkan pembebasan UKT (Tagihan = 0)
        // Nilai tarifUktNominal di database dicover oleh pemerintah/subsidi
        return 0;
    }

    // Implementasi Method Abstrak 2: Tampilkan Spesifikasi
    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Bidikmisi | No KIP Kuliah: {$this->nomorKipKuliah} | Dana Saku Subsidi: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    // =========================================================================
    // Method Spesifik: Query SELECT-WHERE untuk mencari mahasiswa berdasarkan Nomor KIP
    // =========================================================================
    public static function cariBerdasarkanKip($dbKoneksi, $noKip) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi' AND nomor_kip_kuliah = :noKip";
        $stmt = $dbKoneksi->prepare($sql);
        $stmt->execute(['noKip' => $noKip]);
        return $stmt->fetch(); // Mengambil satu data spesifik (karena KIP bersifat unik)
    }

    // Getter untuk properti spesifik
    public function getNomorKipKuliah() { return $this->nomorKipKuliah; }
    public function getDanaSakuSubsidi() { return $this->danaSakuSubsidi; }
}
?>