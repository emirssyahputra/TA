<?php

namespace App\Controllers;
use App\Models\M_siswa;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Import extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $data['nama'] = $session->get('namaa');
                $data['jabatan']= $session->get('jabatan');
                return view('v_import', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function unggah()
{
    // Ambil file yang diunggah dari form
    $file = $this->request->getFile('file_excel');

    // Buat objek pembaca Excel
    $spreadsheet = IOFactory::load($file);

    // Baca file Excel
    $sheet = $spreadsheet->getActiveSheet();

    // Inisialisasi model siswa
    $siswaModel = new M_siswa();

    // Loop untuk membaca setiap baris data, mulai dari baris kedua (indeks 1) karena baris pertama adalah header
    foreach ($sheet->getRowIterator(2) as $row) {
        // Ambil data dari setiap kolom
        $nama = $sheet->getCell('A' . $row->getRowIndex())->getValue(); // Kolom A -> Nama
        $nisn = $sheet->getCell('B' . $row->getRowIndex())->getValue(); // Kolom B -> NISN
        $jenis_kelamin = $sheet->getCell('C' . $row->getRowIndex())->getValue(); // Kolom C -> Jenis Kelamin
        $no_ortu = $sheet->getCell('D' . $row->getRowIndex())->getValue(); // Kolom D -> Nomor Orang Tua
        $wali = $sheet->getCell('E' . $row->getRowIndex())->getValue(); // Kolom E -> Wali
        $kelas = $sheet->getCell('F' . $row->getRowIndex())->getValue(); // Kolom F -> Kelas

        // Simpan data ke dalam array
        $data = [
            'nama' => $nama,
            'nisn' => $nisn,
            'jenkel' => $jenis_kelamin,
            'no_ortu' => $no_ortu,
            'wali' => $wali,
            'kelas' => $kelas
        ];

        // Simpan data ke dalam tabel siswa menggunakan model siswa
        $siswaModel->insert($data);
    }

    // Redirect atau tampilkan pesan sukses setelah impor selesai
    return redirect()->to(site_url('dashboardg'))->with('success', 'Data berhasil diimpor.');
}
}