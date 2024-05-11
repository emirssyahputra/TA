<?php

namespace App\Controllers;
use App\Models\M_guru;
use App\Models\M_jadwal;
use App\Models\M_login;


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
                $guruModel = new M_guru();
                $data['daftar_guru'] = $guruModel->getall();
                $model = new M_login();
                $siswa = $model->find($sesi_pengguna_id);
                return view('v_pengajuan',$iden + $data + $siswa);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function save()
    {
        // Validasi data yang diterima dari formulir jika diperlukan
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal' => 'required|valid_date',
            'gurubk' => 'required',
            'nama' => 'required',
            'nisn' => 'required',
            'kelas' => 'required',
        ]);
        
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Mengambil data dari formulir
        $tanggal = $this->request->getPost('tanggal');
        $gurubk = $this->request->getPost('gurubk');
        $nama = $this->request->getPost('nama');
        $nisn = $this->request->getPost('nisn');
        $kelas = $this->request->getPost('kelas');


        // Menyimpan data ke dalam tabel jadwal
        $jadwalModel = new M_jadwal();
        $data = [
            'waktu' => $tanggal,
            'guru' => $gurubk,
            'nama' => $nama,
            'nisn' => $nisn,
            'kelas' => $kelas,
        ];

        $jadwalModel->insert($data);

        // Redirect ke halaman dashboard atau halaman lainnya setelah penyimpanan data
        return redirect()->to(site_url('jadwals'))->with('success', 'Jadwal Bimbingan Berhasil Diajukan');
    }
}