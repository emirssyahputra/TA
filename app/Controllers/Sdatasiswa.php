<?php

namespace App\Controllers;

use App\Models\M_jadwal;
use App\Models\M_login;

class sdatasiswa extends BaseController
{
    public function index()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');
        $siswa = null;
        $iden = []; // Initialize $iden array

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 2) {
                $session = \Config\Services::session();
                $iden['namaa'] = $session->get('namaa');
                $iden['kelas'] = $session->get('kelas');
                $model = new M_login();
                $siswa = $model->find($sesi_pengguna_id);

            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }

        return view('v_sdatasiswa', $siswa + $iden);
    }

    public function update()
    {
        $sesi_pengguna_id = session()->get('idadmin');
        if ($sesi_pengguna_id) {
            $model = new M_login();
            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'kelas' => $this->request->getPost('kelas'),
                'nisn' => $this->request->getPost('nisn'),
                // Tambahkan field lain yang perlu diubah
            ];

            if ($model->update($sesi_pengguna_id, $data)) {
                // Jika berhasil, arahkan pengguna ke halaman dashboard dengan pesan sukses
                return redirect()->to('/dashboard')->with('success', 'Berhasil Update Data Akun Siswa.');
            } else {
                // Jika gagal, arahkan pengguna kembali ke halaman update dengan pesan error
                return redirect()->to('/Sdatasiswa')->with('error', 'Tidak Berhasil Update Data Akun Siswa.');
            }
        } else {
            // Jika ID pengguna tidak tersedia dalam sesi, arahkan pengguna ke halaman lain atau lakukan penanganan sesuai kebutuhan
            return redirect()->to('/Sdatasiswa')->with('error', 'Gagal. Pengguna tidak terautentikasi.');
        }
    }
}
