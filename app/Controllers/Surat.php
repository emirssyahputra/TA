<?php

namespace App\Controllers;
use App\Models\M_siswa;

class Surat extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $data['namaa'] = $session->get('namaa');
                $data['jabatan']= $session->get('jabatan');

                $siswaModel = new M_siswa();
                $siswa = $siswaModel->where('poin >', 16)->findAll();
                foreach ($siswa as &$s) {
                    if ($s['poin'] > 79) {
                        $s['kategori_sanksi'] = 'Dikeluarkan';
                    } elseif ($s['poin'] > 36) {
                        $s['kategori_sanksi'] = 'Surat Pemanggilan 3';
                    } elseif ($s['poin'] > 25) {
                        $s['kategori_sanksi'] = 'Surat Pemanggilan 2';
                    } elseif ($s['poin'] > 16) {
                        $s['kategori_sanksi'] = 'Surat Pemanggilan 1';
                    } else {
                        $s['kategori_sanksi'] = '-';
                    }
                }
            
                // Kirim data siswa dan data lainnya ke view
                return view('v_surat', ['siswa' => $siswa] + $data);
    } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
}