<?php

namespace App\Controllers;
use App\Models\M_guru; // Sesuaikan dengan model yang digunakan

class Detailguru extends BaseController
{
    public function index($id)
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $iden['namaa'] = $session->get('namaa');
                $iden['jabatann']= $session->get('jabatan');
                $model = new M_guru();
                $data['guru'] = $model->find($id);

        // Validasi jika pengguna tidak ditemukan
        if ($data['guru'] === null) {
            // Tampilkan pesan kesalahan atau redirect ke halaman lain
            return redirect()->to('error');
        }

        return view('v_detailguru', ['guru' => $data['guru'], 'id' => $id] + $iden);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function update($id)
    {
        $model = new M_guru();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'jabatan' => $this->request->getPost('jabatan'),
            'nuptk' => $this->request->getPost('nuptk'),
            // Tambahkan field lain yang perlu diubah
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/dataguru')->with('success', 'Berhasil Update Data Guru BK.');
        } else {
            return redirect()->to('/detailguru')->with('error', 'Tidak Berhasil Update Data Guru BK.');
        }
    }
}