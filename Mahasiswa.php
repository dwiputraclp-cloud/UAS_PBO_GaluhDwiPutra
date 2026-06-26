<?php
/**
 * Abstract Class Mahasiswa
 * Implementasi Tahap 3: Abstraksi & Enkapsulasi
 */

abstract class Mahasiswa {
    // 1. Properti/Atribut Terenkapsulasi (protected)
    // Hak akses "protected" membatasi aksesibilitas variabel hanya untuk kelas ini dan kelas anaknya
    protected $id_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;
    
    // (Opsional tapi penting): Menambahkan properti global dari Tahap 1
    protected $nama_mahasiswa;
    protected $jenis_pembiayaan;

    /**
     * Constructor (Metode Ajaib / Magic Method)
     * Berfungsi memetakan nilai dari baris/kolom tabel di database ke properti kelas
     */
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $jenis_pembiayaan) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        
        // Memetakan nilai kolom tarif_ukt_nominal ke properti camelCase
        $this->tarifUktNominal = $tarifUktNominal;
        $this->jenis_pembiayaan = $jenis_pembiayaan;
    }

    // ==========================================
    // 2. Deklarasi Metode Abstrak (Tanpa Body)
    // ==========================================
    
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();

    // ==========================================
    // 3. Getter Methods (Enkapsulasi)
    // ==========================================
    // Karena properti diset "protected", kita membuat Getter agar di luar scope class 
    // nilainya tetap bisa dibaca (namun tidak sembarangan dimodifikasi)
    
    public function getIdMahasiswa() { return $this->id_mahasiswa; }
    public function getNamaMahasiswa() { return $this->nama_mahasiswa; }
    public function getNim() { return $this->nim; }
    public function getSemester() { return $this->semester; }
    public function getTarifUktNominal() { return $this->tarifUktNominal; }
    public function getJenisPembiayaan() { return $this->jenis_pembiayaan; }
}
?>