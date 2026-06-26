<?php
/**
 * File Utama Antarmuka (View) - index.php
 * Menggabungkan Koneksi OOP, Instansiasi Objek, dan Polimorfisme Overriding
 */

// 1. Memuat semua file dependensi yang dibutuhkan
require_once 'koneksi.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// 2. Instansiasi koneksi database (OOP Murni)
$database = new Database();
$dbConn = $database->hubungkan();

// 3. Mengambil seluruh data mahasiswa dari database
$sql = "SELECT * FROM tabel_mahasiswa ORDER BY jenis_pembiayaan, nama_mahasiswa ASC";
$stmt = $dbConn->query($sql);
$semuaData = $stmt->fetchAll();

// 4. Menyiapkan array penampung objek kelompok mahasiswa
$listMandiri = [];
$listBidikmisi = [];
$listPrestasi = [];

// 5. Polimorfisme: Looping data DB dan mengubahnya menjadi Objek Kelas Anak yang pas
foreach ($semuaData as $row) {
    if ($row->jenis_pembiayaan == 'Mandiri') {
        $listMandiri[] = new MahasiswaMandiri(
            $row->id_mahasiswa, $row->nama_mahasiswa, $row->nim, $row->semester, 
            $row->tarif_ukt_nominal, $row->jenis_pembiayaan, $row->golongan_ukt, $row->nama_wali
        );
    } elseif ($row->jenis_pembiayaan == 'Bidikmisi') {
        $listBidikmisi[] = new MahasiswaBidikmisi(
            $row->id_mahasiswa, $row->nama_mahasiswa, $row->nim, $row->semester, 
            $row->tarif_ukt_nominal, $row->jenis_pembiayaan, $row->nomor_kip_kuliah, $row->dana_saku_subsidi
        );
    } elseif ($row->jenis_pembiayaan == 'Prestasi') {
        $listPrestasi[] = new MahasiswaPrestasi(
            $row->id_mahasiswa, $row->nama_mahasiswa, $row->nim, $row->semester, 
            $row->tarif_ukt_nominal, $row->jenis_pembiayaan, $row->nama_instansi_beasiswa, $row->minimal_ipk_syarat
        );
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Registrasi Pembayaran Mahasiswa - UAS PBO</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 40px; 
            background-color: #f4f6f9; 
            color: #333;
        }
        h1 { 
            text-align: center; 
            color: #2c3e50;
            margin-bottom: 30px;
        }
        h2 { 
            color: #2980b9; 
            border-left: 5px solid #2980b9; 
            padding-left: 10px; 
            margin-top: 40px; 
            font-size: 1.5rem;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px; 
            background-color: #fff; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td { 
            padding: 14px 18px; 
            text-align: left; 
            border-bottom: 1px solid #eef2f5;
        }
        th { 
            background-color: #2980b9; 
            color: white; 
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        tr:hover { 
            background-color: #f8fafd; 
        }
        tr:nth-child(even) { 
            background-color: #fcfdfe; 
        }
        .tagihan { 
            font-weight: bold; 
            color: #c0392b; 
        }
        .gratis { 
            font-weight: bold; 
            color: #27ae60; 
            background-color: #e8f8f5;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .info-tambahan {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>

    <h1>Daftar Registrasi Pembayaran Kuliah Mahasiswa</h1>

    <h2>Kategori: Mahasiswa Mandiri</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Semester</th>
                <th>Golongan UKT</th>
                <th>Nama Wali</th>
                <th>Tarif UKT Asli</th>
                <th>Total Tagihan (+ Ops Rp100k)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($listMandiri)): ?>
                <tr><td colspan="8" style="text-align:center;">Tidak ada data mahasiswa mandiri.</td></tr>
            <?php else: ?>
                <?php $no = 1; foreach ($listMandiri as $mhs): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $mhs->getNim() ?></strong></td>
                    <td><?= $mhs->getNamaMahasiswa() ?></td>
                    <td>Semester <?= $mhs->getSemester() ?></td>
                    <td><?= $mhs->getGolonganUkt() ?></td>
                    <td><?= $mhs->getNamaWali() ?></td>
                    <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                    <td class="tagihan">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>


    <h2>Kategori: Mahasiswa Bidikmisi</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Semester</th>
                <th>No. KIP Kuliah</th>
                <th>Dana Saku Subsidi / Bln</th>
                <th>Tarif UKT Asli</th>
                <th>Total Tagihan (Beasiswa)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($listBidikmisi)): ?>
                <tr><td colspan="8" style="text-align:center;">Tidak ada data mahasiswa bidikmisi.</td></tr>
            <?php else: ?>
                <?php $no = 1; foreach ($listBidikmisi as $mhs): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $mhs->getNim() ?></strong></td>
                    <td><?= $mhs->getNamaMahasiswa() ?></td>
                    <td>Semester <?= $mhs->getSemester() ?></td>
                    <td><span class="info-tambahan"><?= $mhs->getNomorKipKuliah() ?></span></td>
                    <td>Rp <?= number_format($mhs->getDanaSakuSubsidi(), 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                    <td><span class="gratis">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?> (LUNAS)</span></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>


    <h2>Kategori: Mahasiswa Prestasi</h2>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Semester</th>
                <th>Instansi Sponsor</th>
                <th>Syarat Minimal IPK</th>
                <th>Tarif UKT Asli</th>
                <th>Total Tagihan (Cukup Bayar 25%)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($listPrestasi)): ?>
                <tr><td colspan="8" style="text-align:center;">Tidak ada data mahasiswa prestasi.</td></tr>
            <?php else: ?>
                <?php $no = 1; foreach ($listPrestasi as $mhs): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= $mhs->getNim() ?></strong></td>
                    <td><?= $mhs->getNamaMahasiswa() ?></td>
                    <td>Semester <?= $mhs->getSemester() ?></td>
                    <td><?= $mhs->getNamaInstansiBeasiswa() ?></td>
                    <td><strong><?= number_format($mhs->getMinimalIpkSyarat(), 2) ?></strong></td>
                    <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.') ?></td>
                    <td class="tagihan">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>