<?php

namespace App\Controllers;
use App\Models\M_riwayat;
use App\Models\M_siswa;

class Tambahlanggar extends BaseController
{
    public function index($nisn)
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $data['nama'] = $session->get('namaa');
                $data['jabatan'] = $session->get('jabatan');
                $data['nisn'] = $nisn;
                return view('v_tambahlanggar', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function tambah()
    {
        // Menerima data dari form
        $nisn = $this->request->getPost('nisn');
        $jenis_pelanggaran = $this->request->getPost('pelanggaran');
        $tanggal_pelanggaran = $this->request->getPost('tanggal');
        $poin = $this->request->getPost('poin');

        // Validasi data input jika diperlukan

        // Masukkan data ke dalam tabel riwayat_pelanggaran
        $riwayatPelanggaranModel = new M_riwayat();
        $data = [
            'nisn' => $nisn,
            'pelanggaran' => $jenis_pelanggaran,
            'tanggal' => $tanggal_pelanggaran,
            'poin' => $poin
        ];
        $riwayatPelanggaranModel->insert($data);
         // Update poin siswa
         $siswaModel = new M_siswa();
         $siswaModel->updatePoinByNISN($nisn, $poin);

        // Redirect kembali ke halaman sebelumnya atau ke halaman tertentu
        return redirect()->to(site_url('datalanggar/' . $nisn))->with('success', 'Riwayat pelanggaran berhasil Ditambah.');
    
    }
}