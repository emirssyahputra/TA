<?php

namespace App\Controllers;

use App\Models\M_riwayat;
use App\Models\M_siswa;

class Dashboard extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 2) {
                $session = \Config\Services::session();
                $iden['namaa'] = $session->get('namaa');
                $iden['kelas'] = $session->get('kelas');
                // Mendapatkan NISN dari session
                $nisn = session()->get('nisn');

                // Membuat instance model RiwayatPelanggaranModel
                $riwayatPelanggaranModel = new M_riwayat();

                // Mengambil riwayat pelanggaran berdasarkan NISN
                $iden['riwayatPelanggaran'] = $riwayatPelanggaranModel->getRiwayatPelanggaranByNISN($nisn);

                $nisn = session()->get('nisn');

                // Membuat instance model SiswaModel
                $siswaModel = new M_siswa();

                // Mendapatkan total poin siswa berdasarkan NISN
                $iden['totalPoin'] = $siswaModel->getTotalPoinByNISN($nisn);

                return view('v_dashboard', $iden);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
}