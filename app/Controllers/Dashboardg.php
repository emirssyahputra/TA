<?php

namespace App\Controllers;
use App\Models\M_jadwal;
use App\Models\M_riwayat;
use App\Models\M_siswa;

class Dashboardg extends BaseController
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
                $m_guru = new \App\Models\M_guru();
                $data['admin'] = $m_guru->where('id_role', 1)->countAllResults();
                $nama = session()->get('nama');
                $jadwalmodel = new M_jadwal();

                // Hitung jadwal bimbingan berdasarkan nama dari session
                $jumlahJadwal = $jadwalmodel->where('guru', $nama)->countAllResults();
                $data['jadwal'] = $jumlahJadwal;
                $siswaModel = new M_siswa();
                $jumlahSiswa = $siswaModel->countAll();
                $data['siswa'] = $jumlahSiswa;
                $riwayatmodel = new M_riwayat();
                $jumlahriwayat = $riwayatmodel->countAll();
                $data['riwayat'] = $jumlahriwayat;
                return view('v_dashboardg', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
}