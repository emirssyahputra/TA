<?php

namespace App\Controllers;
use App\Models\M_guru;

class Tambahguru extends BaseController
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
                return view('v_tambahguru', $data);
            } else {
                session()->destroy();
                return redirect()->to(site_url('logins'));
            }
        } else {
            return redirect()->to(site_url('logins'));
        }
    }
    public function tambah()
    {
        $data = [];
        $model = new M_guru();

        $data = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama' => $this->request->getVar('nama'),
            'id_role' => 1,
            'jabatan' => $this->request->getVar('jabatan'),
            'nuptk' => $this->request->getVar('nuptk'),
        ];

        if ($model->insert($data)) { // Menggunakan insert() untuk menyimpan data
            return redirect()->to('/dataguru')->with('success', 'Data Guru BK Berhasil Ditambah');
        } else {
            return redirect()->to('/tambahguru')->with('error', 'Data Guru BK Gagal Ditambah');
        }
    }
}