<?php

namespace App\Controllers;

use App\Models\M_siswa;

class Datasiswadetail extends BaseController
{
    public function index($id)
    {
        $sesi_pengguna_id = session()->get('idadmin');
        $akses_pengguna = session()->get('akses');

        if ($sesi_pengguna_id) {
            if ($akses_pengguna == 1) {
                $session = \Config\Services::session();
                $iden['nama'] = $session->get('namaa');
                $iden['jabatan']= $session->get('jabatan');
                $model = new M_siswa();
                $data['siswa'] = $model->find($id);
                // Validasi jika pengguna tidak ditemukan
                if ($data['siswa'] === null) {
                    // Tampilkan pesan kesalahan atau redirect ke halaman lain
                    return redirect()->to('error');
                }

                return view('v_datasiswadetail', ['siswa' => $data['siswa'], 'id_siswa' => $id] + $iden);
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
        $model = new M_siswa();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
            'nisn' => $this->request->getPost('nisn'),
            'jenkel' => $this->request->getPost('jenkel'),
            'no_ortu' => $this->request->getPost('ortu'),
            'wali' => $this->request->getPost('wali'),

            // Tambahkan field lain yang perlu diubah
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/datasiswag/tampilkanDataSiswa/' . $data['kelas'])->with('success', 'Berhasil Update Data Siswa.');
        } else {
            return redirect()->to('/datasiswag/tampilkanDataSiswa/' . $data['kelas'])->with('error', 'Tidak Berhasil Update Data Siswa.');
        }
    }
}
