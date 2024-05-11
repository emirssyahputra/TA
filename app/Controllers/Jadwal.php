<?php

namespace App\Controllers;
use App\Models\M_jadwal;

class Jadwal extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $iden['nama'] = $session->get('namaa');
                $iden['jabatan']= $session->get('jabatan');
                $nama_guru_bk = session()->get('namaa');
                $jadwalModel = new M_jadwal();

                // Ambil data jadwal berdasarkan nama guru BK
                $data['jadwal'] = $jadwalModel->where('guru', $nama_guru_bk)->findAll();
                return view('v_jadwal', $data + $iden);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function acc($id_jadwal)
    {
        $pinjamModel = new M_jadwal();

        // Update status peminjaman menjadi "Diterima"
        $status = "Diterima";
        $pinjamModel->editStatus($id_jadwal, $status);

        // Redirect ke halaman yang diinginkan
        return redirect()->to(site_url('jadwal'))->with('success', 'Anda Berhasil Menerima Pengajuan Jadwal.');
    }

    public function dec($id_jadwal)
    {
        $pinjamModel = new M_jadwal();

        // Update status peminjaman menjadi "Ditolak"
        $status = "Ditolak";
        $pinjamModel->editStatus($id_jadwal, $status);


        // Redirect ke halaman yang diinginkan
        return redirect()->to(site_url('jadwal'))->with('success', 'Anda Berhasil Menolak Pengajuan Jadwal.');
    }
    public function del($id_jadwal)
    {
        $pinjamModel = new M_jadwal();

        // Hapus peminjaman berdasarkan ID
        $pinjamModel->delete($id_jadwal);

        // Redirect ke halaman yang diinginkan
        return redirect()->to(site_url('jadwal'))->with('error', 'Anda Berhasil Menghapus Pengajuan Jadwal.');
    }
}
