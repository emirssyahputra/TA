<?php

namespace App\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;

class Cetakortu extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $data['nama'] = $session->get('namaa');
                $data['jabatan'] = $session->get('jabatan');
                return view('v_cetakortu', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function generatePdf()
    {
         // Ambil data dari formulir
    $nama = $this->request->getPost('nama');
    $kelas = $this->request->getPost('kelas');
    $nisn = $this->request->getPost('nisn');
    $alasan = $this->request->getPost('alasan');

    // Load template Word
    $templatePath = WRITEPATH . 'public/templates/Contoh.docx';

    // Load PHPWord
    // Load PHPWord TemplateProcessor
    $templateProcessor = new TemplateProcessor($templatePath);

    // Ganti teks dalam template dengan data dari formulir
    $templateProcessor->setValue('tesnama', $nama);
    $templateProcessor->setValue('teskelas', $kelas);
    $templateProcessor->setValue('tesnisn', $nisn);
    $templateProcessor->setValue('tesalasan', $alasan);

    // Simpan dokumen Word yang telah diisi
    $wordPath = WRITEPATH . 'hasil.docx';
    $templateProcessor->saveAs($wordPath);

    // Output the Word document directly
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="hasil.docx"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

    readfile($wordPath);
    exit;
    }

}