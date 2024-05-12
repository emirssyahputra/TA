<?php

namespace App\Controllers;

use App\Models\M_riwayat;

class Datalanggar extends BaseController
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
                $riwayat = new M_riwayat();

                // Panggil method model untuk mendapatkan data riwayat pelanggaran
                $data['riwayat'] = $riwayat->getRiwayatPelanggaranByNISN($nisn);
                return view('v_datalanggar', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function hapusRiwayat($id_riwayat)
    {
        // Membuat instance model
        $riwayatPelanggaranModel = new M_riwayat();

        // Menghapus riwayat pelanggaran berdasarkan ID
        $riwayatPelanggaranModel->delete($id_riwayat);


        // Redirect kembali ke halaman data riwayat dengan NISN yang sama
        return redirect()->back()->with('success', 'Riwayat pelanggaran berhasil dihapus.');
    }
    
}