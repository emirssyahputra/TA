<?php

namespace App\Controllers;
use App\Models\M_jadwal;
use App\Models\M_login;

class Jadwals extends BaseController
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
                $model = new M_login();
                $siswa = $model->find($sesi_pengguna_id);
                $nisn = $siswa['nisn'];
                $jadwalModel = new M_jadwal();

                // Ambil data jadwal berdasarkan NISN
                $data['jadwal'] = $jadwalModel->where('nisn', $nisn)->findAll();
                return view('v_jadwals', $iden +$data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
}