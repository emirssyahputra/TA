<?php

namespace App\Controllers;

use App\Models\M_riwayat;
use App\Models\M_siswa;
use TCPDF;

class Cetak extends BaseController
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
                return view('v_cetak',$data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function printPdf()
    {
        // Ambil bulan dan kelas dari form input
        $bulan = $this->request->getVar('bulan');
        $kelas = $this->request->getVar('kelas');

        // Ambil data siswa berdasarkan kelas
        $siswaModel = new M_siswa();
        $siswa = $siswaModel->where('kelas', $kelas)->findAll();
        $wali = !empty($siswa) ? $siswa[0]['wali'] : '';


        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set judul dokumen
        $pdf->SetTitle('Laporan Riwayat Pelanggaran');

        // Tambahkan halaman
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Deklarasi variabel $html
        $html = '';

        // Judul tabel
        $html .= '<h1>Laporan Riwayat Pelanggaran</h1>';

        // Informasi kelas, wali kelas, dan bulan pelanggaran
        $html .= '<p><b>Kelas:</b> ' . $kelas . '</p>';
        $html .= '<p><b>Wali Kelas:</b> ' . $wali . '</p>';
        $html .= '<p><b>Bulan Pelanggaran:</b> ' . strftime('%B %Y', strtotime($bulan . '-01')) . '</p>';
        // Tabel
        $html .= '<table border="1">';
        $html .= '<tr><th style="text-align:center;">No</th><th style="text-align:center;">Nama</th><th style="text-align:center;">NISN</th><th style="text-align:center;">Pelanggaran</th><th style="text-align:center;">Tanggal</th><th style="text-align:center;">Poin</th></tr>';

        // Ambil data riwayat berdasarkan bulan dan kelas
        $riwayatModel = new M_riwayat();
        $no = 1;
        foreach ($siswa as $s) {
            $riwayat = $riwayatModel->where('DATE_FORMAT(tanggal, "%Y-%m")', $bulan)
                ->where('nisn', $s['nisn'])
                ->findAll();
            foreach ($riwayat as $r) {
                $html .= '<tr>';
                $html .= '<td style="text-align:center;">' . $no++ . '</td>';
                $html .= '<td>' . $s['nama'] . '</td>';
                $html .= '<td>' . $r['nisn'] . '</td>';
                $html .= '<td>' . $r['pelanggaran'] . '</td>';
                $html .= '<td>' . $r['tanggal'] . '</td>';
                $html .= '<td>' . $r['poin'] . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';

        // Tampilkan tabel dalam PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF ke browser
        $pdf->Output('laporan_riwayat_pelanggaran.pdf', 'I');
    }
}