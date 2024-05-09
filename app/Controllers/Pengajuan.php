<?php

namespace App\Controllers;

class Pengajuan extends BaseController
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
                return view('v_pengajuan',$iden);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
}